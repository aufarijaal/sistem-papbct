<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Stat::factory(300)->create();
    }
}
