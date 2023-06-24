<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'location' => 'nullable',
            'quantity' => 'required|numeric',
            'price' => 'required|decimal:2',
            'description' => 'required'
        ]);

        Product::create($data);

        return response()->json([
            "message" => "Product added"
        ]);

    }

    public function get($id) {
        $product = Product::find($id);
        if (!empty($product)) {
            return response()->json($product);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }

    public function update(Request $request, $id) {
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->save();
            return response()->json([
                "message" => "Product updated"
            ], 202);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }

    public function delete($id) {
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->delete();

            return response()->json([
                "message" => "Product deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }
}
