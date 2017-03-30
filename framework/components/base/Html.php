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
    public static function a($path, $label, $class = "") {
        return static::element("a", $label, ['href' => Helpers::getUrl($path), 'class' => $class]);
    }


    /**
     * Renders an html element
     * @param string $tag
     * @param string $content if empty a single block level element is returned
     * @param array $attributes
     * @return string
     */
    public static function element($tag, $content = "", $attributes = []) {
        $element = "<{$tag} ";
        foreach ($attributes as $attributeLabel => $attributeValue) {
            if (!empty($attributeValue)) {
                $element .= $attributeLabel . '="' . $attributeValue . '" ';
            }
        }
        $element .= !empty($content) ? ">{$content}</{$tag}>" : "/>";
        return trim($element);
    }
}