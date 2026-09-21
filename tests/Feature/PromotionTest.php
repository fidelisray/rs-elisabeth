<?php

namespace Tests\Feature;

use App\Models\Promotion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PromotionTest extends TestCase
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
     * [Happy Path] Memastikan promosi berhasil dibuat dengan data lengkap.
     */
    public function test_promotion_can_be_created_with_valid_data(): void
    {
        // 1. Arrange & Act
        $promotion = Promotion::create([
            'title'       => 'Promo Khitan Gratis',
            'slug'        => 'promo-khitan-gratis',
            'description' => 'Deskripsi promo lengkap.',
        ]);

        // 2. Assert
        $this->assertDatabaseHas('promotions', ['title' => 'Promo Khitan Gratis']);
        $this->assertEquals('promo-khitan-gratis', $promotion->slug);
    }

    /**
     * [Happy Path] Memastikan cache dibersihkan saat promosi disimpan.
     */
    public function test_promotion_clears_cache_on_saved(): void
    {
        // 1. Arrange
        Cache::put('local_cms_promotions_', 'data-lama');
        $this->assertTrue(Cache::has('local_cms_promotions_'));

        // 2. Act
        Promotion::create([
            'title'       => 'Promo Check Up',
            'slug'        => 'promo-check-up',
            'description' => 'Deskripsi.',
        ]);

        // 3. Assert
        $this->assertFalse(Cache::has('local_cms_promotions_'), 'Cache harus terhapus setelah promosi disimpan!');
    }

    /**
     * [Happy Path] Memastikan cache dibersihkan saat promosi dihapus.
     */
    public function test_promotion_clears_cache_on_deleted(): void
    {
        // 1. Arrange
        $promotion = Promotion::create(['title' => 'Promo Lama', 'slug' => 'promo-lama', 'description' => 'Desc.']);
        Cache::put('local_cms_promotions_', 'data-lama');
        $this->assertTrue(Cache::has('local_cms_promotions_'));

        // 2. Act
        $promotion->delete();

        // 3. Assert
        $this->assertFalse(Cache::has('local_cms_promotions_'), 'Cache harus terhapus setelah promosi dihapus!');
    }

    // =========================================================================
    // SAD PATH
    // =========================================================================

    /**
     * [Sad Path] Memastikan sistem menolak promosi dengan slug yang duplikat (unique constraint).
     */
    public function test_promotion_creation_fails_with_duplicate_slug(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Promotion::create(['title' => 'Promo A', 'slug' => 'slug-sama', 'description' => 'Desc.']);
        Promotion::create(['title' => 'Promo B', 'slug' => 'slug-sama', 'description' => 'Desc.']);
    }

    /**
     * [Sad Path] Memastikan promosi TIDAK bisa dibuat tanpa field 'title'.
     */
    public function test_promotion_creation_fails_without_title(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Promotion::create(['slug' => 'slug-tanpa-judul', 'description' => 'Desc.']);
    }
}
