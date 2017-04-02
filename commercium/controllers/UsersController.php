<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 01-04-17
 * Time: 16:17
 */

namespace commercium\controllers;


use commercium\models\User;
use commercium\repositories\Groups;
use commercium\repositories\Users;
use framework\components\base\Helpers;
use framework\components\base\SessionManagement;
use framework\components\Controller;
use framework\traits\IsLoginProtected;
use framework\traits\IsRoleBasedProtected;

class UsersController extends Controller {
    use IsLoginProtected, IsRoleBasedProtected;

    public function actionIndex() {
        $this->roleCheck("admins");
        $this->layoutParams['title'] = "User management";
        return $this->render("index", ['users' => Users::all(), 'groups' => Groups::all()]);
    }

    public function actionNew() {
        $this->roleCheck("admins");
        return $this->render('new', ['user' => new User(), 'groups' => Groups::all()]);
    }

    public function actionStore() {
        $this->roleCheck('admins');
        $user = Users::insert(
            Helpers::getInputParameter('firstname', 'post'),
            Helpers::getInputParameter('lastname', 'post'),
            Helpers::getInputParameter('email', 'post'),
            password_hash(Helpers::getInputParameter('password', 'post'), PASSWORD_BCRYPT)
        );
        //set groups
        Users::setGroups($user->id, $_POST['groups']);
        return $this->redirectTo('users');
    }

    public function actionSave() {
        $this->cabapilitiesCheck(SessionManagement::getUser()->id);
        $user = Users::findOrFail(Helpers::getInputParameter('id', 'post'));
        $user->firstname = Helpers::getInputParameter('firstname', 'post');
        $user->lastname = Helpers::getInputParameter('lastname', 'post');
        //only set new password if one is provided
        $newPassword = Helpers::getInputParameter('newPassword', 'post');
        if (!empty($newPassword)) {
            $user->password = $newPassword;
        }
        //only admins can edit sensitive data
        if (SessionManagement::getUser()->isMemberOfGroup("admins")) {
            $user->email = Helpers::getInputParameter('email', 'post');
            Users::setGroups($user->id, $_POST['groups']);
        }
        Users::update($user);
        return $this->redirectTo('users');
    }

    /**
     * Check if the user is editing his own profile or is an admin
     * @param $userId
     */
    private function cabapilitiesCheck($userId) {
        if (!$userId == SessionManagement::getUser()->id || !SessionManagement::getUser()->isMemberOfGroup('admins')) {
            Helpers::throwHttpError(403, "You can only edit your own profile");
        }
    }

    public function actionDelete() {
        $this->roleCheck("admins");
        $userId = Helpers::getInputParameter("id", "post");
        Groups::detachAllFromUser($userId);
        Users::deleteById($userId);
        return $this->redirectTo('users');
    }

    public function actionView() {
        $user = Users::findOrFail(Helpers::getInputParameter('id'));
        $this->cabapilitiesCheck($user->id);
        $this->layoutParams['title'] = "Edit: " . $user->email;
        return $this->render('view', ['user' => $user, 'groups' => Groups::all()]);
    }
}