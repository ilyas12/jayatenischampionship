<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Two of the CMS's tables lost AUTO_INCREMENT on their primary key somewhere
 * in the dump's history, which makes them look fine and behave badly:
 *
 *   - through the app, every insert fails with "Field 'id' doesn't have a
 *     default value", so Add Social Link and Add Brand simply do not work
 *   - through a connection without strict mode, the insert succeeds and
 *     writes id = 0, so the first one looks like it worked and the second
 *     collides with it
 *
 * Restoring AUTO_INCREMENT fixes both. The counter starts past the highest id
 * already present so nothing existing is disturbed.
 *
 * Raw SQL rather than the schema builder: it has no way to add AUTO_INCREMENT
 * to a column that already exists. That means writing the table name out, and
 * the prefix with it — the builder would have applied DB_PREFIX for us.
 */
return new class extends Migration
{
    private $tables = ['social_link', 'brand'];

    public function up(): void
    {
        $prefix = DB::getTablePrefix();

        foreach ($this->tables as $table) {
            if (! Schema::hasTable($table) || $this->hasAutoIncrement($table)) {
                continue;
            }

            $name = $prefix . $table;
            $next = ((int) DB::table($table)->max('id')) + 1;

            // A zero id is what the non-strict path left behind; it would
            // block the counter, and it was never a real row's id.
            DB::table($table)->where('id', 0)->delete();

            DB::statement("ALTER TABLE `{$name}` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT");
            DB::statement("ALTER TABLE `{$name}` AUTO_INCREMENT = {$next}");
        }
    }

    public function down(): void
    {
        $prefix = DB::getTablePrefix();

        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                DB::statement("ALTER TABLE `{$prefix}{$table}` MODIFY `id` INT(11) NOT NULL");
            }
        }
    }

    private function hasAutoIncrement($table)
    {
        $row = DB::selectOne(
            'SELECT EXTRA FROM information_schema.columns
              WHERE table_schema = DATABASE() AND table_name = ? AND column_name = ?',
            [DB::getTablePrefix() . $table, 'id']
        );

        return $row && str_contains(strtolower($row->EXTRA), 'auto_increment');
    }
};
