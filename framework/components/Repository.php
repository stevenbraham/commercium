<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 19:34
 */

namespace framework\components;

use framework\traits\CanAccessCore;

/**
 * Repository base class
 * The reason there is a repository contract and abstract class is that the contract set guidelines for general repositories
 * This class implements that contract for mysql based repos
 * In theory you can create a MongoDB repo with the contract
 * @package framework\components
 */
abstract class Repository implements \framework\contracts\Repository {
    use CanAccessCore;

    public function all() {
        $returnValues = [];
        //prepare and execute statement
        $query = $this->getCore()->database->prepare("select * from " . $this->getTable());
        $query->execute();
        //fill return values with desired objects
        foreach ($query->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $returnValues[] = $this->createModel($row);
        }
        return $returnValues;
    }

    /**
     * The table were this instance is stored
     * @return string
     */
    public abstract function getTable();

    /**
     * Creates a new model and infuses it with data
     * @param $params
     * @return mixed
     */
    private function createModel($params) {
        $modelName = $this->getModel();
        return new $modelName($params);
    }

    /**
     * The model class used to display data
     * @return string
     */
    public abstract function getModel();

    public function findOrFail($id) {
        $object = $this->findById($id);
        return !empty($object) ? $object : $this->getCore()->helpers->throwHttpError(404);
    }

    public function findById($id) {
        return $this->findByAttribute($this->getPrimaryKey(), $id);
    }

    public function findByAttribute($name, $value) {
        $query = $this->getCore()->database->prepare("select * from " . $this->getTable() . " where " . $name . " = :value");
        $query->execute(['value' => $value]);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return !empty($result) ? $this->createModel($result) : null;
    }

    /**
     * Primary key used for the table
     * @return string
     */
    protected function getPrimaryKey() {
        return "id";
    }

    /**
     * Provides a shorter route to PDO::quote
     * @param $string
     * @see PDO::quote()
     * @return string
     */
    private function sanitizeForSQL($string) {
        return $this->getCore()->database->quote($string);
    }
}