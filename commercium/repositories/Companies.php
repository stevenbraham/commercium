<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 20:48
 */

namespace commercium\repositories;


use commercium\models\Company;
use framework\components\Repository;

class Companies extends Repository {
    public static function getTable() {
        return "companies";
    }

    public static function getPrimaryKeyAttribute() {
        return "company_id";
    }

    public static function getModel() {
        return Company::class;
    }

}