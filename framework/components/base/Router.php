<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 21:17
 */

namespace framework\components\base;

use framework\traits\CanAccessCore;

/**
 * Handles routing of my application
 * @package framework\components\base
 */
class Router {
    use CanAccessCore;

    public function parseRequest() {
        //first I retrieve the page the person wants to view, the class and method are prepended to prevent someone from randomly executing classes
        $controllerName = strtolower($this->getCore()->helpers->getInputParameter('controller', 'get', 'home')) . "Controller";
        $actionName = "action" . ucfirst($this->getCore()->helpers->getInputParameter('action', 'get', 'index'));
        //check if a valid controller exists
        $controllerClassName = "commercium\controllers\\" . $controllerName;
        if (class_exists($controllerClassName)) {
            //controller exist
            $controller = new $controllerClassName;
            if (method_exists($controller, $actionName)) {
                //execute the action
                return (new \ReflectionMethod($controllerClassName, $actionName))->invoke($controller);
            }
        }
        //something went wrong if this line is reached
        $this->getCore()->helpers->throwHttpError(404);
    }

}