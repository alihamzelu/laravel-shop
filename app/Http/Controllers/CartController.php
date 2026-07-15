<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = cart::where('user_id', auth()->id())
            ->with('items.product')
            ->first();

        return view('cart', compact('cart'));
    }


    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $quantity = $request->quantity;

        if ($product->stock < $quantity) {
            return redirect()
                ->back()
                ->with('error', 'Not enough stock available');
        }

        if ($product->stock <= 0) {
            return redirect()
                ->back()
                ->with('error', 'Product is out of stock');
        }

        $cart = cart::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        $item = cart_item::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $newQuantity = $item->quantity + $quantity;
            
            if ($newQuantity > $product->stock) {
                return redirect()
                    ->back()
                    ->with('error', 'Not enough stock for this quantity');
            }

            $item->increment('quantity', $quantity);

        } else {
            
            cart_item::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);

        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product added to cart successfully');
    }


    public function update(Request $request, cart_item $item)
    {
        if ($item->cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $quantity = $request->quantity;

        if ($item->product->stock < $quantity) {
            return redirect()
                ->back()
                ->with('error', 'Not enough stock available');
        }

        $item->update([
            'quantity' => $quantity
        ]);

        return redirect()
            ->back()
            ->with('success', 'Cart updated successfully');
    }


    public function remove(cart_item $item)
    {
        if ($item->cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $item->delete();

        return redirect()
            ->back()
            ->with('success', 'Product removed from cart');
    }
}