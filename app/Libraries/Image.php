<?php

namespace terre\Libraries;

use Imagine\Gd\Imagine;

/**
 * Replacement for the Image:: facade from folklore/image.
 *
 * folklore/image is only a thin Laravel wrapper around imagine/imagine, but it
 * pins illuminate/support to ~5.0, which hard-blocks Laravel 6 and beyond. The
 * underlying imagine/imagine is still maintained and has no framework
 * coupling at all, so it stays — this class supplies the facade folklore used
 * to provide.
 *
 * Keeping Imagine means every downstream call the CMS makes is untouched:
 * ->thumbnail(new Box(w, h)), ->effects()->colorize()/blur()/negative()/
 * grayscale(), ->palette()->color() and ->save() all still work, and thumbnail
 * output is byte-for-byte what it was before. Porting to intervention/image
 * would have meant rewriting the filter chain in ScaffoldController and
 * risking silent changes to every generated thumbnail.
 */
class Image
{
    /**
     * The shared Imagine driver instance.
     *
     * @var \Imagine\Gd\Imagine|null
     */
    protected static $imagine;

    /**
     * Open an image from a path.
     *
     * @param  string  $path
     * @return \Imagine\Image\ImageInterface
     */
    public static function open($path)
    {
        return static::imagine()->open($path);
    }

    /**
     * Create a new empty image.
     *
     * @param  \Imagine\Image\BoxInterface  $size
     * @param  \Imagine\Image\Palette\Color\ColorInterface|null  $background
     * @return \Imagine\Image\ImageInterface
     */
    public static function create($size, $background = null)
    {
        return static::imagine()->create($size, $background);
    }

    /**
     * Load an image from a binary string.
     *
     * @param  string  $string
     * @return \Imagine\Image\ImageInterface
     */
    public static function load($string)
    {
        return static::imagine()->load($string);
    }

    /**
     * The underlying Imagine driver, instantiated on first use.
     *
     * @return \Imagine\Gd\Imagine
     */
    public static function imagine()
    {
        if (is_null(static::$imagine)) {
            static::$imagine = new Imagine();
        }

        return static::$imagine;
    }
}
