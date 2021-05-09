<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validate = $request->validate([
            'search'       => 'sometimes|string',
            'sort'         => 'sometimes|string|in:desc,asc',
        ]);

        // Get all product that has active category
        $products = Product::whereHas('category', function ($query){
            $query->active();
        });

        // Filter product name and category name by search parameter
        if($request->has('search')) {
            $products
                ->where('name', 'like', "%{$request->input('search')}%")
                ->orWhereHas('category', function ($query) use ($request) {
                    $query->where('name', 'like', "%{$request->input('search')}%");
                });
        }

        // Order by price, the direction of the sort come from sort parameter
        if($request->has('sort')){
            $products->orderBy('price', $request->input('sort'));
        }

        // Return with Product resource collection
        return ProductResource::collection($products->paginate(Product::PAGINATION));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
