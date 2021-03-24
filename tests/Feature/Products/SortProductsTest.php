<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SortProductsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_sort_products_by_name_asc()
    {
        $this->withoutExceptionHandling();
        
        Product::factory()->create(['name' => 'C Name']);
        Product::factory()->create(['name' => 'A Name']);
        Product::factory()->create(['name' => 'B Name']);

        $url = route('api.v1.products.index', ['sort' => 'name']);

        $this->getJson($url)->assertSeeInOrder([
            'A Name',
            'B Name',
            'C Name'
        ]);
    }

    public function test_can_sort_products_by_name_desc()
    {
        $this->withoutExceptionHandling();

        Product::factory()->create(['name' => 'C Name']);
        Product::factory()->create(['name' => 'A Name']);
        Product::factory()->create(['name' => 'B Name']);

        $url = route('api.v1.products.index', ['sort' => '-name']);

        $this->getJson($url)->assertSeeInOrder([
            'C Name',
            'B Name',
            'A Name'
        ]);
    }

    /* order by name and price */
    public function test_can_sort_products_by_brand_and_price_asc()
    {
        $this->withoutExceptionHandling();

        Product::factory()->create([
            'brand' => 'Carrefour', 
            'price' => 2.10]);
        Product::factory()->create([
            'brand' => 'Mercadona', 
            'price' => 3.24]);
        Product::factory()->create([
            'brand' => 'Dia', 
            'price' => 5.60]);

        // Esta es otra alternativa para ordenación
        $url = route('api.v1.products.index').'?sort=brand,-price';
        #$url = route('api.v1.products.index', ['sort' => 'name,price']);

        $this->getJson($url)->assertSeeInOrder([
            'Carrefour',
            'Dia',
            'Mercadona'
        ]);
    }

    public function test_can_sort_products_by_brand_and_price_desc()
    {
        $this->withoutExceptionHandling();

        Product::factory()->create([
            'brand' => 'Carrefour', 
            'price' => 2.10]);
        Product::factory()->create([
            'brand' => 'Mercadona', 
            'price' => 3.24]);
        Product::factory()->create([
            'brand' => 'Dia', 
            'price' => 5.60]);
        // Esta es otra alternativa para ordenación
        $url = route('api.v1.products.index'). '?sort=-price,brand';
        #$url = route('api.v1.products.index', ['sort' => 'name,price']);

        $this->getJson($url)->assertSeeInOrder([
            5.60,
            3.24,
            2.10,
        ]);
    }
    /* not order products by unknow, fields */
    public function test_cannot_sort_products_by_unknown_fields()
    {
        #$this->withoutExceptionHandling();

        Product::factory()->times(3)->create();

        // Esta es otra alternativa para ordenación
        $url = route('api.v1.products.index'). '?sort=unknown';
        #$url = route('api.v1.products.index', ['sort' => 'name,price']);

        $this->getJson($url)->assertStatus(400);
    }
}
