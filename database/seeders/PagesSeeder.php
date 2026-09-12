<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use terre\Http\Models\StaticPageModel;

/**
 * The three pages the footer links to.
 *
 * The text below is a starting point, not legal advice — it is accurate about
 * what this site actually does, which is the part a generic template gets
 * wrong, but it names no company details and makes no promises about retention
 * or jurisdiction. Someone has to read it and finish it, and that is why it
 * lives in the admin's editor rather than in a Blade file.
 *
 * Idempotent on the slug, and it never overwrites a page that has been edited:
 * once the content differs from what was seeded, the row is left alone.
 */
class PagesSeeder extends Seeder
{
    public function run()
    {
        $order = 0;

        foreach ($this->pages() as $slug => $page) {
            $row = StaticPageModel::where('name_alias', $slug)->first();

            if ($row && trim($row->content) !== '' && $row->content !== $this->seeded($row)) {
                // Somebody has written on it. Leave every word alone.
                continue;
            }

            $row = $row ?: new StaticPageModel;

            $row->name             = $page['name'];
            $row->name_alias       = $slug;
            // No site name here: the layout appends it to every title already.
            $row->meta_title       = $page['name'];
            $row->meta_description = $page['summary'];
            $row->content          = $page['content'];
            $row->publish          = 1;
            $row->fgfooter         = empty($page['footer']) ? 0 : 1;
            $row->fgdisplay        = 0;
            $row->order_id         = $order++;
            $row->save();
        }

        $this->retireTemplatePages();

        $this->command->info('Seeded the privacy, terms and contact pages.');
    }

    /**
     * The dump ships a "CURRENCY" page — the money changer's exchange-rate
     * table. Every published page is now reachable by its slug, so it was
     * quietly live on a tennis site. Unpublished rather than deleted, and only
     * while it is still the untouched original: anything anyone has edited is
     * theirs, and named by slug so a page someone adds later is never caught.
     */
    private function retireTemplatePages()
    {
        $page = StaticPageModel::where('name_alias', 'currency')->where('publish', 1)->first();

        if ($page && str_contains((string) $page->content, 'table-currency')) {
            $page->publish = 0;
            $page->save();

            $this->command->info('Unpublished the template\'s leftover currency page.');
        }
    }

    /** What this seeder would have written, for the untouched check above. */
    private function seeded($row)
    {
        $pages = $this->pages();

        return isset($pages[$row->name_alias]) ? $pages[$row->name_alias]['content'] : null;
    }

