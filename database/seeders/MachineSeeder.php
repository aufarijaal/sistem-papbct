<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machineids = ['abc123', 'bcd456', 'efg789', 'hij123', 'klm456'];
        $temperatures = [28.3, 33.2, 40, 35.8, 29.1];
        foreach ($machineids as $index => $value) {
            DB::table('machines')->insert([
                'machineid' => $value,
                'temperature' => $temperatures[$index]
            ]);
        };
    }
}
