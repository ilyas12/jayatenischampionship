<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * A short code identifies a club within an event — it prints on the crest and
 * picks the placeholder artwork — so two clubs sharing one is a collision, not
 * a coincidence. Two already did.
 *
 * Scoped to the event rather than global: a club may keep its code across
 * tournaments. NULL is left free, and MySQL permits repeated NULLs in a unique
 * index, so a club without a code is still fine.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Existing duplicates first: the index cannot be added over them.
        // Lowest id keeps the code; later ones get a numeric suffix, trimmed to
        // fit the 4-character column.
        $seen = [];

        foreach (DB::table('event_teams')->orderBy('id')->get() as $team) {
            if ($team->short_code === null || $team->short_code === '') {
                continue;
            }

            $key = $team->event_id . '/' . strtolower($team->short_code);

            if (! isset($seen[$key])) {
                $seen[$key] = 1;
                continue;
            }

            $suffix = ++$seen[$key];
            $code   = substr($team->short_code, 0, 4 - strlen((string) $suffix)) . $suffix;

            DB::table('event_teams')->where('id', $team->id)->update(['short_code' => $code]);
        }

        Schema::table('event_teams', function (Blueprint $table) {
            $table->unique(['event_id', 'short_code']);
        });
    }

    public function down(): void
    {
        Schema::table('event_teams', function (Blueprint $table) {
            $table->dropUnique(['event_id', 'short_code']);
        });
    }
};
