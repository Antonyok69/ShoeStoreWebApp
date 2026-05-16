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
        return response()->json([
            'message' => 'Product store API working'
        ]);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'Product update API working',
            'id' => $id
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'Product delete API working',
            'id' => $id
        ]);
    }
}