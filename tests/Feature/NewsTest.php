<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class NewsTest extends TestCase
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
     * [Happy Path] Memastikan berita berhasil dibuat dengan data lengkap.
     */
    public function test_news_can_be_created_with_valid_data(): void
    {
        // 1. Arrange & Act
        $news = News::create([
            'title'   => 'RS Elisabeth Membuka Poli Baru',
            'slug'    => 'rs-elisabeth-membuka-poli-baru',
            'content' => 'Konten berita lengkap di sini.',
        ]);

        // 2. Assert
        $this->assertDatabaseHas('news', ['title' => 'RS Elisabeth Membuka Poli Baru']);
        $this->assertEquals('rs-elisabeth-membuka-poli-baru', $news->slug);
    }

    /**
     * [Happy Path] Memastikan cache dibersihkan saat berita disimpan.
     */
    public function test_news_clears_cache_on_saved(): void
    {
        // 1. Arrange
        Cache::put('rs_web_cms_api_news_version', 'data-lama');
        $this->assertTrue(Cache::has('rs_web_cms_api_news_version'));

        // 2. Act
        News::create([
            'title'   => 'Berita Baru',
            'slug'    => 'berita-baru',
            'content' => 'Isi berita.',
        ]);

        // 3. Assert
        $this->assertNotEquals('data-lama', Cache::get('rs_web_cms_api_news_version'), 'Cache version harus diperbarui!');
    }

    /**
     * [Happy Path] Memastikan cache dibersihkan saat berita dihapus.
     */
    public function test_news_clears_cache_on_deleted(): void
    {
        // 1. Arrange
        $news = News::create(['title' => 'Berita Lama', 'slug' => 'berita-lama', 'content' => 'Isi.']);
        Cache::put('rs_web_cms_api_news_version', 'data-lama');
        $this->assertTrue(Cache::has('rs_web_cms_api_news_version'));

        // 2. Act
        $news->delete();

        // 3. Assert
        $this->assertNotEquals('data-lama', Cache::get('rs_web_cms_api_news_version'), 'Cache version harus diperbarui!');
    }

    // =========================================================================
    // SAD PATH
    // =========================================================================

    /**
     * [Sad Path] Memastikan berita TIDAK bisa dibuat tanpa field 'title'.
     */
    public function test_news_creation_fails_without_title(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        News::create([
            'slug'    => 'slug-tanpa-judul',
            'content' => 'Konten tanpa judul.',
        ]);
    }

    /**
     * [Sad Path] Memastikan sistem menolak slug yang sudah ada (duplikat/unique).
     */
    public function test_news_creation_fails_with_duplicate_slug(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Buat berita pertama
        News::create(['title' => 'Berita 1', 'slug' => 'slug-sama', 'content' => 'Konten.']);

        // Coba buat berita kedua dengan slug yang sama — harus gagal
        News::create(['title' => 'Berita 2', 'slug' => 'slug-sama', 'content' => 'Konten.']);
    }
}
