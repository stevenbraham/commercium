<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 14:40
 */

namespace framework\components;


abstract class Model {

    public $id;
    /**
     * Model constructor.
     * @param $params
     */
    public final function __construct($params) {
        //fill our object with params added from the constructor array
        $this->afterConstruct();
        foreach ($params as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * This gets called after the constructor is finished
     */
    public function afterConstruct() {

    }
}