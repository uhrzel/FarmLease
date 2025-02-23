<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->integer('start_month')->nullable()->after('total_payment');
            $table->integer('end_month')->nullable()->after('start_month');
            $table->integer('start_year')->nullable()->after('end_month');
            $table->integer('end_year')->nullable()->after('start_year');
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['start_month', 'end_month', 'start_year', 'end_year']);
        });
    }
};
