<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Teams taking part in an event.
 *
 * Hangs off events like everything else in the tournament (schedule, draw and
 * results will carry the same event_id), so an event owns its whole dataset and
 * a second tournament cannot see the first one's rows.
 *
 * Separate from terre217_team, which is the CMS's staff-profile table
 * (name/position/description) and a different thing entirely.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->index();

            $table->string('name');
            // Crest text and the placeholder image filename, e.g. SRC -> src.svg.
            $table->string('short_code', 4)->nullable();
            $table->string('city')->nullable();
            $table->smallInteger('founded')->nullable();

            $table->string('photo')->nullable();
            $table->text('description')->nullable();

            // Draw position and pool. `group` is reserved in SQL.
            $table->smallInteger('seed')->nullable();
            $table->string('team_group', 20)->nullable();
            $table->boolean('qualified')->default(false);

            // One player per line: "Name | Role | Rank". A textarea the admin can
            // actually edit, rather than JSON typed by hand.
            // ponytail: give members their own table if they ever need to be
            // searched, or to exist independently of a team.
            $table->text('members')->nullable();

            $table->integer('order_id')->default(0);
            $table->boolean('publish')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_teams');
    }
};
