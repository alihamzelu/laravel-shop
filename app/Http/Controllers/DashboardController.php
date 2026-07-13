<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders()->latest()->get();


        return view('dashboard', compact('user', 'orders'));
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);

        return view('orders', compact('orders'));
    }

    public function wishlist()
    {
        $wishlistProducts = auth()->user()->wishlist()
            ->with(['category'])
            ->paginate(6);

        return view('wishlist', compact('wishlistProducts'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load(['address', 'items.product.category']);

        return view('order-detail', compact('order'));
    }
}
