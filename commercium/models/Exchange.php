<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 14-04-17
 * Time: 17:55
 */

namespace commercium\models;


use framework\components\Model;

class Exchange extends Model {
    public static $primaryKeyAttribute = "exchange_id";
    public $exchange_id, $exchange_name;
}