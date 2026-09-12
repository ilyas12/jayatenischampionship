<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use terre\Http\Models\EventCategoryModel;
use terre\Http\Models\EventMatchModel;
use terre\Http\Models\EventModel;
use terre\Http\Models\EventPartnerModel;
use terre\Http\Models\EventScheduleModel;
use terre\Http\Models\EventTeamMemberModel;
use terre\Http\Models\EventTeamModel;

/**
 * A complete tournament, so a fresh database is a working site.
 *
 * The SQL dump predates the event tables, so without this a new volume comes
 * up with every tournament page in its empty state. Run it after `migrate`.
 *
 * Idempotent: it keys on the event slug and rebuilds that event's rows, so
 * running it twice leaves one tournament rather than two. It writes nothing
 * outside its own event.
 *
 *     php artisan db:seed --class=TournamentSeeder
 *
 * The clubs use the eight short codes that have crest artwork in
 * resources/assets/jtc/img/teams/ — the names are placeholders and are meant
 * to be corrected in the admin.
 */
class TournamentSeeder extends Seeder
{
    const SLUG = 'grandstand-open-2026';

    /** code => [name, city, founded, seed] */
    private $clubs = [
        'src' => ['Senayan Racquet Club',   'Jakarta Pusat',     1974, 1],
        'kcc' => ['Kemang Country Club',    'Jakarta Selatan',   1988, 2],
        'bts' => ['Bintaro Tennis Society', 'Tangerang Selatan', 1996, 3],
        'sbs' => ['Surabaya Smash',         'Surabaya',          1981, 4],
        'bbl' => ['Bali Baseline Club',     'Denpasar',          2003, 5],
        'mas' => ['Medan Ace Sports',       'Medan',             1992, 6],
        'mkn' => ['Makassar Kencana',       'Makassar',          1999, 7],
        'ykv' => ['Yogyakarta Victory',     'Yogyakarta',        1985, 8],
    ];

    /** club code => [[name, role, rank], ...] */
    private $squads = [
        'src' => [['Arya Wicaksana', 'Captain', '1'], ['Bagus Prakoso', 'Singles', '14']],
        'kcc' => [['Dimas Haryanto', 'Captain', '2'], ['Reza Alamsyah', 'Doubles', '21']],
        'bts' => [['Yusuf Ramadhan', 'Captain', '3'], ['Ilham Saputra', 'Singles', '18']],
        'sbs' => [['Bayu Nugroho',   'Captain', '4'], ['Fajar Setiawan', 'Doubles', '26']],
        'bbl' => [['Ketut Suardana', 'Captain', '5'], ['Gede Mahendra', 'Singles', '31']],
        'mas' => [['Rizky Pratama',  'Captain', '6'], ['Andre Sitorus', 'Doubles', '29']],
        'mkn' => [['Ahmad Fauzan',   'Captain', '7'], ['Rahmat Hidayat', 'Singles', '35']],
        'ykv' => [['Wisnu Adiputra', 'Captain', '8'], ['Galih Prasetyo', 'Doubles', '40']],
    ];

    public function run()
    {
        $event = $this->event();

        // Rebuild this event's rows only. Matches reference teams, so they go
        // first; members reference teams, so they go with them.
        EventMatchModel::where('event_id', $event->id)->delete();
        EventScheduleModel::where('event_id', $event->id)->delete();
        EventCategoryModel::where('event_id', $event->id)->delete();
        EventPartnerModel::where('event_id', $event->id)->delete();

        $teamIds = EventTeamModel::where('event_id', $event->id)->pluck('id');
        EventTeamMemberModel::whereIn('team_id', $teamIds)->delete();
        EventTeamModel::where('event_id', $event->id)->delete();

        $categories = $this->categories($event);
        $teams      = $this->teams($event);

        $this->squads($teams);
        $this->draw($event, $categories['ms'], $teams);
        $this->schedule($event);
        $this->partners($event);

        $this->command->info(sprintf(
            'Seeded %s: %d clubs, %d categories, %d ties, %d partners.',
            $event->title, count($teams), count($categories),
            EventMatchModel::where('event_id', $event->id)->count(),
            EventPartnerModel::where('event_id', $event->id)->count()
        ));
    }

