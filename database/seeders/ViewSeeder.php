<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Apartment;
use App\Models\View;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        View::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 0; $i < 100; $i++) {

            $randomApartment = Apartment::inRandomOrder()->first();
            $randomApartmentId = $randomApartment->id;

            View::create([
                'apartment_id' => $randomApartmentId,
                'view_date' => fake()->date(),
                'ip_address' => fake()->ipv4()
            ]);
        }
    }
}
