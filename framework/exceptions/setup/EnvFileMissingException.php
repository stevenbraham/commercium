<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 29-03-17
 * Time: 20:53
 */

namespace framework\exceptions\setup;


class EnvFileMissingException extends \Exception {
    public function __construct() {
        parent::__construct(".env file missing");
    }
}