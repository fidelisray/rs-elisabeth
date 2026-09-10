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
            $table->renameColumn('wa_link_url', 'wa_number');
            $table->string('wa_prefilled_message')->after('wa_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facility_services', function (Blueprint $table) {
            $table->dropColumn('wa_prefilled_message');
            $table->renameColumn('wa_number', 'wa_link_url');
        });
    }
};
