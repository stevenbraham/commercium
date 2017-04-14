<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 19:37
 */

namespace commercium\controllers;


use commercium\components\StockAPI;
use commercium\repositories\Companies;
use commercium\repositories\Exchanges;
use commercium\repositories\Transactions;
use framework\components\base\Helpers;
use framework\components\base\SessionManagement;
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

    public function actionNew() {
        //only "buyers' can buy stocks and set new transactions
        $this->roleCheck("buyers");
        $this->layoutParams['title'] = "New transaction";
        return $this->render("new", ['stockSymbol' => Helpers::getInputParameter("symbol")]);
    }

    public function actionStore() {
        $stockApi = new StockAPI();
        $this->roleCheck("buyers");
        $stockSymbol = Helpers::getInputParameter("stockSymbol", "post");
        $mutationAmount = Helpers::getInputParameter("mutationAmount", "post");
        if (!empty($stockSymbol) && !empty($mutationAmount)) {
            $mutationPrice = $stockApi->getStockPrice($stockSymbol);
            //check if company is in our database
            $company = Companies::findByStockSymbol($stockSymbol);
            if (empty($company)) {
                //retrieve company data from api
                $apiData = $stockApi->getCompanyInfo($stockSymbol);
                //check if exchange is exist
                $exchange = Exchanges::findByAttribute("exchange_name", $apiData->Exchange);
                if (empty($exchange)) {
                    //create new exchange
                    $exchange = Exchanges::insert($apiData->Exchange);
                }
                $company = Companies::insert($apiData->Name, $stockSymbol, $exchange->getPrimaryKey());
            }
            //store transaction
            $transaction = Transactions::insert(SessionManagement::getUser()->getPrimaryKey(), $company->getPrimaryKey(), $mutationPrice, $mutationAmount);
            return $this->redirectTo("transactions", "view?id=" . $transaction->getPrimaryKey());
        }
        //something went wrong if this line is reached
        return Helpers::throwHttpError(400, "Required parameters missing. Check your input");
    }
}