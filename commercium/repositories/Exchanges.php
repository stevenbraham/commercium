<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 14-04-17
 * Time: 17:56
 */

namespace commercium\repositories;


use commercium\models\Exchange;
use framework\components\Repository;

class Exchanges extends Repository {
    public static function getModel() {
        return Exchange::class;
    }

    public static function getTable() {
        return "exchanges";
    }

    public static function getPrimaryKeyAttribute() {
        return "exchange_id";
    }
}