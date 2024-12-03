<?php

    

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// // Models
// use App\Models\Apartment;
// use App\Models\Sponsorship;

// class SponsorshipSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         Schema::disableForeignKeyConstraints();
//         Sponsorship::truncate();
//         Schema::enableForeignKeyConstraints();

//         $allSponsorships = [
//             [
//                 'packet_type' => 'simple',
//                 'amount' => 2.99,
//                 'duration' => 24
//             ],
//             [
//                 'packet_type' => 'medium',
//                 'amount' => 5.99,
//                 'duration' => 72
//             ],
//             [
//                 'packet_type' => 'premium',
//                 'amount' => 9.99,
//                 'duration' => 144
//             ],
//         ];

//         foreach ($allSponsorships as $sponsorship) {
//             $newSponsorship = Sponsorship::create([
//                 'packet_type' => $sponsorship['packet_type'],
//                 'amount' => $sponsorship['amount'],
//                 'duration' => $sponsorship['duration']
//             ]);

//             $apartmentIds = [];
//             $apartmentCount = Apartment::count();

//             for($i = 0; $i < rand(0, $apartmentCount); $i++) {

//                 $randomApartment = Apartment::inRandomOrder()->first();

//                 if(!in_array($randomApartment->id, $apartmentIds)) {
//                     $apartmentIds[] = $randomApartment->id;
//                 }

//                 $newSponsorship->apartments()->sync($apartmentIds);
//             }
//         }
//     }
// }



namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Apartment;
use App\Models\Sponsorship;
use Carbon\Carbon;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $packages = [
            '24h' => 2.99,
            '72h' => 5.99,
            '144h' => 9.99,
        ];

        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {
            foreach (array_keys($packages) as $package) {
                // $startTime = Carbon::now();
                // $endTime = $startTime->copy()->addHours((int)str_replace('h', '', $package));

                Sponsorship::create([
                    'apartment_id' => $apartment->id,
                    'package' => $package,
                    'price' => $packages[$package],
                    // 'start_time' => $startTime,
                    // 'end_time' => $endTime,
                ]);
            }
        }
    }
}
