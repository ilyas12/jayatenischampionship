<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // The event tables are the only ones seeded here. The other 58 come
        // from cms-template-engine.sql, which the db container imports.
        $this->call(TournamentSeeder::class);
        $this->call(SocialLinksSeeder::class);
    }
}
