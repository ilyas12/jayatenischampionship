<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Slugs for the team detail page. Unique within an event, not globally: two
 * tournaments may both have a "Senayan Racquet Club".
 */
return new class extends Migration
{
    public function up(): void
    {
        // Guarded: MySQL commits DDL immediately, so a failure further down
        // leaves the column behind while the migration stays unrecorded.
        if (! Schema::hasColumn('event_teams', 'permalink')) {
            Schema::table('event_teams', function (Blueprint $table) {
                $table->string('permalink')->nullable()->after('name');
                $table->unique(['event_id', 'permalink']);
            });
        }

        // Backfill, disambiguating collisions within an event.
        $seen = [];

        foreach (DB::table('event_teams')->orderBy('id')->get() as $team) {
            $slug = Str::slug($team->name) ?: 'team-' . $team->id;
            $key  = $team->event_id . '/' . $slug;

            if (isset($seen[$key])) {
                $slug .= '-' . $team->id;
            }

            $seen[$key] = true;

            DB::table('event_teams')->where('id', $team->id)->update(['permalink' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('event_teams', function (Blueprint $table) {
            $table->dropUnique(['event_id', 'permalink']);
            $table->dropColumn('permalink');
        });
    }
};
