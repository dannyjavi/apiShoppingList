<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_a_user_update_a_product()
    {

        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $this->actingAs($user);
        
        $params = $this->validParams();

        $product = Product::create($params);

        $payload = [
            'brand' => 'Carrefour',
            'price' => 10.20
        ];

        $url = route('api.v1.products.update', $product->id);

        $response = $this->patchJson($url, $payload);
        
        $response->assertStatus(200);
        
        $product->refresh();

        $response->assertExactJson([
            'data' => [
                'type' => 'products',
                'id' => (string) $product->getRouteKey(),
                'attributes' => [
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'brand' => $product->brand,
                    'price' => $product->price,
                    'market' => $product->market,
                    'user_id' => $product->user_id,
                ],
                'links' => [
                    'self' => route('api.v1.products.show', $product)
                ]
            ]
        ]);
    }

    public function validParams($overrides = [])
    {
        return array_merge(
            [
                'name' => 'agua',
                'slug' => 'agua',
                'brand' => 'Bezoya',
                'price' => 8.45,
                'market' => 'Mercadona',
                'user_id' => auth()->user()->id
            ],
            $overrides
        );
    }
}
