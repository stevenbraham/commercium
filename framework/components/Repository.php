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
        //prepare and execute statement
        $query = Core::getInstance()->database->prepare("select * from " . static::getTable());
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_CLASS, static::getModel()); //convert results to desired model
    }

    //the reason these two are functions, because PHP doesn't support static abstract attributes

    /**
     * The table were this instance is stored
     * @return string
     */
    public static abstract function getTable();

    /**
     * @param $id
     * @return object
     */
    public static function findOrFail($id) {
        $object = static::findById($id);
        return !empty($object) ? $object : Helpers::throwHttpError(404, "Cant find object");
    }

    /**
     * @param $id
     * @return object|null
     */
    public static function findById($id) {
        return static::findByAttribute(static::getPrimaryKeyAttribute(), $id);
    }

    /**
     * @param string $name
     * @param string $value
     * @return object|null
     */
    public static function findByAttribute($name, $value) {
        $query = Core::getInstance()->database->prepare("select * from " . static::getTable() . " where " . $name . " = :value limit 1");
        $query->execute(['value' => $value]);
        return $query->fetchObject(static::getModel());
    }

    /**
     * returns the name of the column holding the primary key
     * @return string
     */
    public static abstract function getPrimaryKeyAttribute();

    public static function findAllByAttribute($name, $value) {
        $statement = Core::getInstance()->database->prepare("select * from " . static::getTable() . " where " . $name . " = :value");
        $statement->execute(['value' => $value]);
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::getModel()); //convert results to desired model
    }

    public static function deleteById($id) {
        Core::getInstance()->database->prepare('delete from ' . static::getTable() . ' where  ' . static::getPrimaryKeyAttribute() . ' = :id')->execute(['id' => $id]);
    }
}