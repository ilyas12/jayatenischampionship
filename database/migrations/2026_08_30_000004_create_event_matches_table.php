<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Draw matches for an event. Fourth table on the event_id pattern.
 *
 * A single-elimination bracket, stored flat: `round` orders the columns and the
 * view chunks each round's matches into the pairs the CSS connectors expect.
 * There is no Champion row — the champion is the winner of the last round, so
 * storing one would be a second place for the same fact to disagree.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_matches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->index();

            // 1 = first column shown. Rounds need not start at the quarters.
            $table->unsignedSmallInteger('round')->default(1);
            $table->string('round_name', 60)->nullable();   // "Quarter-finals"

            $table->string('label', 20)->nullable();        // "QF 1"
            $table->string('meta', 80)->nullable();         // "Fri · Centre"

            // Null means the slot is still to be decided.
            $table->unsignedInteger('home_team_id')->nullable();
            $table->unsignedInteger('away_team_id')->nullable();

            // Set scores as written, e.g. "6 6" against "4 2".
            $table->string('home_score', 40)->nullable();
            $table->string('away_score', 40)->nullable();

            $table->unsignedInteger('winner_team_id')->nullable();

            $table->integer('order_id')->default(0);
            $table->boolean('publish')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_matches');
    }
};