    private function pages()
    {
        return [
            'privacy-policy' => [
                'footer'  => true,
                'name'    => 'Privacy Policy',
                'summary' => 'What the Jaya Tennis Championship collects when you enter, and what happens to it.',
                'content' => '<p><strong>This page is a starting point and has not been reviewed by a lawyer.'
                    . ' Check it before the site goes live.</strong></p>'
                    . '<h2>What we collect</h2>'
                    . '<p>When you enter the tournament we ask for the names of the players, an email address,'
                    . ' a WhatsApp number, and optionally the club or company you play for. If you pay by'
                    . ' transfer we also store the proof of payment you upload.</p>'
                    . '<h2>Why we collect it</h2>'
                    . '<ul>'
                    . '<li>To confirm your entry and check that the fee has been paid.</li>'
                    . '<li>To contact you about the draw, the order of play, and changes to either.</li>'
                    . '<li>To publish the players and results of the tournament, which is the point of a'
                    . ' public draw.</li>'
                    . '</ul>'
                    . '<h2>What is published</h2>'
                    . '<p>Player and club names appear on the teams, draw, schedule and results pages once'
                    . ' an entry is confirmed. Your email address, phone number and proof of payment are'
                    . ' never published and are visible only to the organisers.</p>'
                    . '<h2>Who else sees it</h2>'
                    . '<p>Nobody outside the organising committee. We do not sell or share entrant details,'
                    . ' and we do not pass them to sponsors.</p>'
                    . '<h2>Your choices</h2>'
                    . '<p>Ask us to correct or remove your details at any time using the contact page.'
                    . ' Withdrawing an entry removes it from the published pages.</p>',
            ],

            'terms-conditions' => [
                'footer'  => true,
                'name'    => 'Terms & Conditions',
                'summary' => 'The terms that apply when you enter the Jaya Tennis Championship.',
                'content' => '<p><strong>This page is a starting point and has not been reviewed by a lawyer.'
                    . ' Check it before the site goes live.</strong></p>'
                    . '<h2>Entering</h2>'
                    . '<p>An entry is a request, not a place. It is confirmed once the organisers have'
                    . ' checked your payment, and you will be told when that happens. Entries close on the'
                    . ' date shown on the registration page.</p>'
                    . '<h2>Fees</h2>'
                    . '<p>The entry fee is shown on the registration page before you enter. Quote your'
                    . ' registration code on the transfer so we can match the payment to your entry.</p>'
                    . '<h2>The draw and the order of play</h2>'
                    . '<p>Seeding and the draw are made by the organisers, and their decision is final.'
                    . ' Times and courts may change at short notice; the schedule page carries the'
                    . ' current version.</p>'
                    . '<h2>Conduct</h2>'
                    . '<p>Players are expected to keep to the rules of tennis and to the spirit of the'
                    . ' event. The organisers may withdraw a player or a pair for conduct that spoils it'
                    . ' for everyone else.</p>'
                    . '<h2>Photography</h2>'
                    . '<p>Matches are photographed and filmed. Images may appear on this site and on the'
                    . ' tournament\'s social accounts. Tell us on the contact page if you would rather not'
                    . ' appear.</p>'
                    . '<h2>Cancellation</h2>'
                    . '<p>If the tournament cannot go ahead, the organisers will say so here and set out'
                    . ' what happens to entry fees.</p>',
            ],

            'rules-regulations' => [
                'name'    => 'Rules & Regulations',
                'summary' => 'How matches are played at the Jaya Tennis Championship.',
                'content' => '<p><strong>A starting point. Confirm every rule below with the'
                    . ' organising committee before entries open.</strong></p>'
                    . '<h2>Format</h2>'
                    . '<p>Matches are played as doubles in the category entered. The draw is a'
                    . ' knockout: lose once and you are out. The bracket is published on the draw page'
                    . ' when entries close.</p>'
                    . '<h2>Scoring</h2>'
                    . '<ul>'
                    . '<li>Best of three tie-break sets.</li>'
                    . '<li>A tie-break is played at six games all.</li>'
                    . '<li>No-advantage scoring at deuce, with the receiving pair choosing the side.</li>'
                    . '</ul>'
                    . '<h2>Turning up</h2>'
                    . '<p>Be at your court fifteen minutes before the time on the schedule. A pair more'
                    . ' than fifteen minutes late may be defaulted. Times can move during the day, so'
                    . ' check the schedule page rather than relying on the time you were first given.</p>'
                    . '<h2>Substitutes</h2>'
                    . '<p>The pair that enters is the pair that plays. Tell the organisers before your'
                    . ' first match if either player has to be replaced.</p>'
                    . '<h2>Balls, courts and dress</h2>'
                    . '<p>Balls are provided and changed as the organisers direct. Proper tennis shoes'
                    . ' are required. Shirts must be worn on court.</p>'
                    . '<h2>Calls and disputes</h2>'
                    . '<p>Players call their own lines and are expected to give the benefit of the doubt'
                    . ' to their opponents. A referee settles anything that cannot be agreed, and that'
                    . ' decision is final.</p>'
                    . '<h2>Weather</h2>'
                    . '<p>Play stops when the courts are unsafe. Suspended matches resume from the score'
                    . ' reached; the organisers may shorten later rounds to finish on time.</p>',
            ],

            'faq' => [
                'name'    => 'FAQ',
                'summary' => 'Common questions about entering and playing the Jaya Tennis Championship.',
                'content' => '<h2>How do I enter?</h2>'
                    . '<p>Fill in the form on the register page with both players\' names, an email'
                    . ' address and a WhatsApp number, and choose your category. You will be emailed a'
                    . ' registration code and the payment instructions.</p>'
                    . '<h2>When is my place confirmed?</h2>'
                    . '<p>Once an organiser has checked your payment. Until then the entry sits as'
                    . ' pending, and your club does not appear on the teams page.</p>'
                    . '<h2>How do I pay?</h2>'
                    . '<p>Transfer the entry fee and quote your registration code as the reference, then'
                    . ' upload the receipt on the confirmation page linked in your email. Without the'
                    . ' code we cannot match the payment to your entry.</p>'
                    . '<h2>I have lost my confirmation email.</h2>'
                    . '<p>Get in touch through the contact page with the name and email you entered'
                    . ' under, and we will resend it.</p>'
                    . '<h2>When is the draw made?</h2>'
                    . '<p>After entries close. It appears on the draw page as soon as it is published —'
                    . ' before that the page says so rather than showing an empty bracket.</p>'
                    . '<h2>How do I know when I play?</h2>'
                    . '<p>The schedule page carries the order of play with the court and time for every'
                    . ' tie, and it is the version to trust if anything changes.</p>'
                    . '<h2>Can I enter more than one category?</h2>'
                    . '<p>Yes. Enter each one separately; each entry has its own fee and its own code.</p>'
                    . '<h2>Can I get a refund?</h2>'
                    . '<p>Ask on the contact page. What happens if the tournament cannot go ahead is set'
                    . ' out in the terms.</p>',
            ],

            'contact' => [
                'footer'  => true,
                'name'    => 'Contact',
                'summary' => 'How to reach the organisers of the Jaya Tennis Championship.',
                'content' => '<p><strong>Replace the details below with the real ones before the site goes'
                    . ' live.</strong> Edit this page under Pages in the admin.</p>'
                    . '<h2>Tournament office</h2>'
                    . '<p>Hipmi Jaya Tennis Club<br>Jakarta, Indonesia</p>'
                    . '<h2>Email</h2>'
                    . '<p><a href="mailto:info@jayatennischampionship.com">info@jayatennischampionship.com</a></p>'
                    . '<h2>WhatsApp</h2>'
                    . '<p>Add the number entrants should use for questions about the draw or their entry.</p>'
                    . '<h2>Entries</h2>'
                    . '<p>Questions about an entry are answered fastest if you quote the registration code'
                    . ' from your confirmation email.</p>',
            ],
        ];
    }
}
