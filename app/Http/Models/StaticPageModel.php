<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Editorial pages — the privacy policy, the terms, the contact page.
 *
 * The CMS's own module, reached in the admin under Pages. Their content is
 * written in TinyMCE and rendered as HTML, so it is the admin's to change
 * without a deploy, which is the whole point of a page like a privacy policy.
 *
 * `name_alias` is the slug the URL uses; `fgfooter` decides whether the page
 * is listed in the footer.
 */
class StaticPageModel extends Model
{
    protected $table = 'static_page';

    protected $fillable = [
        'name', 'name_alias', 'meta_title', 'meta_description', 'meta_keywords',
        'image', 'content', 'publish', 'fgdisplay', 'fgfooter', 'order_id',
    ];

    protected $casts = ['publish' => 'boolean'];

    /** One published page by its slug, or null. */
    public static function findBySlug($slug)
    {
        return static::where('name_alias', $slug)->where('publish', 1)->first();
    }

    /** The pages the footer lists, in the admin's order. */
    public static function forFooter()
    {
        return static::where('publish', 1)->where('fgfooter', 1)
            ->orderBy('order_id')->orderBy('id')->get();
    }

    public function getUrlAttribute()
    {
        return url($this->name_alias);
    }

    /** What the <title> and meta description should say. */
    public function getPageTitleAttribute()
    {
        return $this->meta_title ?: $this->name;
    }
}
