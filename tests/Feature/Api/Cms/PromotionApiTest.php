<?php

namespace Tests\Feature\Api\Cms;

use App\Models\Promotion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\GeneratesHmacHeaders;

class PromotionApiTest extends TestCase
{
    use RefreshDatabase, GeneratesHmacHeaders;

    public function test_api_returns_401_without_hmac_headers(): void
    {
        $response = $this->getJson('/api/v1/cms/promotions');
        $response->assertStatus(401);
    }

    public function test_api_returns_200_with_valid_hmac(): void
    {
        Promotion::create([
            'title' => 'Test Promo',
            'description' => 'Desc',
            'is_active' => true,
        ]);

        $response = $this->withHmac()->getJson('/api/v1/cms/promotions');
        $response->assertStatus(200)->assertJsonPath('data.0.title', 'Test Promo');
    }

    public function test_api_returns_detail_data(): void
    {
        $promo = Promotion::create([
            'title' => 'Detail Promo',
            'description' => 'Desc',
            'is_active' => true,
        ]);

        $response = $this->withHmac()->getJson('/api/v1/cms/promotions/' . $promo->id);
        $response->assertStatus(200)->assertJsonPath('data.title', 'Detail Promo');
    }
}
