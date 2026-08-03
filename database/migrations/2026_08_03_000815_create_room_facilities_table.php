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
        Schema::create('room_facilities', function (Blueprint $table) {
            $table->id();

            // Informasi Utama
            $table->string('name', 100);                        // Nama ruangan: "President Suite", "VIP", dst
            $table->string('slug', 100)->unique();              // Identifier unik: "president-suite", "vip"
            $table->enum('category', ['premium', 'standard']); // Untuk filter tab di view
            $table->string('tagline', 500)->nullable();         // Deskripsi singkat pada card ruangan
            $table->text('description')->nullable();            // Deskripsi panjang ruangan

            // Spesifikasi Kamar
            $table->string('room_size', 50)->nullable();        // Luas kamar, misal: "~40 m²"
            $table->string('bed_count', 50)->nullable();        // Jumlah bed, misal: "1 Tempat Tidur"
            $table->string('max_companion', 50)->nullable();    // Maks penunggu, misal: "Max 2 Penunggu"

            // Media
            $table->string('image_path')->nullable();           // Path foto landscape 16:9, disk public

            // Fasilitas & Tags (JSON)
            $table->json('amenities')->nullable();              // Array grup fasilitas [{group, items[]}]
            $table->json('highlight_tags')->nullable();         // Array icon+label [{icon, label}]

            // CTA
            $table->string('whatsapp_text')->nullable();        // Teks pesan WA untuk inquiry ruangan

            // Pengaturan Tampil
            $table->integer('sort_order')->default(0);          // Urutan tampil di halaman
            $table->boolean('is_active')->default(true);        // Toggle tampil/sembunyikan

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_facilities');
    }
};
