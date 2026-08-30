<?php

namespace terre\Libraries;

class Asset
{
    /**
     * asset() with an mtime query string, so a browser cannot serve a stale
     * stylesheet after an edit. Shared by the spd and tennis layouts.
     */
    public static function v($path)
    {
        $full = base_path($path);

        return asset($path) . (file_exists($full) ? '?v=' . filemtime($full) : '');
    }
}
