<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;
    
use Illuminate\Support\Facades\Mail;


use App\Mail\NewCommandNotification;
use Illuminate\Support\Facades\Session;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    //
    public function processPayment(Request $request)
    {
        // Perform payment processing logic here
        // Validate the form data, process the payment, etc.

        // After successful payment, you can display a success flash message
        Session::flash('success', 'Payment successful! Thank you for your purchase.');
           // Get the currently authenticated user
           $user = Auth::user();
            // Retrieve the cart items for the user
            $cartItems = $user->cartItems()->with('shoe')->get();

            // Create command entries for each cart item in the commands table
        foreach ($cartItems as $cartItem) {

            Command::create([
                'user_id' => $cartItem->user_id,
                'shoe_id' => $cartItem->shoe_id,
                'quantity' => $cartItem->quantity,
                'size' => $cartItem->size,
                'price' => $cartItem->shoe->price, // Assuming the price is stored in the shoe model
            ]);
                    }
            // Delete the user's cart items from the database
            $user->cartItems()->delete();
 // Send email notification to the admin
//  $adminEmail = 'ali.abdou.genie@gmail.com'; // Update with your admin email address

//  Mail::to($adminEmail)->send(new NewCommandNotification());

            // Redirect the user to a relevant page (e.g., order confirmation page)
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
