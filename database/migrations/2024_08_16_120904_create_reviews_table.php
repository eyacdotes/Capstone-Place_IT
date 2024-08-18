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
        Schema::create('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('renterID');
            $table->unsignedBigInteger('rentalAgreementID');
            $table->tinyInteger('rate'); // Assuming rating is an integer between 1-5
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('renterID')->references('userID')->on('users')->cascadeOnDelete();
            $table->foreign('rentalAgreementID')->references('rentalAgreementID')->on('rental_agreements')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
