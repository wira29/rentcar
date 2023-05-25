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
        Schema::create('payments', function (Blueprint $table) {
            $table->string('order_id')->primary();
            $table->foreignUuid('rent_id')->constrained('rents')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('payment_type');
            $table->enum('status', ['pending', 'capture', 'settlement', 'deny', 'cancel', 'expire', 'failure', 'refund', 'chargeback', 'partial_refund', 'partial_chargeback', 'authorize']);
            $table->date('date');
            $table->integer('total');
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
        Schema::dropIfExists('payments');
    }
};
