<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()->count(1)->create();
        // $this->call([
        //     // MachineSeeder::class,
        //     StatSeeder::class
        // ]);
        User::create([
            'username' => 'pekerja2',
            'password' => 'pekerja2',
            'owner_username' => 'owner1'
        ]);
    }
}
