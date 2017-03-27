<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:36
 */

namespace commercium\controllers;


use framework\components\Controller;
use framework\traits\CanAccessCore;

/**
 * Responsible for login users in
 * @package commercium\controllers
 */
class LoginController extends Controller {
    use CanAccessCore;

    public function actionIndex() {
        return $this->render("index");
    }

    public function actionLogin() {
        $email = $this->getCore()->helpers->getInputParameter("email", "post");
        $password = $this->getCore()->helpers->getInputParameter("password", "post");
        if (!empty($email) && !empty($password)) {
            $user = $this->getCore()->repositories->users->findByAttribute("email", $email);
            if (!empty($user)) {
                if ($this->getCore()->session->tryLogin($user, $password)) {
                    return $this->redirectTo("main");
                }
            }
        }
        return $this->redirectTo("login");
    }

    public function actionLogout() {

    }
}