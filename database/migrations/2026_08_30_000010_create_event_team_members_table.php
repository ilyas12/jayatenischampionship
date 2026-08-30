<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Squad members as rows rather than lines in a textarea.
 *
 * The textarea was deliberate while a member was only ever read back as a block
 * of text — it kept the admin editable without a second module. A photo per
 * member is the thing it cannot do: a file upload needs a record to hang off.
 *
 * The old column is backfilled and then dropped, so there is one source of
 * truth rather than a table and a stale string that can disagree. down()
 * rebuilds the string from the rows.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_team_members', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id')->index();

            $table->string('name');
            $table->string('role', 40)->nullable();
            $table->string('rank', 20)->nullable();   // string: "12", "—", unranked
            $table->string('photo')->nullable();

            $table->integer('order_id')->default(0);
            $table->boolean('publish')->default(true);
            $table->timestamps();
        });

        // Note the unprefixed table name: the query builder applies DB_PREFIX.
        foreach (DB::table('event_teams')->whereNotNull('members')->get() as $team) {
            $order = 0;

            foreach (preg_split('/\R/', (string) $team->members) as $line) {
                if (trim($line) === '') {
                    continue;
                }

                $parts = array_map('trim', explode('|', $line));

                DB::table('event_team_members')->insert([
                    'team_id'    => $team->id,
                    'name'       => $parts[0],
                    'role'       => isset($parts[1]) && $parts[1] !== '' ? $parts[1] : null,
                    'rank'       => isset($parts[2]) && $parts[2] !== '' ? $parts[2] : null,
                    'order_id'   => $order++,
                    'publish'    => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        if (Schema::hasColumn('event_teams', 'members')) {
            Schema::table('event_teams', function (Blueprint $table) {
                $table->dropColumn('members');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('event_teams', 'members')) {
            Schema::table('event_teams', function (Blueprint $table) {
                $table->text('members')->nullable();
            });
        }

        foreach (DB::table('event_teams')->get() as $team) {
            $lines = DB::table('event_team_members')
                ->where('team_id', $team->id)->orderBy('order_id')->get()
                ->map(function ($m) {
                    return implode(' | ', array_filter([$m->name, $m->role, $m->rank]));
                })->implode("\n");

            DB::table('event_teams')->where('id', $team->id)
                ->update(['members' => $lines ?: null]);
        }

        Schema::dropIfExists('event_team_members');
    }
};
