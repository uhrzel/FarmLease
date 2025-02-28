<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to users table
            $table->foreignId('landlisting_id')->constrained('land_listings')->onDelete('cascade'); // Links to land_listings table
            $table->integer('rating')->unsigned()->comment('Rating score (e.g., 1-5)');
            $table->text('comments')->nullable()->comment('Optional user review');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
