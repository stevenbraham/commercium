<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 14:40
 */

namespace framework\components;


abstract class Model {

    /**
     * The name of the column that holds the primary key
     * @var string
     */
    public static $primaryKeyAttribute = "id";

    /**
     * Provides a factory like interface for creating objects of this particular modal
     * @param array $attributes
     * @return self
     */
    public final static function create($attributes) {
        $object = new static();
        foreach ($attributes as $key => $value) {
            if (property_exists(static::class, $key)) {
                $object->{$key} = $value;
            }
        }
        return $object;
    }

    /**
     * Returns the value of the primary of the object
     * @return string
     */
    public function getPrimaryKey() {
        return $this->{static::$primaryKeyAttribute};
    }

    /**
     * This gets called after the constructor is finished
     */
    public function afterConstruct() {

    }
}