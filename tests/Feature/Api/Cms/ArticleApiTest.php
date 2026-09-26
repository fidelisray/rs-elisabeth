<?php

namespace Tests\Feature\Api\Cms;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\GeneratesHmacHeaders;

class ArticleApiTest extends TestCase
{
    use RefreshDatabase, GeneratesHmacHeaders;

    public function test_api_returns_401_without_hmac_headers(): void
    {
        // Act: Request tanpa header HMAC
        $response = $this->getJson('/api/v1/cms/articles');

        // Assert
        $response->assertStatus(401)
                 ->assertJsonPath('success', false)
                 ->assertJsonPath('errors', 'Missing required headers: X-Cons-ID, X-Timestamp, X-Signature.');
    }

    public function test_api_returns_200_with_valid_hmac(): void
    {
        // Arrange
        Article::create([
            'judul' => 'Test Article',
            'content' => 'Content here',
            'is_active' => true,
        ]);

        // Act: Request DENGAN header HMAC dari trait
        $response = $this->withHmac()->getJson('/api/v1/cms/articles');

        // Assert
        $response->assertStatus(200)
                 ->assertJsonPath('data.0.title', 'Test Article');
    }

    public function test_api_returns_detail_data(): void
    {
        // Arrange
        $article = Article::create([
            'judul' => 'Detail Article',
            'slug' => 'detail-article',
            'content' => 'Content here',
            'is_active' => true,
        ]);

        // Act
        $response = $this->withHmac()->getJson('/api/v1/cms/articles/' . $article->id);

        // Assert
        $response->assertStatus(200)
                 ->assertJsonPath('data.title', 'Detail Article');
    }
}
