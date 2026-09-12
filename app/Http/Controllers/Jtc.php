<?php

namespace terre\Http\Controllers;

/**
 * Jaya Tennis Championship — 2026 theme.
 *
 * A slice of JTC_Desktop_Master_New.psd, one method per artboard. The copy and
 * the sample rows are the PSD's own, held here as arrays rather than written
 * into the templates: the markup then loops over data, so wiring a section to
 * the CMS later is a matter of swapping an array for a query without touching
 * the Blade.
 *
 * Deliberately not extending the CMS's base Controller. That constructor loads
 * site configuration and static content this theme does not read, and every
 * page would pay for queries it never uses.
 */
class Jtc extends \Illuminate\Routing\Controller
{
    public function home()
    {
        return view('jtc.jtc_home', [
            'active'     => 'jtc_home',
            'facts'      => $this->facts(),
            'quickLinks' => [
                [
                    'icon'    => 'calendar',
                    'title'   => 'Schedule',
                    'caption' => ['View match schedule', 'and court information'],
                    'url'     => route('jtc_schedule'),
                ],
                [
                    'icon'    => 'bracket',
                    'title'   => 'Draw',
                    'caption' => ['Follow the latest', 'tournament draw'],
                    'url'     => route('jtc_draw'),
                ],
                [
                    'icon'    => 'document',
                    'title'   => 'Register',
                    'caption' => ['Be part of', 'Jaya Tennis Championship'],
                    'url'     => route('jtc_register'),
                ],
            ],
            'pillars' => [
                ['icon' => 'people', 'title' => 'Competition', 'text' => 'Play at your best'],
                ['icon' => 'people', 'title' => 'Networking',  'text' => 'Meet new people'],
                ['icon' => 'chart',  'title' => 'Community',   'text' => 'A stronger tennis ecosystem'],
            ],
            'stats' => [
                ['value' => '200+', 'label' => 'Players'],
                ['value' => '50+',  'label' => 'Companies'],
                ['value' => '300+', 'label' => 'Matches'],
                ['value' => '1',    'label' => "Stronger\nCommunity"],
            ],
            'partners' => [
                ['name' => 'Jaya',        'file' => 'jtc_partner_jaya.png'],
                ['name' => 'BCA',         'file' => 'jtc_partner_bca.png'],
                ['name' => 'HEAD',        'file' => 'jtc_partner_head.png'],
                ['name' => 'Wilson',      'file' => 'jtc_partner_wilson.png'],
                ['name' => 'Pocari Sweat','file' => 'jtc_partner_pocari.png'],
                ['name' => 'Le Minerale', 'file' => 'jtc_partner_le_minerale.png'],
                ['name' => 'ASICS',       'file' => 'jtc_partner_asics.png'],
            ],
        ]);
    }

    public function pastWinners()
    {
        $winners = [
            2025 => [
                ['category' => "Men's Doubles",      'names' => 'Andreas / Michael',   'photo' => 'jtc_champion_1.jpg'],
                ['category' => "Women's Doubles",    'names' => 'Cindy / Felicia',     'photo' => 'jtc_champion_2.jpg'],
                ['category' => 'Mixed Doubles',      'names' => 'Raymond / Nathalie',  'photo' => 'jtc_champion_3.jpg'],
                ['category' => 'Spirit of the Game', 'names' => 'Daniel Wirawan',      'photo' => 'jtc_champion_4.jpg'],
            ],
        ];

        // The PSD only dresses 2025. The other tabs are real years with no
        // content yet rather than copies of 2025 pretending to be history.
        foreach ([2024, 2023, 2022, 2021] as $year) {
            $winners[$year] = [];
        }

        return view('jtc.jtc_past_winners', [
            'active'  => 'jtc_past_winners',
            'years'   => [2025, 2024, 2023, 2022, 2021],
            'winners' => $winners,
        ]);
    }

