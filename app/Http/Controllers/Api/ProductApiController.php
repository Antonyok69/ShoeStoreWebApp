<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shoe;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'products' => Shoe::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'category' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        $product = Shoe::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock ?? 0,
            'category' => $request->category,
            'image' => $request->image,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product added successfully',
            'product' => $product
        ], 201);
    }

    public function show($id)
    {
        $product = Shoe::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Shoe::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => $request->stock ?? 0,
            'category' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock ?? 0,
            'category' => $request->category,
            'image' => $request->image ?? $product->image,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
    }

    public function destroy($id)
    {
        $product = Shoe::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}