    private function event()
    {
        $event = EventModel::where('slug', self::SLUG)->first() ?: new EventModel(['slug' => self::SLUG]);

        $event->title   = 'Jaya Tennis Championship 2026';
        $event->slug    = self::SLUG;
        $event->description = 'Eight days of championship tennis on grass. Singles, doubles '
                            . 'and club team events — open to registered players of every grade.';
        $event->venue        = 'Jakarta';
        $event->venue_detail = 'Indonesia';
        $event->format       = 'Doubles knockout';
        $event->price   = 750000;
        $event->payment_instructions =
              "Transfer the entry fee to:\n\n"
            . "  Bank Mandiri\n"
            . "  1234567890\n"
            . "  Hipmi Jaya Tennis Club\n\n"
            . "Quote your registration code as the transfer reference, then upload "
            . "the transfer receipt on the confirmation page. Entries are confirmed "
            . "once an official has checked the payment.";
        $event->opens_at  = '2026-07-01 00:00:00';
        $event->closes_at = '2026-09-30 23:59:59';
        // Where the site was left: entries open, draw not yet published. The
        // draw below is seeded anyway, so moving the phase in the admin shows a
        // populated bracket immediately.
        $event->phase   = EventModel::REGISTRATION;
        $event->publish = 1;
        $event->save();

        return $event;
    }

    private function categories($event)
    {
        $rows = [
            ['ms', "Men's Singles",    8],
            ['ws', "Women's Singles",  8],
            ['md', "Men's Doubles",    8],
            ['wd', "Women's Doubles",  8],
            ['xd', 'Mixed Doubles',    8],
            ['ct', 'Club Teams',       8],
        ];

        $out   = [];
        $order = 0;

        foreach ($rows as $row) {
            list($code, $name, $size) = $row;

            $out[$code] = EventCategoryModel::create([
                'event_id'  => $event->id,
                'code'      => $code,
                'name'      => $name,
                'draw_size' => $size,
                'order_id'  => $order++,
                'publish'   => 1,
            ]);
        }

        return $out;
    }

    private function teams($event)
    {
        $out   = [];
        $order = 0;

        foreach ($this->clubs as $code => $club) {
            list($name, $city, $founded, $seed) = $club;

            $out[$code] = EventTeamModel::create([
                'event_id'   => $event->id,
                'name'       => $name,
                'permalink'  => Str::slug($name),
                'short_code' => $code,
                'city'       => $city,
                'founded'    => $founded,
                'seed'       => $seed,
                'qualified'  => 1,
                'order_id'   => $order++,
                'publish'    => 1,
            ]);
        }

        return $out;
    }

    private function squads($teams)
    {
        foreach ($this->squads as $code => $players) {
            $order = 0;

            foreach ($players as $player) {
                list($name, $role, $rank) = $player;

                EventTeamMemberModel::create([
                    'team_id'  => $teams[$code]->id,
                    'name'     => $name,
                    'role'     => $role,
                    'rank'     => $rank,
                    // No portraits: the squad cards fall back to the
                    // illustrated player, which is what an unphotographed
                    // squad is meant to look like. Admins upload the real ones.
                    'photo'    => null,
                    'order_id' => $order++,
                    'publish'  => 1,
                ]);
            }
        }
    }

