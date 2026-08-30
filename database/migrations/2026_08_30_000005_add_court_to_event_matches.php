<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The results board has a Court column. Deriving it from the tail of `meta`
 * works while the admin writes "Fri · Centre", but the final was entered as
 * "Sun · 15:00" and the board printed "15:00" as the court. An explicit column
 * ends the guessing; the accessor still falls back to the meta tail so rows
 * entered before this keep working.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_matches', function (Blueprint $table) {
            $table->string('court', 60)->nullable()->after('meta');
        });
    }

    public function down(): void
    {
        Schema::table('event_matches', function (Blueprint $table) {
            $table->dropColumn('court');
        });
    }
};
