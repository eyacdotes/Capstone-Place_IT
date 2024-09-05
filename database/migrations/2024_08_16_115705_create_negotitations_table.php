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
        Schema::create('negotiations', function (Blueprint $table) {
            $table->id('negotiationID'); // Primary key
            $table->unsignedBigInteger('listingID'); // Foreign key referencing listings
            $table->unsignedBigInteger('senderID'); // Foreign key referencing users
            $table->unsignedBigInteger('receiverID'); // Foreign key referencing users
            $table->string('negoStatus');
            $table->decimal('offerAmount', 10, 2); // Decimal for financial values
            $table->timestamp('timestamp')->useCurrent(); // Automatically set the current timestamp
            $table->timestamps(); // created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('listingID')->references('listingID')->on('listing')->cascadeOnDelete();
            $table->foreign('senderID')->references('userID')->on('users')->cascadeOnDelete();
            $table->foreign('receiverID')->references('userID')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negotitations');
    }
};
