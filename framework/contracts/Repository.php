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
    public function all();

    public function findByAttribute($name, $value);

    /**
     * Finds an object by the primary key
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Same as the findById function but throws exception if the object can't be found
     * @param $id
     * @throws \Exception
     * @return mixed
     */
    public function findOrFail($id);
}