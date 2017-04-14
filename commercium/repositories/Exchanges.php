<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 14-04-17
 * Time: 17:56
 */

namespace commercium\repositories;


use commercium\models\Exchange;
use framework\components\base\Core;
use framework\components\Repository;

class Exchanges extends Repository {
    public static function getModel() {
        return Exchange::class;
    }

    public static function getPrimaryKeyAttribute() {
        return "exchange_id";
    }

    /**
     * @param string $name
     * @return Exchange
     */
    public static function insert($name) {
        $query = "INSERT INTO `" . static::getTable() . "` (`exchange_name`) VALUES (:name);";
        $statement = Core::getInstance()->database->prepare($query);
        $statement->execute([
            'name' => $name
        ]);
        return static::findOrFail(Core::getInstance()->database->lastInsertId());
    }

    public static function getTable() {
        return "exchanges";
    }
}