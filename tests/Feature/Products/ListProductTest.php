<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * fetch_single_product
     *
     * @return void
     */
    public function test_can_fetch_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson(route('api.v1.products.show', $product));

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


    public function test_can_fetch_all_product()
    {
        $this->withoutExceptionHandling();

        $product = Product::factory()->times(3)->create();

        $response = $this->getJson(route('api.v1.products.index'));

        $response->assertExactJson([
            'data' => [
                [
                    'type' => 'products',
                    'id' => (string) $product[0]->getRouteKey(),
                    'attributes' => [
                            'name' => $product[0]->name,
                            'slug' => $product[0]->slug,
                            'brand' => $product[0]->brand,
                            'price' => $product[0]->price,
                            'market' => $product[0]->market,
                            'user_id' => $product[0]->user_id,
                    ],
                    'links' => [
                        'self' => route('api.v1.products.show', $product[0])
                    ]
                ],
                [
                    'type' => 'products',
                    'id' => (string) $product[1]->getRouteKey(),
                    'attributes' => [
                        'name' => $product[1]->name,
                        'slug' => $product[1]->slug,
                        'brand' => $product[1]->brand,
                        'price' => $product[1]->price,
                        'market' => $product[1]->market,
                        'user_id' => $product[1]->user_id,
                    ],
                    'links' => [
                        'self' => route('api.v1.products.show', $product[1])
                    ]
                ],
                [
                    'type' => 'products',
                    'id' => (string) $product[2]->getRouteKey(),
                    'attributes' => [
                        'name' => $product[2]->name,
                        'slug' => $product[2]->slug,
                        'brand' => $product[2]->brand,
                        'price' => $product[2]->price,
                        'market' => $product[2]->market,
                        'user_id' => $product[2]->user_id,
                    ],
                    'links' => [
                        'self' => route('api.v1.products.show', $product[2])
                    ]
                ],
            ],
            'links' => [
                'self' => route('api.v1.products.index')
            ],
            'meta' => [
                'products_count' => 3
            ]
        ]);
    }
}
