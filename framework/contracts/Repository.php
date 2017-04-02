<?php

namespace framework\contracts;
/**
 * This contract ensures that all repositories adhere to the same structure
 * @package framework\contracts
 */
interface Repository {
    /**
     * @return Object[]
     */
    public static function all();

    /**
     * The model class used to display data
     * @return string
     */
    public static function getModel();

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

    /**
     * Deletes a single entity for the database
     * @param $id
     * @return void
     */
    public static function deleteById($id);

    /**
     * @param string $name
     * @param string $value
     * @return object|null
     */
    public static function findByAttribute($name, $value);

    /**
     * @param $name
     * @param $value
     * @return object[]
     */
    public static function findAllByAttribute($name, $value);
}