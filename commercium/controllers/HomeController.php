<?php

/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:15
 */

namespace commercium\controllers;

use framework\components\Controller;
use framework\traits\CanAccessCore;

class HomeController extends Controller {
    use CanAccessCore;
    public function actionIndex() {
        //check if current user is logged in
        return $this->getCore()->session->isLoggedIn() ? $this->redirectTo("main") : $this->redirectTo('login');
    }
}