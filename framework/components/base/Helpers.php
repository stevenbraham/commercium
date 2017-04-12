<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:04
 */

namespace framework\components\base;


use framework\traits\CanAccessCore;

class Helpers {
    /**
     * This functions aborts all execution
     * and throws an http error
     * @param int $httpCode
     * @param string $message optional message you want to display
     */
    public static function throwHttpError($httpCode, $message = "") {
        http_response_code($httpCode);
        $layoutParams = [
            'language' => 'en',
            'title' => $httpCode
        ];
        require_once FRAMEWORK_BASE_PATH . 'commercium/views/layout/header.php';
        echo "<div class='col-md-6 col-md-offset-3 text-center'><h2>{$message}</h2>" . Html::a('', 'Home', 'btn btn-lg btn-info btn-block') . "</div>";
        require_once FRAMEWORK_BASE_PATH . 'commercium/views/layout/footer.php';
        die();
    }

    /**
     * Retrieves a parameter from Get or Post
     * Supports returning a default value
     * In case the parameter is empty or not found
     * @param string $name
     * @param string $mode valid options are get and post
     * @param string $default
     * @throws \Exception
     * @return string
     */
    public static function getInputParameter($name, $mode = "get", $default = "") {
        /**
         * Array with modes my function can handle
         */
        $supportedModes = [
            'post' => INPUT_POST,
            'get' => INPUT_GET
        ];
        if (!array_key_exists($mode, $supportedModes)) {
            //invalid mode used
            throw new \Exception("Unsupported mode used, please use 'post' or 'get'");
        }
        $value = filter_input($supportedModes[$mode], $name, FILTER_SANITIZE_STRING);
        //check if value from post/get is valid, otherwise return $default
        return !empty($value) ? $value : $default; //short hand if statement for cleaner code
    }

    /**
     * Provides a shorter route to PDO::quote
     * @param $string
     * @see PDO::quote()
     * @return string
     */
    public static function sanitizeForSQL($string) {
        return Core::getInstance()->database->quote($string);
    }

    /**
     * Gets an url for a local file prepend with the path
     * of the directory where this app is hosted
     * @param $path the path of the file
     * @param bool $absolute prepend http://domain
     * @return string
     */
    public static function getUrl($path, $absolute = false) {
        return $absolute ? FRAMEWORK_BASE_URL . $path : str_replace("//" . $_SERVER['HTTP_HOST'], "", FRAMEWORK_BASE_URL) . $path;
    }

    /**
     * Debug function for quickly viewing variable values
     * @param mixed $variable
     */
    public static function dumpAndDie($variable) {
        var_dump($variable);
        die;
    }
}