<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:37
 */

namespace commercium\controllers;


use framework\components\base\SessionManagement;
use framework\components\Controller;
use framework\traits\IsLoginProtected;

class MainController extends Controller {
    use IsLoginProtected;

    public function actionIndex() {
        return $this->render("index", ['user' => SessionManagement::getUser()]);
    }
}