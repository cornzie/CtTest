<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function productPageLoads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testProductSavesSuccessfull(): void
    {
        $productname = $this->faker->word();

        Storage::fake('local');

        $response = $this->post('/save-product', [
            'productName' => $productname,
            'productQuantity' => $this->faker->randomDigit(),
            'productPrice' => $this->faker->randomDigit(),
        ]);

        $response->assertStatus(302);
        
        Storage::disk('local')->assertExists('products.json');
    }
}
