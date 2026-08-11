<?php

namespace terre\Libraries\Html;

/**
 * Drop-in replacement for the Form:: facade from illuminate/html.
 *
 * illuminate/html was abandoned after Laravel 5.0 and blocks the upgrade past
 * 5.4. Rather than swapping in laravelcollective/html — which is itself
 * abandoned and would need replacing again before Laravel 10 — this implements
 * only the methods the application calls, matching the original's output so
 * the existing call sites in resources/admin/views and ScaffoldController need
 * no changes.
 *
 * Two behaviours are deliberately faithful to the original rather than
 * "improved", because the admin templates depend on them:
 *
 *  - a field only gets an automatic id attribute if Form::label() was rendered
 *    for that same name earlier in the request;
 *  - field values fall back to old session input, so forms repopulate after a
 *    failed validation redirect.
 */
class FormBuilder
{
    /**
     * Field names that have had a label rendered for them this request.
     *
     * @var array
     */
    protected static $labels = [];

    /**
     * Input types that never repopulate from old input.
     *
     * @var array
     */
    protected static $skipValueTypes = ['file', 'password'];

    /**
     * Keys consumed by open() rather than emitted as attributes.
     *
     * @var array
     */
    protected static $reserved = ['method', 'url', 'route', 'action', 'files'];

    /**
     * Open a form.
     *
     * @param  array  $options
     * @return string
     */
    public static function open(array $options = [])
    {
        $method = isset($options['method']) ? $options['method'] : 'post';

        $attributes = [
            'method'         => static::getMethod($method),
            'action'         => static::getAction($options),
            'accept-charset' => 'UTF-8',
        ];

        if (isset($options['files']) && $options['files']) {
            $options['enctype'] = 'multipart/form-data';
        }

        foreach (static::$reserved as $key) {
            unset($options[$key]);
        }

        $attributes = array_merge($attributes, $options);

        return '<form'.HtmlBuilder::attributes($attributes).'>'.static::getAppendage($method);
    }

    /**
     * Close a form.
     *
     * @return string
     */
    public static function close()
    {
        static::$labels = [];

        return '</form>';
    }

    /**
     * Anything other than GET is submitted as POST, with the real verb spoofed.
     *
     * @param  string  $method
     * @return string
     */
    protected static function getMethod($method)
    {
        return strtoupper($method) === 'GET' ? 'GET' : 'POST';
    }

    /**
     * Resolve the form action from the given options.
     *
     * @param  array  $options
     * @return string
     */
    protected static function getAction(array $options)
    {
        if (isset($options['url'])) {
            return url($options['url']);
        }

        if (isset($options['route'])) {
            return is_array($options['route'])
                ? call_user_func_array('route', $options['route'])
                : route($options['route']);
        }

        if (isset($options['action'])) {
            return is_array($options['action'])
                ? call_user_func_array('action', $options['action'])
                : action($options['action']);
        }

        return url()->current();
    }

    /**
     * Hidden _method and _token fields appended after the opening tag.
     *
     * @param  string  $method
     * @return string
     */
    protected static function getAppendage($method)
    {
        $method = strtoupper($method);
        $appendage = '';

        if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
            $appendage .= static::hidden('_method', $method);
        }

        if ($method !== 'GET') {
            $appendage .= static::hidden('_token', csrf_token());
        }

