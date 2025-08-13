<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('gst_number')->nullable()->after('phone');
            $table->string('aadhar_number')->nullable()->after('gst_number');
            $table->string('state')->nullable()->after('aadhar_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['gst_number', 'aadhar_number', 'state']);
        });
    }
};
