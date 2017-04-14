<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 30-03-17
 * Time: 22:26
 */

namespace framework\components\base;

/**
 * Helpers for simple html functions
 * @package framework\components\base
 */
class Html {
    public static function link($path, $rel = "stylesheet") {
        return static::element('link', '', ['rel' => $rel, 'href' => Helpers::getUrl($path)]);
    }

    /**
     * Renders an html element
     * @param string $tag
     * @param string $content if empty a single block level element is returned
     * @param array $attributes
     * @param bool $onlyOpen
     * @return string
     */
    public static function element($tag, $content = "", $attributes = [], $onlyOpen = false) {
        $element = "<{$tag} ";
        foreach ($attributes as $attributeLabel => $attributeValue) {
            if (!empty($attributeValue)) {
                $element .= $attributeLabel . '="' . $attributeValue . '" ';
            }
        }
        if (!$onlyOpen) {
            $element .= !empty($content) ? ">{$content}</{$tag}>" : "/>";
        } else {
            $element .= ">";
        }
        return trim($element);
    }

    public static function inputField($name, $value = '', $class = '', $type = 'text', $required = true) {
        return static::element('input', '', [
            'type' => $type,
            'value' => $value,
            'class' => $class,
            'name' => $name,
            'id' => $name,
            'required' => $required
        ]);
    }

    public static function checkbox($name, $value, $checked = false) {
        return static::element('input', '', [
            'type' => 'checkbox',
            'value' => $value,
            'name' => $name,
            'id' => $name,
            'checked' => $checked
        ]);
    }

    public static function openForm($action, $method = "post") {
        return static::element('form', '', ['action' => Helpers::getUrl($action), 'method' => $method], true);
    }

    /**
     * Returns a li item that gets active if the current controller is the path
     * @param string $label
     * @param string $controller
     * @return string
     */
    public static function menuItem($label, $controller) {
        return static::element('li', static::a($controller, $label), ['class' => (Router::currentController() == $controller ? "active" : "")]);
    }

    public static function a($path, $label, $class = "") {
        return static::element("a", $label, ['href' => Helpers::getUrl($path), 'class' => $class]);
    }
}