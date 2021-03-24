<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::applySorts(request('sort'))->get();

        return ProductCollection::make($products);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json($product,201);
    }

    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return ProductResource::make($product);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
