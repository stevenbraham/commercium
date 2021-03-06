<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:38
 */

namespace framework\components\base;

use commercium\models\User;
use commercium\repositories\Users;
use framework\traits\CanAccessCore;

/**
 * Handles the login check and function
 * @package framework\components\base
 */
class SessionManagement {

    /**
     * Check if a valid logged in session exists
     * @return bool
     */
    public static function isLoggedIn() {
        if (isset($_SESSION['loggedIn']) && isset($_SESSION['user'])) {
            if ($_SESSION['loggedIn'] === true) {
                return true;
            }
        }
        return false;
    }

    /**
     * Tries to login a user
     * @param User $user
     * @param string $password
     * @return bool
     */
    public static function tryLogin(User $user, $password) {
        if (password_verify($password, $user->password)) {
            //register user in session
            $_SESSION['user'] = $user->getPrimaryKey();
            $_SESSION['loggedIn'] = true;
            return true;
        }
        //password invalid
        return false;
    }

    /**
     * Gets current logged in user
     * @return User
     */
    public static function getUser() {
        return Users::findById($_SESSION['user']);
    }

}