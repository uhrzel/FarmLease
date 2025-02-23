<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('payment_option')->nullable()->after('total_payment');
            $table->string('plan')->nullable()->after('payment_option');
            $table->string('reference_image')->nullable()->after('plan');
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['payment_option', 'plan', 'reference_image']);
        });
    }
};
