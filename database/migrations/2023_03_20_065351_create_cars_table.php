<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('rental_id')->constrained('rentals')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->enum('transmission', ['manual', 'automatic']);
            $table->integer('chairs_ammount');
            $table->string('vehicle_license');
            $table->string('merk');
            $table->integer('price');
            $table->enum('car_type', ['city car', 'compact mpv', 'mini mpv', 'minivan', 'suv']);
            $table->text('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
