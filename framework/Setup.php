<?php

/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 13:52
 */

namespace framework;

use Dotenv\Dotenv;
use framework\components\base\Core;
use framework\exceptions\setup\EnvFileMissingException;
use framework\exceptions\setup\RequiredEnvVariableMissingException;

class Setup {
    /**
     * acts as a facade for all other startup tasks
     * Includes framework files
     * Loads env files
     * connects to database
     * @return Core
     * @throws \Exception
     */
    public static function boot() {
        //set base path
        define('FRAMEWORK_BASE_PATH', __DIR__ . '/../');
        //load env files
        if (file_get_contents(FRAMEWORK_BASE_PATH . "/.env")) {
            (new Dotenv(FRAMEWORK_BASE_PATH))->load();
        } else {
            //no env file found
            throw new EnvFileMissingException();
        }
        //check if env file is populated
        $requiredEnvVariables = ['DB_HOST', 'DB_USER', 'DB_PASSWORD', 'DB_NAME', 'APP_URL'];
        foreach ($requiredEnvVariables as $requiredEnvVariable) {
            if (empty(getenv($requiredEnvVariable))) {
                throw new RequiredEnvVariableMissingException($requiredEnvVariable);
            }
        }
        //set protocol independent base url
        define("FRAMEWORK_BASE_URL", str_replace(['https:', 'http:'], "", getenv("APP_URL")));
        //load other framework files
        $frameworkFiles = glob('framework/**/*.php');
        foreach ($frameworkFiles as $frameworkFile) {
            if (file_exists($frameworkFile)) {
                require_once $frameworkFile;
            }
        }
        //load app files
        $appFiles = glob('commercium/**/*.php');
        foreach ($appFiles as $appFile) {
            if (file_exists($appFile)) {
                require_once $appFile;
            }
        }
        //create core object and populate it
        return new Core();
    }
}