<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = [
            [
                'name' => '24h',
                'price' => 2.99,
                'duration_hours' => 24,
            ],
            [
                'name' => '72h',
                'price' => 5.99,
                'duration_hours' => 72,
            ],
            [
                'name' => '144h',
                'price' => 9.99,
                'duration_hours' => 144,
            ],
        ];

        foreach ($sponsorships as $sponsorship) {
            Sponsorship::create($sponsorship);
        }
    }
}