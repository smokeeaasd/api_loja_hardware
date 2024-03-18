<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);

        return response($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();

        return response($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Product::where('id', $id)->exists())
        {
            $product = Product::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);

            return response($product, 200);
        }

        return response()->json([
            'message' => 'Not found.'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Product::where('id', $id)->exists())
        {
            $product = Product::find($id);

            $product->name = is_null($request->name) ? $product->name : $request->name;
            $product->description = is_null($request->description) ? $product->description : $request->description;
            $product->price = is_null($request->price) ? $product->price : $request->price;

            $product->save();

            return response($product, 200);
        }

        return response()->json([
            'message' => 'Not found.'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Product::where('id', $id)->exists())
        {
            $product = Product::find($id);
            $product->delete();

            return response($product, 202);
        }

        return response()->json([
            'message' => 'Not found.'
        ], 404);
    }
}
