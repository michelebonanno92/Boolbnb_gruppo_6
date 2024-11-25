<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

// Models
use App\Models\Apartment;
use App\Models\User;
use App\Models\View;
use App\Models\Service;



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


        $apartments = config('apartments');

        foreach ($apartments as $singleApartment) {

            Apartment::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'title' => $singleApartment['title'],
                'slug' => Str::slug($singleApartment['title'], '-'),
                'description' => $singleApartment['description'],
                'rooms' => $singleApartment['rooms'],
                'beds' => $singleApartment['beds'],
                'toilets' => $singleApartment['toilets'],
                'square_meters' => $singleApartment['square_meters'],
                'address' => $singleApartment['address'],
                'latitude' => $singleApartment['latitude'],
                'longitude' => $singleApartment['longitude'],
                'image' => $singleApartment['image'],
                'visible' => $singleApartment['visible'],
                'messages' => $singleApartment['messages'],
            ]);
        }

        // for ($i = 0; $i < 10; $i++) {
        //     $title = fake()->sentence();
        //     $slug = str()->slug($title);
        
        //     Apartment::create([
        //         'title' => $title,
        //         'slug' => str()->slug($title),
        //         'address' => fake()->address(),
        //         'description' => fake()->text(),
        //         'rooms' => rand(1,4),
        //         'beds' => rand(1,6),
        //         'toilets' => rand(1,3),
        //         'square_meters' => rand(10,50),
        //         'address' => fake()->address(),
        //         'latitude' => fake()->latitude($min = -90, $max = 90),
        //         'longitude' => fake()->longitude($min = -180, $max = 180),
        //         'image' => fake()->url(),
        //         'visible' => rand(0,1),
        //         'messages' => rand(1,100),
        //     ]);
    }

}

