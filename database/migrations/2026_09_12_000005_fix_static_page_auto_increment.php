<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * static_page has the same missing AUTO_INCREMENT as social_link and brand —
 * see 2026_09_12_000004. A separate migration rather than an edit to that one,
 * which may already have been applied.
 *
 * Without this, adding a page through the admin fails outright, so the footer
 * cannot be given a privacy policy or terms to link to.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('static_page') || $this->hasAutoIncrement()) {
            return;
        }

        $name = DB::getTablePrefix() . 'static_page';
        $next = ((int) DB::table('static_page')->max('id')) + 1;

        DB::table('static_page')->where('id', 0)->delete();

        DB::statement("ALTER TABLE `{$name}` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT");
        DB::statement("ALTER TABLE `{$name}` AUTO_INCREMENT = {$next}");
    }

    public function down(): void
    {
        if (Schema::hasTable('static_page')) {
            DB::statement('ALTER TABLE `' . DB::getTablePrefix() . 'static_page` MODIFY `id` INT(11) NOT NULL');
        }
    }

    private function hasAutoIncrement()
    {
        $row = DB::selectOne(
            'SELECT EXTRA FROM information_schema.columns
              WHERE table_schema = DATABASE() AND table_name = ? AND column_name = ?',
            [DB::getTablePrefix() . 'static_page', 'id']
        );

        return $row && str_contains(strtolower($row->EXTRA), 'auto_increment');
    }
};
