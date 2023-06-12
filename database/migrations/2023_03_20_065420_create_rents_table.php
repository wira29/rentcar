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
        Schema::create('rents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('car_id')->constrained('cars')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('users')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['pending', 'disewa', 'selesai']);
            $table->integer('isWithDriver')->default(0);
            $table->string('pickup')->default('rental');
            $table->string('return')->default('rental');
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
        Schema::dropIfExists('rents');
    }
};
