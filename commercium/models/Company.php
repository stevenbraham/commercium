<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 20:46
 */

namespace commercium\models;


use commercium\repositories\Exchanges;
use framework\components\Model;

class Company extends Model {
    public static $primaryKeyAttribute = "company_id";
    public $company_id, $exchange_id, $company_name, $stock_symbol;

    /**
     * @return Exchange
     */
    public function getExchange() {
        return Exchanges::findOrFail($this->exchange_id);
    }
}