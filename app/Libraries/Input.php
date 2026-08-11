<?php

namespace terre\Libraries;

/**
 * Replacement for the Input:: facade, removed in Laravel 6.
 *
 * The CMS calls it from 257 places across 46 files, so rather than rewriting
 * every call to Request:: this reproduces the facade against the current
 * request. The semantics match the original exactly: Input::get() maps to
 * $request->input(), which reads query string, form body and JSON alike —
 * notably NOT $request->get(), which only reads the query string and would
 * silently break every POST in the admin panel.
 *
 * __callStatic() forwards anything not named here straight to the request, so
 * less common helpers keep working too.
 */
class Input
{
    /**
     * Retrieve an input item from the request.
     *
     * @param  string|null  $key
     * @param  mixed        $default
     * @return mixed
     */
    public static function get($key = null, $default = null)
    {
        return request()->input($key, $default);
    }

    /**
     * Retrieve old input from the session.
     *
     * @param  string|null  $key
     * @param  mixed        $default
     * @return mixed
     */
    public static function old($key = null, $default = null)
    {
        return request()->old($key, $default);
    }

    /**
     * All input for the request.
     *
     * @return array
     */
    public static function all()
    {
        return request()->all();
    }

    /**
     * Retrieve an uploaded file.
     *
     * @param  string|null  $key
     * @param  mixed        $default
     * @return \Illuminate\Http\UploadedFile|array|null
     */
    public static function file($key = null, $default = null)
    {
        return request()->file($key, $default);
    }

    /**
     * Whether the request carries the given uploaded file.
     *
     * Call sites spell this "hasfile"; PHP method names are case-insensitive,
     * so they resolve here.
     *
     * @param  string  $key
     * @return bool
     */
    public static function hasFile($key)
    {
        return request()->hasFile($key);
    }

    /**
     * Whether the given input key is present and non-empty.
     *
     * @param  string|array  $key
     * @return bool
     */
    public static function has($key)
    {
        return request()->has($key);
    }

    /**
     * All input except the given keys.
     *
     * @param  array|mixed  $keys
     * @return array
     */
    public static function except($keys)
    {
        return request()->except($keys);
    }

    /**
     * Only the given input keys.
     *
     * @param  array|mixed  $keys
     * @return array
     */
    public static function only($keys)
    {
        return request()->only($keys);
    }

    /**
     * Forward anything else to the current request.
     *
     * @param  string  $method
     * @param  array   $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([request(), $method], $arguments);
    }
}
