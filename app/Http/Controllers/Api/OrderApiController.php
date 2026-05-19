<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'orders' => Order::latest()->get()
        ]);
    }
}