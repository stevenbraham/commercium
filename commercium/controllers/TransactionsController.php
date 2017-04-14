<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 19:37
 */

namespace commercium\controllers;


use commercium\repositories\Transactions;
use framework\components\base\Helpers;
use framework\components\Controller;
use framework\traits\IsLoginProtected;
use framework\traits\IsRoleBasedProtected;

/**
 * Only people that are allowed to buy stock can use this controller
 * @package commercium\controllers
 */
class TransactionsController extends Controller {
    use IsLoginProtected;
    use IsRoleBasedProtected;

    public function actionIndex() {
        $this->roleCheck("buyers");
        $this->layoutParams['title'] = "Transactions";
        /**
         * because a lot of data has to be retrieved from other tables,
         * it is more efficient to use a custom sql query with a join and select.
         * Otherwise the transaction object has to do select the other objects during the foreach loop
         * which can result in a lot of overhead
         */
        return $this->render("index", ['transactions' => Transactions::getQuickOverview()]);
    }

    public function actionView() {
        $id = Helpers::getInputParameter("id");
        $this->layoutParams['title'] = "Transaction #" . $id;
        return $this->render("view", ['transaction' => Transactions::findOrFail($id)]);
    }
}