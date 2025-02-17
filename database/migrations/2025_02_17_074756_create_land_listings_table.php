<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_listings', function (Blueprint $table) {
            $table->id();
            $table->string('landowner_name');
            $table->string('location');
            $table->decimal('price', 10, 2);  // Allows for decimal values with 2 digits after the decimal point
            $table->string('phone_number');
            $table->float('size');
            $table->string('soil_quality');
            $table->string('land_condition');
            $table->text('description');
            $table->string('image')->nullable(); // Image column can be nullable if not always present
            $table->foreignId('landowner_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('land_listings');
    }
}
