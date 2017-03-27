<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 14:06
 */

namespace framework\components\base;

/**
 * PDO instance that can connect to our database
 * @package framework\components
 */
final class Database extends \PDO {
    /**
     * I simplified the constructor, it only requires host, username, password and db name
     * It generates its own dsn string
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $name
     */
    public function __construct($host, $username, $password, $name) {
        parent::__construct('mysql:host=' . $host . ';dbname=' . $name, $username, $password);
    }
}