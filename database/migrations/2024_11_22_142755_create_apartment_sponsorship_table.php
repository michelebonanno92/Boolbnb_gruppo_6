<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apartment_sponsorship', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('apartment_id'); // ID dell'appartamento
            $table->unsignedBigInteger('sponsorship_id'); // ID della sponsorizzazione
            $table->timestamp('start_time')->nullable(); // Inizio sponsorizzazione
            $table->timestamp('end_time')->nullable(); // Fine sponsorizzazione
            $table->timestamps();

            // $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')
                    ->references('id')
                    ->on('apartments')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            // $table->unsignedBigInteger('sponsorship_id');
            $table->foreign('sponsorship_id')
                    ->references('id')
                    ->on('sponsorships')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            // $table->primary([
            //     'apartment_id',
            //     'sponsorship_id'
            // ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment_sponsorship');
    }
};
