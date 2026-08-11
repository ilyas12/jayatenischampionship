<?php

namespace terre\Libraries\Html;

/**
 * Drop-in replacement for the HTML:: facade from illuminate/html.
 *
 * illuminate/html was abandoned after Laravel 5.0 and blocks the upgrade past
 * 5.4. Only the handful of methods this application actually calls are
 * implemented, and their output is byte-for-byte compatible with the original
 * so the ~190 existing call sites need no changes.
 */
class HtmlBuilder
{
    /**
     * Build an HTML attribute string from an array.
     *
     * Note the leading space when non-empty — the original did the same, and
     * call sites such as "<th ".HTML::attributes($a).">" rely on it.
     *
     * @param  array  $attributes
     * @return string
     */
    public static function attributes($attributes)
    {
        $html = [];

        foreach ((array) $attributes as $key => $value) {
            $element = static::attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     *
     * A numeric key means a boolean attribute, where the value is the name.
     *
     * @param  string  $key
     * @param  string  $value
     * @return string|null
     */
    protected static function attributeElement($key, $value)
    {
        if (is_numeric($key)) {
            $key = $value;
        }

        if (! is_null($value)) {
            return $key.'="'.e($value).'"';
        }

        return null;
    }

    /**
     * Convert an HTML string to entities.
     *
     * @param  string  $value
     * @return string
     */
    public static function entities($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }
}
