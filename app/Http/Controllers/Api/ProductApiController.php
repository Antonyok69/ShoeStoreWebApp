<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shoe;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index()
    {
        return response()->json(Shoe::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
        ]);

        $shoe = Shoe::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $request->image ?? null,
        ]);

        return response()->json($shoe, 201);
    }

    public function update(Request $request, $id)
    {
        $shoe = Shoe::findOrFail($id);

        $shoe->update([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $request->image ?? $shoe->image,
        ]);

        return response()->json($shoe);
    }

    public function destroy($id)
    {
        $shoe = Shoe::findOrFail($id);
        $shoe->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
