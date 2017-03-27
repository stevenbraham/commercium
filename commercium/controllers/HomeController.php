<?php

/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:15
 */

namespace commercium\controllers;

use framework\components\Controller;

class HomeController extends Controller {
    public function actionIndex() {
        echo "Hello from index";
    }
}