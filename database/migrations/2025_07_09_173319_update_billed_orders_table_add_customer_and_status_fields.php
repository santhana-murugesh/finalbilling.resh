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
        Schema::table('billed_orders', function (Blueprint $table) {
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->json('customer_info')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->enum('order_status', ['pending', 'processing', 'completed', 'cancelled'])->default('completed');
            $table->enum('payment_status', ['pending', 'paid', 'partial', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('billed_orders', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn([
                'customer_id',
                'customer_info',
                'subtotal',
                'discount',
                'tax',
                'order_status',
                'payment_status',
                'notes'
            ]);
        });
    }
};
