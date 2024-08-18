<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rental_agreements', function (Blueprint $table) {
            $table->id('rentalAgreementID'); // Primary key
            $table->unsignedBigInteger('ownerID'); // Foreign key referencing users
            $table->unsignedBigInteger('renterID'); // Foreign key referencing users
            $table->unsignedBigInteger('listingID'); // Foreign key referencing listings
            $table->string('rentalTerm');
            $table->timestamp('dateCreated')->useCurrent(); // Automatically sets the current timestamp
            $table->decimal('offerAmount', 10, 2); // Decimal for financial values
            $table->date('dateStart');
            $table->date('dateEnd');
            $table->string('status');
            $table->timestamps(); // created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('ownerID')->references('userID')->on('users')->cascadeOnDelete();
            $table->foreign('renterID')->references('userID')->on('users')->cascadeOnDelete();
            $table->foreign('listingID')->references('listingID')->on('listing')->cascadeOnDelete();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('rental_agreements');
    }
};