<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 19:21
 */

namespace framework\components\base;

use commercium\repositories\Users;

/**
 * Loads all repositories from the app
 * @package framework\components\base
 */
final class Repositories {

    /**
     * @var Users $users
     */
    public $users;

    public function __construct() {
        $this->users = new Users();
    }
}