<?php

namespace framework\contracts;
/**
 * This contract ensures that all repositories adhere to the same structure
 * @package framework\contracts
 */
interface Repository {
    /**
     * @return array
     */
    public static function all();

    public static function findByAttribute($name, $value);

    /**
     * Finds an object by the primary key
     * @param $id
     * @return mixed
     */
    public static function findById($id);

    /**
     * Same as the findById function but throws exception if the object can't be found
     * @param $id
     * @throws \Exception
     * @return mixed
     */
    public static function findOrFail($id);
}