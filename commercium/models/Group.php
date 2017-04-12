<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 01-04-17
 * Time: 17:58
 */

namespace commercium\models;


use framework\components\Model;

class Group extends Model {

    public static $primaryKeyAttribute = "group_id";

    public $group_id, $name, $slug;
}