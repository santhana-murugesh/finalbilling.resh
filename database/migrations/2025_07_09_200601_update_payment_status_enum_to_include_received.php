<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update any existing 'paid' values to 'received'
        DB::table('billed_orders')
            ->where('payment_status', 'paid')
            ->update(['payment_status' => 'received']);

        // Then modify the enum column
        DB::statement("ALTER TABLE billed_orders MODIFY COLUMN payment_status ENUM('pending', 'received', 'partial', 'cancelled') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, update any existing 'received' values back to 'paid'
        DB::table('billed_orders')
            ->where('payment_status', 'received')
            ->update(['payment_status' => 'paid']);

        // Then revert the enum column
        DB::statement("ALTER TABLE billed_orders MODIFY COLUMN payment_status ENUM('pending', 'paid', 'partial', 'cancelled') DEFAULT 'pending'");
    }
};
