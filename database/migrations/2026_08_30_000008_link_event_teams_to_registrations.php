<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * A team on the public page is a paid entry, so the two tables need a link.
 *
 * Nullable and unique: teams added by hand keep working, and a registration can
 * only ever own one team, which is what makes the auto-create idempotent.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_teams', function (Blueprint $table) {
            $table->unsignedInteger('registration_id')->nullable()->unique()->after('event_id');
        });
    }

    public function down(): void
    {
        Schema::table('event_teams', function (Blueprint $table) {
            $table->dropColumn('registration_id');
        });
    }
};
