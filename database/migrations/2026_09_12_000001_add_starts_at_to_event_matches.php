<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The schedule page lists ties by day and by time, and event_matches carried
 * neither: `round` says where a tie sits in the draw, not when it is played.
 * The free-text `meta` column ("Fri · Centre") was close enough to print on a
 * bracket and useless for grouping or sorting.
 *
 * One nullable datetime gives the schedule both the day tab a tie belongs
 * under and the time in its row. Nullable because a tie that has not been
 * scheduled yet is normal — it simply does not appear on the schedule.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('event_matches', 'starts_at')) {
            return;
        }

        Schema::table('event_matches', function (Blueprint $table) {
            $table->dateTime('starts_at')->nullable()->after('label');
            $table->index(['event_id', 'starts_at']);
        });
    }

    public function down(): void
    {
        Schema::table('event_matches', function (Blueprint $table) {
            $table->dropIndex(['event_id', 'starts_at']);
            $table->dropColumn('starts_at');
        });
    }
};
