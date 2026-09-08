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
        Schema::table('facility_services', function (Blueprint $table) {
            // Kolom urutan tampil (untuk fitur reorder di CMS)
            $table->integer('sort_order')->default(0)->after('has_appointment_cta');
            // Kolom status aktif/non-aktif
            $table->boolean('is_active')->default(true)->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facility_services', function (Blueprint $table) {
            $table->dropColumn(['sort_order', 'is_active']);
        });
    }
};

