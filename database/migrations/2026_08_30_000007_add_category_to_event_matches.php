<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * A match belongs to one of the event's draws, so the draw page can show a
 * bracket per category instead of one merged tree.
 *
 * Nullable: matches entered before this exist without a category and are shown
 * under an "All" panel rather than disappearing.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_matches', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->nullable()->after('event_id')->index();
        });
    }

    public function down(): void
    {
        Schema::table('event_matches', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
};
