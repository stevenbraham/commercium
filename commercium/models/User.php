<?php

/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 14:39
 */

namespace commercium\models;

use framework\components\Model;

class User extends Model {
    public $firstname, $lastname, $password, $email;
}