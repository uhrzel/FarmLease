<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('land_listings', function (Blueprint $table) {
            $table->unsignedBigInteger('approved_by')->nullable()->after('landowner_id'); // Add approved_by column
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null'); // Foreign key reference to users table
        });
    }

    public function down()
    {
        Schema::table('land_listings', function (Blueprint $table) {
            $table->dropForeign(['approved_by']); // Remove foreign key
            $table->dropColumn('approved_by'); // Remove the column
        });
    }
};
