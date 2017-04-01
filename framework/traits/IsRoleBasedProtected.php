<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 01-04-17
 * Time: 23:29
 */

namespace framework\traits;

use framework\components\base\Helpers;
use framework\components\base\SessionManagement;

/**
 * Protects routes from unauthorized access
 * @package framework\traits
 */
trait IsRoleBasedProtected {

    /**
     * Checks if the current user has the required role
     * @param $roleSlug
     * @return true check passed
     */
    public function roleCheck($roleSlug) {
        return SessionManagement::getUser()->isMemberOfGroup($roleSlug) ? true : Helpers::throwHttpError(403, "You are not allowed to do this");
    }
}