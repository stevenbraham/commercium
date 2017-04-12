<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:37
 */

namespace commercium\controllers;


use commercium\repositories\Transactions;
use framework\components\base\Helpers;
use framework\components\base\SessionManagement;
use framework\components\Controller;
use framework\traits\IsLoginProtected;

class MainController extends Controller {
    use IsLoginProtected;

    public function actionIndex() {
        $this->layoutParams['title'] = "Main";
        $this->layoutParams['scripts'][] = Helpers::getUrl("assets/js/main-index.js");
        return $this->render("index", [
            'user' => SessionManagement::getUser(),
            'profit' => Transactions::getTotalProfit()
        ]);
    }

    /**
     * Display profit charts
     */
    public function action_chart() {
        echo json_encode(Transactions::getProfitsPerDay(date("Y-m-d", strtotime("-7 days")), date("Y-m-d")));
    }
}