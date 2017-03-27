<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:36
 */

namespace commercium\controllers;


use commercium\repositories\Users;
use framework\components\base\Helpers;
use framework\components\base\SessionManagement;
use framework\components\Controller;

/**
 * Responsible for login users in
 * @package commercium\controllers
 */
class LoginController extends Controller {

    public function actionIndex() {
        return $this->render("index");
    }

    public function actionLogin() {
        $email = Helpers::getInputParameter("email", "post");
        $password = Helpers::getInputParameter("password", "post");
        if (!empty($email) && !empty($password)) {
            $user = Users::findByAttribute("email", $email);
            if (!empty($user)) {
                if (SessionManagement::tryLogin($user, $password)) {
                    return $this->redirectTo("main");
                }
            }
        }
        return $this->redirectTo("login");
    }

    public function actionLogout() {

    }
}