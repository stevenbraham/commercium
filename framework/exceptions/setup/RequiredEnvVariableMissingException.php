<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 29-03-17
 * Time: 20:52
 */

namespace framework\exceptions\setup;


class RequiredEnvVariableMissingException extends \Exception {
    public function __construct($variableName) {
        parent::__construct($variableName . " must be defined in .env and can't be empty");
    }
}