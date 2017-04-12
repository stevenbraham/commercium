<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 19:37
 */

namespace commercium\controllers;


use commercium\repositories\Transactions;
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
        return $this->render("index", ['transactions' => Transactions::all('timestamp', 'DESC')]);
    }
}