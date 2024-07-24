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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('place_from');
            $table->string('place_to');
            $table->string('travel_date');
            $table->string('travel_time');
            $table->integer('num_person')->default('1');
            $table->integer('num_pages')->default('1');
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default('2');
            $table->string('user_session');
            $table->string('payment_method')->default('1');
            $table->string('payment_status')->default('0');
            $table->string('travel_price')->default('0');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