    /**
     * A full eight-team knockout: four quarter-finals, two semi-finals, a
     * final. Winners chain through, so the results board and each club's record
     * agree with the bracket.
     */
    private function draw($event, $category, $teams)
    {
        $qf = [
            ['src', 'bbl', '6 6', '3 4', 'src', 'Centre Court', '2026-10-16 08:00'],
            ['sbs', 'mas', '7 6', '5 2', 'sbs', 'Court 1',      '2026-10-16 09:30'],
            ['bts', 'mkn', '6 4 6', '2 6 3', 'bts', 'Court 2',  '2026-10-16 11:00'],
            ['kcc', 'ykv', '6 6', '4 1', 'kcc', 'Centre Court', '2026-10-16 13:00'],
        ];

        $order = 0;

        foreach ($qf as $tie) {
            $this->tie($event, $category, 1, 'Quarter-final', 'QF ' . ($order + 1), $teams, $tie, $order++);
        }

        $sf = [
            ['src', 'sbs', '6 7', '4 6', 'src', 'Centre Court',     '2026-10-18 14:00'],
            ['bts', 'kcc', '4 6 6', '6 3 4', 'kcc', 'Centre Court', '2026-10-18 16:00'],
        ];

        $order = 0;

        foreach ($sf as $tie) {
            $this->tie($event, $category, 2, 'Semi-final', 'SF ' . ($order + 1), $teams, $tie, $order++);
        }

        $this->tie($event, $category, 3, 'Final', 'Final', $teams,
                   ['src', 'kcc', '6 3 7', '4 6 5', 'src', 'Centre Court', '2026-10-19 15:00'], 0);
    }

    private function tie($event, $category, $round, $roundName, $label, $teams, $tie, $order)
    {
        list($home, $away, $homeScore, $awayScore, $winner, $court, $startsAt) = $tie;

        EventMatchModel::create([
            'event_id'       => $event->id,
            'category_id'    => $category->id,
            'round'          => $round,
            'round_name'     => $roundName,
            'label'          => $label,
            'court'          => $court,
            'starts_at'      => $startsAt,
            'home_team_id'   => $teams[$home]->id,
            'away_team_id'   => $teams[$away]->id,
            'home_score'     => $homeScore,
            'away_score'     => $awayScore,
            'winner_team_id' => $teams[$winner]->id,
            'order_id'       => $order,
            'publish'        => 1,
        ]);
    }

    /**
     * The sponsors the design ships with. Their artwork lives in the theme, but
     * the admin uploads into resources/assets/uploads/event_partners and stores
     * a bare filename, so it is copied there — otherwise a logo replaced
     * through the admin and one seeded here would live in different places.
     */
    private function partners($event)
    {
        $rows = [
            ['Jaya',         'jtc_partner_jaya.png'],
            ['BCA',          'jtc_partner_bca.png'],
            ['HEAD',         'jtc_partner_head.png'],
            ['Wilson',       'jtc_partner_wilson.png'],
            ['Pocari Sweat', 'jtc_partner_pocari.png'],
            ['Le Minerale',  'jtc_partner_le_minerale.png'],
            ['ASICS',        'jtc_partner_asics.png'],
        ];

        $source = base_path('resources/assets/jtc/img/partners');
        $target = base_path('resources/assets/uploads/event_partners');

        if (! is_dir($target)) {
            mkdir($target, 0775, true);
        }

        $order = 0;

        foreach ($rows as $row) {
            list($name, $file) = $row;

            if (is_file($source . '/' . $file) && ! is_file($target . '/' . $file)) {
                copy($source . '/' . $file, $target . '/' . $file);
            }

            EventPartnerModel::create([
                'event_id' => $event->id,
                'name'     => $name,
                'logo'     => $file,
                'order_id' => $order++,
                'publish'  => 1,
            ]);
        }
    }

    private function schedule($event)
    {
        $days = [
            ['2026-10-12', 'Qualifying',      'Qualifying rounds, all courts',      'Free entry'],
            ['2026-10-14', 'Main draw begins', 'First round, singles and doubles',  null],
            ['2026-10-16', 'Quarter-finals',  'All categories, Centre Court and 1', null],
            ['2026-10-18', 'Semi-finals',     'All categories, Centre Court',       null],
            ['2026-10-19', 'Finals',          'Finals and presentation',            'Ticketed'],
        ];

        $order = 0;

        foreach ($days as $day) {
            list($date, $title, $detail, $note) = $day;

            EventScheduleModel::create([
                'event_id'  => $event->id,
                'starts_on' => $date,
                'title'     => $title,
                'detail'    => $detail,
                'note'      => $note,
                'order_id'  => $order++,
                'publish'   => 1,
            ]);
        }
    }
}
