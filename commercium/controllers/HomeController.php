<?php

/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:15
 */

namespace commercium\controllers;

use framework\components\base\SessionManagement;
use framework\components\Controller;

class HomeController extends Controller {
    public function actionIndex() {
        //check if current user is logged in
        return SessionManagement::isLoggedIn() ? $this->redirectTo("main") : $this->redirectTo('login');
    }
}