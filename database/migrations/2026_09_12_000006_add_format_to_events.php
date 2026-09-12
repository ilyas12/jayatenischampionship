<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * How the tournament is played — "Doubles knockout", "Round robin then
 * knockout", whatever this edition actually does.
 *
 * The register page has had a Tournament Format column since the design was
 * sliced and has always read TBA, because nothing recorded one. The draw shape
 * is close but not the same thing: a bracket says how the ties connect, not
 * how the event is run, and an edition can change format without the bracket
 * changing at all.
 *
 * Nullable: TBA is the honest answer until someone decides.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('events', 'format')) {
            return;
        }

        Schema::table('events', function (Blueprint $table) {
            $table->string('format')->nullable()->after('venue_detail');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('format');
        });
    }
};
