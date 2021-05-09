<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class ProductTest extends TestCase
{
    /**
     * Unit test for product endpoint without parameters.
     *
     * @return void
     */
    public function test_can_list_products()
    {
        Product::factory(10)->create();

        $response = $this->json('GET', route('product'));
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true
            ])
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'productName',
                        'productPrice',
                        'categoryId',
                        'categoryName',
                    ]
                ]
            ]);
    }

    /**
     * Unit test for product endpoint with search parameters.
     *
     * @return void
     */
    public function test_can_list_products_with_search_param()
    {
        $product = Product::factory(1)->create()->first();

        $response = $this->json('GET', route('product'), ['search' => $product->name]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true
            ])
            ->assertJsonFragment([
                'productName' => $product->name
            ])
        ;
    }

    /**
     * Unit test for product endpoint with sort parameters.
     *
     * @return void
     */
    public function test_can_list_products_sort_by_price()
    {
        $destination = 'desc';
        Product::factory(10)->create();

        $product = Product::whereHas('category', function ($query) {
            $query->active();
        })->orderBy('price', $destination)->first();

        $response = $this->json('GET', route('product'), ['sort' => $destination]);

        $list = json_decode($response->content());
        $this->assertEquals($product->name, $list->data[0]->productName);
    }
}
