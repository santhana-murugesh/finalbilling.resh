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
        Schema::table('general_settings', function (Blueprint $table) {
            // Only add fields that don't already exist
            if (!Schema::hasColumn('general_settings', 'company_email')) {
                $table->string('company_email')->nullable();
            }
            if (!Schema::hasColumn('general_settings', 'company_website')) {
                $table->string('company_website')->nullable();
            }
            if (!Schema::hasColumn('general_settings', 'gst_number')) {
                $table->string('gst_number')->nullable();
            }
            if (!Schema::hasColumn('general_settings', 'logo')) {
                $table->string('logo')->nullable();
            }
            if (!Schema::hasColumn('general_settings', 'tax_rate')) {
                $table->decimal('tax_rate', 5, 2)->default(18.00);
            }
            if (!Schema::hasColumn('general_settings', 'currency_symbol')) {
                $table->string('currency_symbol', 10)->default('₹');
            }
            if (!Schema::hasColumn('general_settings', 'invoice_prefix')) {
                $table->string('invoice_prefix', 10)->default('ORD');
            }
            
            // Rename existing columns to match our naming convention
            if (Schema::hasColumn('general_settings', 'contact_no_1') && !Schema::hasColumn('general_settings', 'company_phone')) {
                $table->renameColumn('contact_no_1', 'company_phone');
            }
            
            // Rename company_logo to logo if it exists
            if (Schema::hasColumn('general_settings', 'company_logo') && !Schema::hasColumn('general_settings', 'logo')) {
                $table->renameColumn('company_logo', 'logo');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            // Drop added columns
            $columnsToDrop = [
                'company_email',
                'company_website',
                'gst_number',
                'tax_rate',
                'currency_symbol',
                'invoice_prefix'
            ];
            
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('general_settings', $column)) {
                    $table->dropColumn($column);
                }
            }
            
            // Revert column renames
            if (Schema::hasColumn('general_settings', 'company_phone') && !Schema::hasColumn('general_settings', 'contact_no_1')) {
                $table->renameColumn('company_phone', 'contact_no_1');
            }
            if (Schema::hasColumn('general_settings', 'logo') && !Schema::hasColumn('general_settings', 'company_logo')) {
                $table->renameColumn('logo', 'company_logo');
            }
        });
    }
};
