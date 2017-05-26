<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 26-05-17
 * Time: 12:52
 */

namespace commercium\controllers;

use commercium\repositories\Transactions;
use framework\components\Controller;

/**
 * Displays public stats
 * @package commercium\controllers
 */
class AboutController extends Controller {
    public function actionIndex() {
        $this->layoutParams['title'] = "About";
        return $this->render("index", [
            'totalTransactions' => Transactions::getTotalTransactionCount(),
            'totalValue' => Transactions::getTotalTransactionValue(),
            'tradeData' => Transactions::getAboutPageData(),
            'totalData' => [
                'total_trade_value' => 0,
                'stocks_bought' => 0,
                'stocks_sold' => 0
            ]
        ]);
    }
}