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



            $table->string('title', 128)->required();
            $table->string('slug', 128)->unique();
            $table->text('description', 4096)->nullable();
            $table->smallInteger('rooms')->required()->unsigned();
            $table->smallInteger('beds')->required()->unsigned();
            $table->smallInteger('toilets')->required()->unsigned();
            $table->smallInteger('square_meters')->required()->unsigned();
            $table->string('address')->required();
            $table->decimal('latitude', 11,8)->nullable();
            $table->decimal('longitude', 11,8)->nullable();
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
