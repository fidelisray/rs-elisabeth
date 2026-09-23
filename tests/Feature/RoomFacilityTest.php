<?php

namespace Tests\Feature;

use App\Models\RoomFacility;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RoomFacilityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    // =========================================================================
    // HAPPY PATH
    // =========================================================================

    /**
     * [Happy Path] Memastikan slug di-generate otomatis dari field 'name'.
     */
    public function test_room_facility_auto_generates_slug_on_creation(): void
    {
        // 1. Arrange & Act
        $room = RoomFacility::create([
            'name'        => 'Kamar VIP Bougainville',
            'category'    => 'premium',
            'description' => 'Deskripsi kamar.',
        ]);

        // 2. Assert
        $this->assertEquals('kamar-vip-bougainville', $room->slug);
    }

    /**
     * [Happy Path] Memastikan slug kustom tidak ditimpa saat sudah diisi manual.
     */
    public function test_room_facility_does_not_override_existing_slug(): void
    {
        // 1. Arrange & Act
        $room = RoomFacility::create([
            'name'        => 'Kamar VVIP',
            'category'    => 'premium',
            'description' => 'Deskripsi kamar.',
            'slug'        => 'kamar-vvip-khusus',
        ]);

        // 2. Assert
        $this->assertEquals('kamar-vvip-khusus', $room->slug);
    }

    /**
     * [Happy Path] Memastikan field 'amenities' tersimpan dan ter-cast sebagai Array.
     */
    public function test_room_facility_amenities_is_cast_as_array(): void
    {
        // 1. Arrange & Act
        $room = RoomFacility::create([
            'name'        => 'Kamar Kelas 1',
            'category'    => 'standard',
            'description' => 'Deskripsi kamar.',
            'amenities'   => ['AC', 'TV 32 inch', 'Kamar Mandi Dalam'],
        ]);

        // 2. Assert: Harus ter-cast sebagai PHP Array
        $this->assertIsArray($room->fresh()->amenities);
        $this->assertCount(3, $room->fresh()->amenities);
        $this->assertContains('AC', $room->fresh()->amenities);
    }

    /**
     * [Happy Path] Memastikan field 'highlight_tags' tersimpan dan ter-cast sebagai Array.
     */
    public function test_room_facility_highlight_tags_is_cast_as_array(): void
    {
        // 1. Arrange & Act
        $room = RoomFacility::create([
            'name'           => 'Kamar Isolasi',
            'category'       => 'standard',
            'description'    => 'Deskripsi kamar.',
            'highlight_tags' => ['Steril', 'HEPA Filter', 'Tekanan Negatif'],
        ]);

        // 2. Assert
        $this->assertIsArray($room->fresh()->highlight_tags);
        $this->assertCount(3, $room->fresh()->highlight_tags);
        $this->assertContains('Steril', $room->fresh()->highlight_tags);
    }

    /**
     * [Happy Path] Memastikan cache dibersihkan saat kamar disimpan.
     */
    public function test_room_facility_clears_cache_on_saved(): void
    {
        // 1. Arrange
        Cache::put('rs_web_cms_api_room_facilities', 'data-lama');
        $this->assertTrue(Cache::has('rs_web_cms_api_room_facilities'));

        // 2. Act
        RoomFacility::create(['name' => 'Kamar Baru', 'category' => 'standard', 'description' => 'Deskripsi.']);

        // 3. Assert
        $this->assertFalse(
            Cache::has('rs_web_cms_api_room_facilities'),
            'Cache harus terhapus setelah data kamar disimpan!'
        );
    }

    /**
     * [Happy Path] Memastikan cache dibersihkan saat kamar dihapus.
     */
    public function test_room_facility_clears_cache_on_deleted(): void
    {
        // 1. Arrange
        $room = RoomFacility::create(['name' => 'Kamar Lama', 'category' => 'standard', 'description' => 'Deskripsi.']);
        Cache::put('rs_web_cms_api_room_facilities', 'data-lama');
        $this->assertTrue(Cache::has('rs_web_cms_api_room_facilities'));

        // 2. Act
        $room->delete();

        // 3. Assert
        $this->assertFalse(
            Cache::has('rs_web_cms_api_room_facilities'),
            'Cache harus terhapus setelah data kamar dihapus!'
        );
    }

    // =========================================================================
    // SAD PATH
    // =========================================================================

    /**
     * [Sad Path] Memastikan kamar TIDAK bisa dibuat tanpa field 'name'.
     */
    public function test_room_facility_creation_fails_without_name(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        RoomFacility::create(['description' => 'Deskripsi kamar tanpa nama.']);
    }
}
