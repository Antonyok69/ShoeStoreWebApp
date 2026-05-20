<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewCommandNotification;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        Session::flash('success', 'Payment successful! Thank you for your purchase.');

        $user = Auth::user();

        $cartItems = Cart::where('user_id', Auth::id())->with('shoe')->get();

        foreach ($cartItems as $item) {

            Command::create([
                'user_id' => $item->user_id,
                'shoe_id' => $item->shoe_id,
                'quantity' => $item->quantity,
                'size' => $item->size,
                'price' => $item->shoe->price,
            ]);

            Order::create([
                'customer_name' => $user->name,
                'product_name' => $item->shoe->name,
                'quantity' => $item->quantity,
                'price' => $item->shoe->price,
                'total' => $item->quantity * $item->shoe->price,
                'address' => $request->address
            ]);

            $shoe = $item->shoe;
            $shoe->stock -= $item->quantity;
            $shoe->save();
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orderConfirmation');
    }

    public function showOrderConfirmation()
    {
        return view('cart.orderConfirmation');
    }

    public function showPaymentForm()
    {
        return view('payment');
    }
}