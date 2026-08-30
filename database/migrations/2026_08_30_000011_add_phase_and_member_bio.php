<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * An event moves through phases, and the public site reveals data as it goes.
 *
 * Dates alone could not express this: opens_at/closes_at can say open or
 * closed, but not "the draw exists and nothing has been played yet". The phase
 * is advanced by an admin; the registration window still applies on top, so an
 * entry deadline can pass without anyone touching the phase.
 *
 * event_teams.description goes: a one-shot event gives a club no history to
 * describe. The per-member bio stays, because that describes the person rather
 * than the club's past.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->enum('phase', ['registration', 'draw', 'running', 'finished'])
                  ->default('registration')->after('publish');
        });

        if (Schema::hasColumn('event_teams', 'description')) {
            Schema::table('event_teams', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }

        Schema::table('event_team_members', function (Blueprint $table) {
            $table->string('bio', 400)->nullable()->after('rank');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('phase');
        });

        if (! Schema::hasColumn('event_teams', 'description')) {
            Schema::table('event_teams', function (Blueprint $table) {
                $table->text('description')->nullable();
            });
        }

        Schema::table('event_team_members', function (Blueprint $table) {
            $table->dropColumn('bio');
        });
    }
};
