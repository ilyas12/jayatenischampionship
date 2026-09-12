<?php

namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The social accounts in the footer, from the CMS's own module — these are
 * site-wide, not per-edition, so there is nothing to scope them to and the
 * existing screen under Global Configurations already manages them.
 */
class SocialLinkModel extends Model
{
    protected $table = 'social_link';

    protected $fillable = ['name', 'username', 'icon', 'link', 'order_id', 'publish'];

    protected $casts = ['publish' => 'boolean'];

    /**
     * Published accounts that actually point somewhere, in the admin's order.
     *
     * An account with no link is a row someone started and did not finish; in
     * the footer it would be an icon that goes nowhere, so it is left out.
     */
    public static function published()
    {
        return static::where('publish', 1)
            ->whereNotNull('link')->where('link', '!=', '')
            ->orderBy('order_id')->orderBy('id')->get();
    }

    /**
     * Which icon to draw. The module stores a FontAwesome class from 2017
     * ("fa-instagram"); this theme draws its own SVGs and keys them on the
     * bare platform name, so the class is reduced to that and the account name
     * is the fallback for a row that has no icon set.
     */
    public function getIconSlugAttribute()
    {
        $slug = $this->icon
            ? preg_replace('/^fa[brs]?-/', '', trim($this->icon))
            : $this->name;

        $slug = strtolower(trim((string) $slug));

        // A couple of names the module and the icon set spell differently.
        $aliases = [
            'x'         => 'twitter',
            'x-twitter' => 'twitter',
            'youtube-play' => 'youtube',
            'linkedin-square' => 'linkedin',
            'instagram-square' => 'instagram',
        ];

        return isset($aliases[$slug]) ? $aliases[$slug] : $slug;
    }
}
