<?php

namespace Database\Factories;

use App\Models\Stat;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatFactory extends Factory
{
    protected $model = Stat::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $timestamp = $this->faker->dateTimeBetween(now('Asia/Jakarta')->subDays(30), now('Asia/Jakarta'));
        $machineids = ['abc123', 'bcd456', 'efg789', 'hij123', 'klm456'];
        return [
            'machineid' => $machineids[array_rand($machineids, 1)],
            'weight' => (rand(0, 4999) / 10),
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ];
    }
}
