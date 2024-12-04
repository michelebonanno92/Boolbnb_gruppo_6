<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('sponsorships', function (Blueprint $table) {
    //         $table->id();

            
    //         $table->enum('package', ['24h', '72h', '144h']);
    //         $table->decimal('price', 8, 2);
    //         $table->timestamp('start_time')->nullable();
    //         $table->timestamp('end_time')->nullable();
    //         // $table->string('packet_type');
    //         // $table->decimal('amount', 5, 2);
    //         // $table->integer('duration');

    //         $table->timestamps();
    //     });
    // }
    public function up(): void
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50); // Nome del pacchetto (es. 24h, 72h)
            $table->decimal('price', 8, 2); // Prezzo del pacchetto
            $table->smallInteger('duration_hours'); // Durata in ore
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorships');
    }
};
