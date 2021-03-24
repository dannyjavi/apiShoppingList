<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_a_user_authenticated_delete_a_product()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();

        $this->actingAs($user);
                
        $params = $this->validParams();
        
        $product = Product::create($params);

        $url = route('api.v1.products.delete', $product);
        
        $response = $this->deleteJson($url);

        $response->assertNoContent();

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
