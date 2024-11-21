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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');



            $table->string('title');
            $table->string('slug')->unique();
            $table->smallInteger('rooms')->nullable();
            $table->smallInteger('beds')->nullable();
            $table->smallInteger('toilets')->nullable();
            $table->smallInteger('square_meters')->nullable();
            $table->string('address');
            $table->decimal('latitude', 11,8);
            $table->decimal('longitude', 11,8);
            $table->string('image', 2048)->nullable();
            $table->boolean('visible')->default(false);
            $table->integer('messages')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
