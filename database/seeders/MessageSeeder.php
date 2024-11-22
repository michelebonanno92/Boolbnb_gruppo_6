<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Apartment;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Message::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 0; $i < 100; $i++) {

            $randomApartment = Apartment::inRandomOrder()->first();
            $randomApartmentId = $randomApartment->id;

            Message::create([
                'apartment_id' => $randomApartmentId,
                'message_text' => fake()->paragraph(4),
                'sent_date' => fake()->date(),
                'user_email' => fake()->email()

            ]);
        }
    }
}
