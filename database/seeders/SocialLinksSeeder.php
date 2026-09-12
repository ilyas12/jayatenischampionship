<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use terre\Http\Models\SocialLinkModel;

/**
 * The social accounts the footer draws.
 *
 * Separate from TournamentSeeder because these are site-wide: they belong to
 * the club, not to one edition of the tournament.
 *
 * The dump ships with the template author's own accounts — "@terre" on
 * Facebook, Twitter and Instagram, pointing at those sites' homepages. They
 * are not this club's, and a footer icon that goes to instagram.com is worse
 * than no icon, so they are unpublished rather than deleted: one click in the
 * admin brings any of them back, and nothing anybody typed is destroyed.
 *
 * The three the design shows are created with no link. The footer only renders
 * accounts that point somewhere, so they stay invisible until someone fills in
 * the real handle under Global Configurations > Social Link.
 */
class SocialLinksSeeder extends Seeder
{
    /** name => FontAwesome class the module stores, in display order */
    private $wanted = [
        'Instagram' => 'fa-instagram',
        'Youtube'   => 'fa-youtube',
        'LinkedIn'  => 'fa-linkedin',
    ];

    public function run()
    {
        $order = 0;

        foreach ($this->wanted as $name => $icon) {
            $link = SocialLinkModel::where('name', $name)->first() ?: new SocialLinkModel;

            $link->name     = $name;
            $link->icon     = $icon;
            $link->order_id = $order++;
            $link->publish  = 1;

            // Never overwrite a handle somebody has entered — but the dump's
            // links are the bare sites, "https://instagram.com/" with nothing
            // after the slash, which point at no account at all. A real handle
            // has a path; a bare domain is a placeholder and is cleared.
            $link->link     = $this->isRealHandle($link->link) ? $link->link : '';
            $link->username = $link->username ?: null;

            $link->save();
        }

        $retired = SocialLinkModel::whereNotIn('name', array_keys($this->wanted))
            ->where('publish', 1)->get();

        foreach ($retired as $link) {
            $link->publish = 0;
            $link->save();
        }

        $this->command->info(sprintf(
            'Social: %d accounts ready for a handle, %d template leftovers unpublished.',
            count($this->wanted), $retired->count()
        ));
    }

    /** A URL that names an account, rather than just the site it lives on. */
    private function isRealHandle($link)
    {
        $link = trim((string) $link);

        if ($link === '') {
            return false;
        }

        $path = trim((string) parse_url($link, PHP_URL_PATH), '/');

        return $path !== '';
    }
}
