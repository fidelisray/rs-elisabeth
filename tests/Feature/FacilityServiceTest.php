<?php

namespace Tests\Feature;

use App\Models\FacilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class FacilityServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Bersihkan cache sebelum setiap test untuk memastikan isolasi yang sempurna.
     */
    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    // =========================================================================
    // HAPPY PATH: Skenario sukses
    // =========================================================================

    /**
     * [Happy Path] Memastikan slug di-generate otomatis dari field 'name'.
     */
    public function test_facility_service_auto_generates_slug_on_creation(): void
    {
        // 1. Arrange & Act
        $facility = FacilityService::create([
            'name'        => 'Fasilitas MRI 3D Modern',
            'description' => 'Deskripsi lengkap fasilitas.',
        ]);

        // 2. Assert
        $this->assertEquals('fasilitas-mri-3d-modern', $facility->slug);
    }

    /**
     * [Happy Path] Memastikan slug kustom tidak ditimpa saat slug sudah diisi.
     */
    public function test_facility_service_does_not_override_existing_slug(): void
    {
        // 1. Arrange & Act
        $facility = FacilityService::create([
            'name'        => 'Fasilitas CT Scan',
            'description' => 'Deskripsi.',
            'slug'        => 'slug-kustom-saya',
        ]);

        // 2. Assert: Slug kustom harus tetap dipertahankan
        $this->assertEquals('slug-kustom-saya', $facility->slug);
    }

    /**
     * [Happy Path] Memastikan cache dibersihkan saat fasilitas disimpan (create).
     */
    public function test_facility_service_clears_cache_on_saved(): void
    {
        // 1. Arrange: Masukkan data usang ke cache
        Cache::put('rs_web_cms_api_facility_services', 'data-lama-yang-tersimpan');
        $this->assertTrue(Cache::has('rs_web_cms_api_facility_services'));

        // 2. Act: Simpan fasilitas baru
        FacilityService::create([
            'name'        => 'Laboratorium Darah',
            'description' => 'Deskripsi.',
        ]);

        // 3. Assert: Cache harus terhapus
        $this->assertFalse(
            Cache::has('rs_web_cms_api_facility_services'),
            'Cache seharusnya terhapus setelah data disimpan!'
        );
    }

    /**
     * [Happy Path] Memastikan cache dibersihkan saat fasilitas dihapus (delete).
     */
    public function test_facility_service_clears_cache_on_deleted(): void
    {
        // 1. Arrange: Buat data dan isi cache
        $facility = FacilityService::create([
            'name'        => 'Radiologi',
            'description' => 'Deskripsi.',
        ]);
        Cache::put('rs_web_cms_api_facility_services', 'data-lama');
        $this->assertTrue(Cache::has('rs_web_cms_api_facility_services'));

        // 2. Act: Hapus fasilitas
        $facility->delete();

        // 3. Assert: Cache harus terhapus
        $this->assertFalse(
            Cache::has('rs_web_cms_api_facility_services'),
            'Cache seharusnya terhapus setelah data dihapus!'
        );
    }

    /**
     * [Happy Path] Memastikan field 'highlights' tersimpan dan ter-cast sebagai Array.
     */
    public function test_facility_service_highlights_is_cast_as_array(): void
    {
        // 1. Arrange & Act
        $facility = FacilityService::create([
            'name'        => 'ICU',
            'description' => 'Deskripsi.',
            'highlights'  => ['Perawat 24 jam', 'Monitor jantung', 'Ventilator'],
        ]);

        // 2. Assert: Harus ter-cast kembali sebagai PHP Array, bukan JSON string
        $this->assertIsArray($facility->fresh()->highlights);
        $this->assertCount(3, $facility->fresh()->highlights);
        $this->assertContains('Perawat 24 jam', $facility->fresh()->highlights);
    }

    // =========================================================================
    // SAD PATH: Skenario gagal / penolakan data tidak valid
    // =========================================================================

    /**
     * [Sad Path] Memastikan fasilitas TIDAK bisa dibuat tanpa field 'name' (required).
     */
    public function test_facility_service_creation_fails_without_name(): void
    {
        // Assert: Exception harus dilempar saat mencoba menyimpan tanpa 'name'
        $this->expectException(\Illuminate\Database\QueryException::class);

        FacilityService::create([
            'description' => 'Deskripsi tanpa nama fasilitas.',
        ]);
    }
}
