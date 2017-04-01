<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 18:22
 */

namespace framework\components;

use framework\components\base\Helpers;
use framework\traits\CanAccessCore;

/**
 * The controller base class
 * @package framework\components
 */
abstract class Controller {

    /**
     * General params for the layout files
     * Mainly meant for header files
     * @var array
     */
    protected $layoutParams = [
        'title' => '',
        'language' => 'en',
        'breadcrumbs' => [],
    ];

    /**
     * Renders a file from a class views folder
     * Will automatically append/prepend footer and header
     * @param string $viewName the file name without .php
     * @param array $params optional array with parameters for the view
     * @param bool $return if set to true instead of echoing, the function will return the generated html
     * @return void|string will only return something if $return is set to true
     * @throws \Exception
     */
    public final function render($viewName, $params = [], $return = false) {
        /**
         * first the class of the object gets calculated
         * than I remove the namespace
         * afterwards I do a to lower because view folders are based on lowercase
         * finally I append the view name
         */
        $requestedView = FRAMEWORK_BASE_PATH . 'commercium/views/' . strtolower(str_replace("commercium\controllers\\", "", get_class($this))) . '/' . $viewName . '.php';
        $requestedView = str_replace("controller", "", $requestedView);
        //check if view exist
        if (!file_exists($requestedView)) {
            throw new \Exception('View ' . $viewName . ' not found in path' . $requestedView);
            die;
        }
        //explode params so the vars can be used normally in the views
        extract($params);
        $layoutParams = $this->layoutParams;
        if ($return === true) {
            //use object buffer to catch the output of the require statements
            ob_start();
            require FRAMEWORK_BASE_PATH . 'commercium/views/layout/header.php';
            require $requestedView;
            require FRAMEWORK_BASE_PATH . 'commercium/views/layout/footer.php';
            return ob_get_clean();
        }
        //normally we just require and output the result in the browser
        require FRAMEWORK_BASE_PATH . 'commercium/views/layout/header.php';
        require $requestedView;
        require FRAMEWORK_BASE_PATH . 'commercium/views/layout/footer.php';
    }

    /**
     * Redirects the page to a location
     * @param string $controller
     * @param string $action
     */
    public function redirectTo($controller, $action = "index") {
        header('Location: ' . Helpers::getUrl($controller . "/" . $action));
    }
}