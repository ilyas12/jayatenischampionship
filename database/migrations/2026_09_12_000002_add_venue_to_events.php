<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Where the tournament is played. The home and register pages have printed a
 * venue since the design was sliced, and it was the one fact on that strip the
 * CMS could not answer — hardcoded "Jakarta / Indonesia" in the controller.
 *
 * Two columns because the strip sets it on two lines, and because the two
 * lines are genuinely different things: the place, and where that place is.
 * Either can stand alone, so both are nullable.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('events', 'venue')) {
            return;
        }

        Schema::table('events', function (Blueprint $table) {
            $table->string('venue')->nullable()->after('description');
            $table->string('venue_detail')->nullable()->after('venue');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['venue', 'venue_detail']);
        });
    }
};
