<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\cart;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = cart::where('user_id', auth()->id())
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty');
        }

        $subtotal = $cart->items->sum(fn($item) => $item->product->final_price * $item->quantity);
        $shipping = 0;
        $tax = 0;
        $total = $subtotal + $shipping + $tax;

        return view('checkout', compact('cart', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'  => 'required|string|max:100',
            'last_name'   => 'required|string|max:100',
            'email'       => 'required|email',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string|max:500',
            'city'        => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        $cart = cart::where('user_id', auth()->id())
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty');
        }

        $subtotal = $cart->items->sum(fn($item) => $item->product->final_price * $item->quantity);
        $total = $subtotal;

        DB::beginTransaction();

        try {
            $address = Address::create([
                'user_id'        => auth()->id(),
                'first_name'     => $validated['first_name'],
                'last_name'      => $validated['last_name'],
                'email'          => $validated['email'],
                'phone_number'   => $validated['phone'],      
                'street_address' => $validated['address'],    
                'city'           => $validated['city'],
                'postal_code'    => $validated['postal_code'],
            ]);

            $order = Order::create([
                'user_id'     => auth()->id(),
                'first_name'  => $validated['first_name'],
                'last_name'   => $validated['last_name'],
                'email'       => $validated['email'],
                'phone'       => $validated['phone'],
                'address'     => $validated['address'],
                'city'        => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'total_price' => $total,
                'status'      => 'pending',
            ]);

            foreach ($cart->items as $item) {
                Order_item::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->final_price,
                ]);
            }

            Payment::create([
                'order_id' => $order->id,
                'amount'   => $total,
                'method'   => 'zarinpal',
                'status'   => 'pending',
            ]);

            $cart->items()->delete();

            DB::commit();

            return redirect()
                ->route('payment.index', $order)
                ->with('success', 'Order created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}