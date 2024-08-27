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
        Schema::create('listing', function (Blueprint $table) {
            $table->id('listingID'); // Primary key
            $table->string('title');
            $table->string('location');
            $table->text('description');
            $table->timestamp('dateCreated')->useCurrent(); // Automatically sets the current timestamp
            $table->unsignedBigInteger('ownerID')->nullable(); // Foreign key referencing 'users'
            $table->foreign('ownerID')->references('userID')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('approvedBy_userID')->nullable(); // Foreign key referencing 'users'
            $table->foreign('approvedBy_userID')->references('userID')->on('users')->nullOnDelete();
            $table->string('status');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing');
    }
};
