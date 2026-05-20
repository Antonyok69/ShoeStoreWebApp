<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'card_number' => 'required|string|max:50',
            'card_code' => 'required|string|max:20',
            'address' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cartItems = Cart::where('user_id', Auth::id())->with('shoe')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            if (!$item->shoe) {
                continue;
            }

            if ($item->shoe->stock < $item->quantity) {
                return redirect()->route('cart.show')
                    ->with('error', $item->shoe->name . ' does not have enough stock.');
            }

            Command::create([
                'user_id' => $item->user_id,
                'shoe_id' => $item->shoe_id,
                'quantity' => $item->quantity,
                'size' => $item->size,
                'price' => $item->shoe->price,
            ]);

            Order::create([
                'customer_name' => $request->full_name,
                'product_name' => $item->shoe->name,
                'quantity' => $item->quantity,
                'price' => $item->shoe->price,
                'total' => $item->quantity * $item->shoe->price,
                'address' => $request->address,
            ]);

            $shoe = $item->shoe;
            $shoe->stock = max(0, $shoe->stock - $item->quantity);
            $shoe->save();
        }

        Cart::where('user_id', Auth::id())->delete();

        Session::flash('success', 'Payment successful! Thank you for your purchase.');

        Session::put('latest_orders', $cartItems->map(function ($item) use ($request) {
    return [
        'product_name' => $item->shoe->name,
        'quantity' => $item->quantity,
        'price' => $item->shoe->price,
        'total' => $item->quantity * $item->shoe->price,
        'address' => $request->address,
    ];
})->toArray());

return redirect()->route('orderConfirmation');
    }

    public function showOrderConfirmation()
    {
       $latestOrders = Session::get('latest_orders', []);

    return view('Cart.orderConfirmation', compact('latestOrders'));
    }

    public function showPaymentForm()
    {
        return view('payment');
    }

    public function myOrders()
{
    $orders = Order::where('customer_name', Auth::user()->name)
        ->latest()
        ->get();

    return view('Cart.myOrders', compact('orders'));
}
}