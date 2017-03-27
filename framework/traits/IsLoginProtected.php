<?php


namespace framework\traits;

use framework\components\base\SessionManagement;

/**
 * For controllers that need to be password protected
 * @package framework\traits
 */
trait IsLoginProtected {
    public function __construct() {
        if (!SessionManagement::isLoggedIn()) {
            return $this->redirectTo("login");
        }
    }
}