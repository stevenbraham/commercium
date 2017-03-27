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

class Setup {
    /**
     * acts as a facade for all other model factories
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
            throw new \Exception('env file missing');
        }
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