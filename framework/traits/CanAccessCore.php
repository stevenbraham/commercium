<?php

/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 18:56
 */

namespace framework\traits;

use framework\components\base\Core;

/**
 * trait for classes that need to interact with the core singletons
 * @package framework\traits
 */
trait CanAccessCore {

    /**
     * Returns an reference to the global core object
     * @return Core
     * @throws \Exception
     */
    private function &getCore() {
        global $framework;
        if ($framework instanceof Core) {
            //$framework is valid core instance
            return $framework;
        } else {
            throw new \Exception("No valid core instance found");
        }
    }
}