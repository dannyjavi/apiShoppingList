<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StoreProductsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_a_user_authenticated_create_a_product()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        $url = route('api.v1.products.store');

        $params = $this->validParams();

        $response = $this->postJson($url,$params);

        $response->assertCreated();

        $this->assertDatabaseHas('products',$params);
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
            ], $overrides);
    }
}
