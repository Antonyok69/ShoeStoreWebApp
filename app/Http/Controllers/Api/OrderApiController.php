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

    public function destroy($id)
{
    $order = Order::find($id);

    if (!$order) {
        return response()->json([
            'success' => false,
            'message' => 'Order not found'
        ], 404);
    }

    $order->delete();

    return response()->json([
        'success' => true,
        'message' => 'Order deleted successfully'
    ]);
}
}