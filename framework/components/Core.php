<?php

namespace framework\components;

/**
 * Wrapper function for all framework functions
 * This class should be instanced as a singleton with the core factory
 * @package framework\components
 */
class Core {
    /**
     * @var Database
     */
    protected $database;
    protected $router;
    protected $util;

    public function __construct() {
        //populate other classes
        $this->database = new Database(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
    }
}