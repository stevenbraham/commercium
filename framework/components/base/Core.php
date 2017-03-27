<?php

namespace framework\components\base;

/**
 * Wrapper function for all framework functions
 * This class should be instanced as a singleton
 * @package framework\components
 */
final class Core {
    /**
     * @var Database
     */
    public $database;
    public $router;
    public $helpers;
    /**
     * @var Repositories
     */
    public $repositories;

    public function __construct() {
        //populate other classes
        $this->database = new Database(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
        //load $repositories
        $this->repositories = new Repositories();
        $this->helpers = new Helpers();
    }
}