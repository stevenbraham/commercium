<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 14-04-17
 * Time: 17:32
 */

namespace commercium\controllers;


use commercium\repositories\Companies;
use commercium\repositories\Transactions;
use framework\components\base\Helpers;
use framework\components\Controller;
use framework\traits\IsLoginProtected;

class CompaniesController extends Controller {
    use IsLoginProtected;

    public function actionIndex() {
        $this->layoutParams['title'] = "Companies";
        return $this->render("index", ['companies' => Companies::getOverview()]);
    }

    public function actionView() {
        $company = Companies::findOrFail(Helpers::getInputParameter("id"));
        $this->layoutParams['title'] = $company->company_name;
        return $this->render("view", [
            'company' => $company,
            'transactions' => Transactions::findAllByAttribute('company_id', $company->getPrimaryKey())
        ]);
    }
}