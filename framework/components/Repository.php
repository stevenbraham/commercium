<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 19:34
 */

namespace framework\components;

use framework\components\base\Core;
use framework\components\base\Helpers;
use framework\traits\CanAccessCore;

/**
 * Repository base class
 * The reason there is a repository contract and abstract class is that the contract set guidelines for general repositories
 * This class implements that contract for mysql based repos
 * In theory you can create a MongoDB repo with the contract
 * @package framework\components
 */
abstract class Repository implements \framework\contracts\Repository {
    public static function all() {
        $returnValues = [];
        //prepare and execute statement
        $query = Core::getInstance()->database->prepare("select * from " . static::getTable());
        $query->execute();
        //fill return values with desired objects
        foreach ($query->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $returnValues[] = static::createModel($row);
        }
        return $returnValues;
    }

    /**
     * The table were this instance is stored
     * @return string
     */
    public static abstract function getTable();

    /**
     * Creates a new model and infuses it with data
     * @param $params
     * @return mixed
     */
    public static function createModel($params) {
        $modelName = static::getModel();
        return new $modelName($params);
    }

    /**
     * The model class used to display data
     * @return string
     */
    public static abstract function getModel();

    public static function findOrFail($id) {
        $object = static::findById($id);
        return !empty($object) ? $object : Helpers::throwHttpError(404);
    }

    public static function findById($id) {
        return static::findByAttribute(static::getPrimaryKey(), $id);
    }

    public static function findByAttribute($name, $value) {
        $query = Core::getInstance()->database->prepare("select * from " . static::getTable() . " where " . $name . " = :value");
        $query->execute(['value' => $value]);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return !empty($result) ? static::createModel($result) : null;
    }

    /**
     * Primary key used for the table
     * @return string
     */
    protected static function getPrimaryKey() {
        return "id";
    }
}