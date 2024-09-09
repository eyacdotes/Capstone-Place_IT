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
            $table->id('paymentID');
            $table->unsignedBigInteger('rentalAgreementID');
            $table->unsignedBigInteger('renterID');
            $table->decimal('amount', 10, 2);
            $table->timestamp('date')->useCurrent();
            $table->string('proof'); // Path to the proof of payment
            $table->string('details')->nullable();
            
            $table->foreign('rentalAgreementID')->references('rentalAgreementID')->on('rental_agreements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('renterID')->references('userID')->on('users')->onDelete('cascade')->onUpdate('cascade');
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