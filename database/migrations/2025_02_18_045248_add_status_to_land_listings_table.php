<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('land_listings', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending')->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('land_listings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