    public function schedule()
    {
        return view('jtc.jtc_schedule', [
            'active' => 'jtc_schedule',
            'days' => [
                ['key' => 'd1', 'label' => 'Day 1', 'date' => 'Mon, 12 Oct'],
                ['key' => 'd2', 'label' => 'Day 2', 'date' => 'Tue, 13 Oct'],
                ['key' => 'd3', 'label' => 'Day 3', 'date' => 'Wed, 14 Oct'],
                ['key' => 'd4', 'label' => 'Day 4', 'date' => 'Thu, 15 Oct'],
                ['key' => 'd5', 'label' => 'Day 5', 'date' => 'Fri, 16 Oct'],
                ['key' => 'd6', 'label' => 'Day 6', 'date' => 'Sat, 17 Oct'],
                ['key' => 'd7', 'label' => 'Day 7', 'date' => 'Sun, 18 Oct'],
            ],
            'categories' => ["Men's Doubles", "Women's Doubles", 'Mixed Doubles'],
            'matches' => [
                ['day' => 'd1', 'time' => '08:00', 'court' => '1', 'category' => "Men's Doubles",   'round' => 'Round 1',      'home' => 'R. Santoso / A. Pratama',  'away' => 'D. Wijaya / H. Kurniawan', 'status' => 'Completed'],
                ['day' => 'd1', 'time' => '09:30', 'court' => '1', 'category' => "Women's Doubles", 'round' => 'Round 1',      'home' => 'C. Angelina / F. Lestari', 'away' => 'M. Hartono / S. Dewi',     'status' => 'Completed'],
                ['day' => 'd1', 'time' => '11:00', 'court' => '2', 'category' => 'Mixed Doubles',   'round' => 'Round 1',      'home' => 'B. Gunawan / N. Putri',    'away' => 'T. Wijaya / R. Sari',      'status' => 'Completed'],
                ['day' => 'd2', 'time' => '13:00', 'court' => '1', 'category' => "Men's Doubles",   'round' => 'Round 2',      'home' => 'A. Salim / R. Hartono',    'away' => 'Y. Prabowo / D. Susanto',  'status' => 'Upcoming'],
                ['day' => 'd2', 'time' => '14:30', 'court' => '2', 'category' => "Women's Doubles", 'round' => 'Quarter Final','home' => 'K. Natalia / V. Lim',      'away' => 'J. Gunadi / P. Tan',       'status' => 'Upcoming'],
                ['day' => 'd2', 'time' => '16:00', 'court' => '1', 'category' => 'Mixed Doubles',   'round' => 'Quarter Final','home' => 'D. Santoso / L. Chen',     'away' => 'A. Wijaya / M. Kusuma',    'status' => 'Upcoming'],
            ],
        ]);
    }

    public function draw()
    {
        return view('jtc.jtc_draw', [
            'active' => 'jtc_draw',
            'draws'  => [
                'md' => ['name' => "Men's Doubles",   'rounds' => $this->bracket()],
                'wd' => ['name' => "Women's Doubles", 'rounds' => $this->bracket(true)],
                'xd' => ['name' => 'Mixed Doubles',   'rounds' => $this->bracket(true)],
            ],
        ]);
    }

    public function register()
    {
        $facts = $this->facts();
        $facts[3]['label'] = 'Registration period';

        return view('jtc.jtc_register', [
            'active'     => 'jtc_register',
            'facts'      => $facts,
            'categories' => [
                ['value' => 'md', 'name' => "Men's Doubles"],
                ['value' => 'wd', 'name' => "Women's Doubles"],
                ['value' => 'xd', 'name' => 'Mixed Doubles'],
            ],
            'information' => [
                ['icon' => 'document', 'label' => 'Entry Fee',           'value' => 'TBA'],
                ['icon' => 'people',   'label' => 'Tournament Format',   'value' => 'TBA'],
                ['icon' => 'calendar', 'label' => 'Rules & Regulations', 'value' => 'View Details', 'url' => '#'],
                ['icon' => 'document', 'label' => 'FAQ',                 'value' => 'View FAQ',     'url' => '#'],
            ],
        ]);
    }

    /**
     * The four-column strip shared by the home and register pages. Register
     * relabels the last column, which is the only difference between them.
     */
    private function facts()
    {
        return [
            ['icon' => 'calendar', 'label' => 'Tournament date', 'value' => 'TBA', 'note' => '2026'],
            ['icon' => 'pin',      'label' => 'Venue',           'value' => 'Jakarta', 'note' => 'Indonesia'],
            ['icon' => 'people',   'label' => 'Categories',      'list'  => ["Men's Doubles", "Women's Doubles", 'Mixed Doubles']],
            ['icon' => 'trophy',   'label' => 'Open for registration', 'value' => 'Coming soon', 'note' => 'Stay tuned'],
        ];
    }

    /**
     * An eight-pair bracket: the first round named, everything after it an
     * empty slot waiting on a result. `linked` draws the connector to the
     * right of a column.
     *
     * @param bool $blank  Categories the PSD leaves undrawn show the same
     *                     structure with no names in it.
     */
    private function bracket($blank = false)
    {
        $round1 = [
            ['R. Santoso / A. Pratama', 'D. Wijaya / H. Kurniawan'],
            ['A. Salim / R. Hartono',   'Y. Prabowo / D. Susanto'],
            ['B. Gunawan / T. Wijaya',  'M. Indra / S. Liem'],
            ['H. Kurnia / F. Fernando', 'D. Santoso / L. Chen'],
        ];

        if ($blank) {
            $round1 = array_fill(0, 4, [null, null]);
        }

        return [
            ['title' => 'Round 1',       'linked' => true, 'matchups' => $round1],
            ['title' => 'Quarter Final', 'linked' => true, 'matchups' => array_fill(0, 4, [null, null])],
            ['title' => 'Semi Final',    'linked' => true, 'matchups' => array_fill(0, 2, [null, null])],
            ['title' => 'Final',         'linked' => true, 'matchups' => [[null, null]]],
            ['title' => 'Champion',      'matchups' => [['CHAMPION', null]]],
        ];
    }
}
