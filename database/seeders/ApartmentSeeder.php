<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Apartment;
use App\Models\User;
use App\Models\View;


class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Apartment::truncate();
        Schema::enableForeignKeyConstraints();


        for ($i = 0; $i < 10; $i++) {
            $title = fake()->sentence();
            $slug = str()->slug($title);
        
            Apartment::create([
                'title' => $title,
                'slug' => str()->slug($title),
                'rooms' => rand(1,4),
                'beds' => rand(1,6),
                'toilets' => rand(1,3),
                'square_meters' => rand(10,50),
                'address' => fake()->address(),
                'latitude' => fake()->latitude($min = -90, $max = 90),
                'longitude' => fake()->longitude($min = -180, $max = 180),
                'image' => fake()->url(),
                'visible' => rand(0,1),
                'messages' => rand(1,100),
            ]);
        }


    }
}