        return $appendage;
    }

    /**
     * A text input.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public static function text($name, $value = null, $options = [])
    {
        return static::input('text', $name, $value, $options);
    }

    /**
     * A password input. Never repopulated.
     *
     * @param  string  $name
     * @param  array   $options
     * @return string
     */
    public static function password($name, $options = [])
    {
        return static::input('password', $name, '', $options);
    }

    /**
     * A hidden input.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public static function hidden($name, $value = null, $options = [])
    {
        return static::input('hidden', $name, $value, $options);
    }

    /**
     * A file input.
     *
     * @param  string  $name
     * @param  array   $options
     * @return string
     */
    public static function file($name, $options = [])
    {
        return static::input('file', $name, null, $options);
    }

    /**
     * A generic input element.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public static function input($type, $name, $value = null, $options = [])
    {
        if (! isset($options['name'])) {
            $options['name'] = $name;
        }

        $id = static::getIdAttribute($name, $options);

        if (! in_array($type, static::$skipValueTypes)) {
            $value = static::getValueAttribute($name, $value);
        }

        $options = array_merge($options, compact('type', 'value', 'id'));

        return '<input'.HtmlBuilder::attributes($options).'>';
    }

    /**
     * A textarea element.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public static function textarea($name, $value = null, $options = [])
    {
        if (! isset($options['name'])) {
            $options['name'] = $name;
        }

        $options = static::setTextAreaSize($options);

        $options['id'] = static::getIdAttribute($name, $options);

        $value = (string) static::getValueAttribute($name, $value);

        unset($options['size']);

        return '<textarea'.HtmlBuilder::attributes($options).'>'.e($value).'</textarea>';
    }

    /**
     * Apply the default or shorthand textarea dimensions.
     *
     * @param  array  $options
     * @return array
     */
    protected static function setTextAreaSize($options)
    {
        if (isset($options['size'])) {
            list($cols, $rows) = explode('x', $options['size']);

            return array_merge($options, compact('cols', 'rows'));
        }

        $cols = isset($options['cols']) ? $options['cols'] : 50;
        $rows = isset($options['rows']) ? $options['rows'] : 10;

        return array_merge($options, compact('cols', 'rows'));
    }

    /**
     * A label element. Also registers the name for automatic id resolution.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public static function label($name, $value = null, $options = [])
    {
        static::$labels[] = $name;

        $attributes = HtmlBuilder::attributes($options);

        $value = e($value ?: static::formatLabel($name));

        return '<label for="'.$name.'"'.$attributes.'>'.$value.'</label>';
    }

    /**
     * Turn a field name into a readable label.
     *
     * @param  string  $name
     * @return string
     */
    protected static function formatLabel($name)
    {
        return ucwords(str_replace('_', ' ', $name));
    }

    /**
     * A select element.
     *
     * @param  string  $name
     * @param  array   $list
     * @param  string  $selected
     * @param  array   $options
     * @return string
     */
    public static function select($name, $list = [], $selected = null, $options = [])
    {
        $selected = static::getValueAttribute($name, $selected);

        $options['id'] = static::getIdAttribute($name, $options);

        if (! isset($options['name'])) {
            $options['name'] = $name;
        }

        $html = [];

        foreach ((array) $list as $value => $display) {
            $html[] = static::getSelectOption($display, $value, $selected);
        }

        return '<select'.HtmlBuilder::attributes($options).'>'.implode('', $html).'</select>';
    }

    /**
     * An option, or an optgroup when the display value is itself a list.
     *
     * @param  string|array  $display
     * @param  string        $value
     * @param  string        $selected
     * @return string
     */
    protected static function getSelectOption($display, $value, $selected)
    {
        if (is_array($display)) {
            return static::optionGroup($display, $value, $selected);
        }

        return static::option($display, $value, $selected);
    }

    /**
     * An optgroup element.
     *
     * @param  array   $list
     * @param  string  $label
     * @param  string  $selected
     * @return string
     */
    protected static function optionGroup($list, $label, $selected)
    {
        $html = [];

        foreach ($list as $value => $display) {
            $html[] = static::option($display, $value, $selected);
        }

        return '<optgroup label="'.e($label).'">'.implode('', $html).'</optgroup>';
    }

    /**
     * A single option element.
     *
     * @param  string  $display
     * @param  string  $value
     * @param  string  $selected
     * @return string
     */
    protected static function option($display, $value, $selected)
    {
        $selected = static::getSelectedValue($value, $selected);

        $options = ['value' => $value, 'selected' => $selected];

        return '<option'.HtmlBuilder::attributes($options).'>'.e($display).'</option>';
    }

    /**
     * Whether the given option value is the selected one.
     *
     * The comparison is loose, matching the original: option keys arrive as
     * strings from the array while the selected value is often an integer
     * straight out of the database.
     *
     * @param  string  $value
     * @param  string  $selected
     * @return string|null
     */
    protected static function getSelectedValue($value, $selected)
    {
        if (is_array($selected)) {
            return in_array($value, $selected) ? 'selected' : null;
        }

        return ((string) $value === (string) $selected) ? 'selected' : null;
    }

    /**
     * A checkbox input.
     *
     * @param  string  $name
     * @param  mixed   $value
     * @param  bool    $checked
     * @param  array   $options
     * @return string
     */
    public static function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        return static::checkable('checkbox', $name, $value, $checked, $options);
    }

    /**
     * A radio input.
     *
     * @param  string  $name
     * @param  mixed   $value
     * @param  bool    $checked
     * @param  array   $options
     * @return string
     */
    public static function radio($name, $value = null, $checked = null, $options = [])
    {
        if (is_null($value)) {
            $value = $name;
        }

        return static::checkable('radio', $name, $value, $checked, $options);
    }

    /**
     * A checkbox or radio input.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  mixed   $value
     * @param  bool    $checked
     * @param  array   $options
     * @return string
     */
    protected static function checkable($type, $name, $value, $checked, $options)
    {
        $checked = static::getCheckedState($type, $name, $value, $checked);

        if ($checked) {
            $options['checked'] = 'checked';
        }

        return static::input($type, $name, $value, $options);
    }

    /**
     * Resolve the checked state, preferring old input.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  mixed   $value
     * @param  bool    $checked
     * @return bool
     */
    protected static function getCheckedState($type, $name, $value, $checked)
    {
        $old = static::old($name);

        if (! is_null($old)) {
            if ($type === 'checkbox') {
                return is_array($old) ? in_array($value, $old) : (bool) $old;
            }

            return (string) $old === (string) $value;
        }

        return (bool) $checked;
    }

    /**
     * Resolve a field's value, preferring old input from the session.
     *
     * @param  string  $name
     * @param  string  $value
     * @return mixed
     */
    protected static function getValueAttribute($name, $value = null)
    {
        if (is_null($name)) {
            return $value;
        }

        $old = static::old($name);

        if (! is_null($old)) {
            return $old;
        }

        return $value;
    }

    /**
     * Old input for a field, if any.
     *
     * @param  string  $name
     * @return mixed
     */
    protected static function old($name)
    {
        if (is_null($name)) {
            return null;
        }

        $session = app('session.store');

        if (! $session) {
            return null;
        }

        return $session->getOldInput(static::transformKey($name));
    }

    /**
     * Convert a bracketed field name into dot notation for session lookup.
     *
     * @param  string  $key
     * @return string
     */
    protected static function transformKey($key)
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $key);
    }

    /**
     * The id attribute for a field: an explicit one, otherwise the field name
     * but only when a label was rendered for it.
     *
     * @param  string  $name
     * @param  array   $attributes
     * @return string|null
     */
    protected static function getIdAttribute($name, $attributes)
    {
        if (array_key_exists('id', $attributes)) {
            return $attributes['id'];
        }

        if (in_array($name, static::$labels)) {
            return $name;
        }

        return null;
    }
}
