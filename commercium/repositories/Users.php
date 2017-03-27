<?php

/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 18:55
 */

namespace commercium\repositories;

use commercium\models\User;
use framework\components\Repository;

/**
 * Repository for users class
 * @package commercium\repositories
 */
class Users extends Repository {
    public static function getTable() {
        return "users";
    }

    public static function getModel() {
        return User::class;
    }
}