<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Apartment;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Service::truncate();
        Schema::enableForeignKeyConstraints();

        $allServices = [
            [
                'title' => 'parcheggio',
                'icon' => null
            ],
            [
                'title' => 'navetta',
                'icon' => null
            ],
            [
                'title' => 'wi-fi',
                'icon' => null
            ],
            [
                'title' => 'colazione',
                'icon' => null
            ],
            [
                'title' => 'servizio in camera',
                'icon' => null
            ],
            [
                'title' => 'tv',
                'icon' => null
            ],
            [
                'title' => 'spazio per co-working',
                'icon' => null
            ],
            [
                'title' => 'animali ammessi',
                'icon' => null
            ],
            [
                'title' => 'rilevatore di monossido di carbonio',
                'icon' => null
            ],
            [
                'title' => 'allarme anti incendio',
                'icon' => null
            ],
            [
                'title' => 'escursioni',
                'icon' => null
            ],
            [
                'title' => 'reception h24',
                'icon' => null
            ],
            [
                'title' => 'self check-in',
                'icon' => null
            ],
            [
                'title' => 'griglia barbecue',
                'icon' => null
            ],
            [
                'title' => 'minifrigo',
                'icon' => null
            ]
            
        ];

        foreach ($allServices as $service) {
            $newService = Service::create([
                'service_name' => $service['title'],
                'service_icon' => $service['icon']
            ]);

            $apartmentIds = [];
            $apartmentCount = Apartment::count();

            for($i = 0; $i < rand(0, $apartmentCount); $i++) {

                $randomApartment = Apartment::inRandomOrder()->first();

                if(!in_array($randomApartment->id, $apartmentIds)) {
                    $apartmentIds[] = $randomApartment->id;
                }

                $newService->apartments()->sync($apartmentIds);
            }
        }
    }
}
