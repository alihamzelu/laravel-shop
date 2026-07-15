<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $reviews = Review::latest()->take(3)->get();
        $brands = Brand::where('status', true)->get();

        $products = Product::where('is_active', 1)
            ->latest()
            ->take(4)
            ->get();

        $discountedProducts = Product::whereHas('deal', function ($query) {
                $query->where('end_date', '>', now());
            })
            ->with(['deal', 'reviews'])
            ->where('is_active', 1)
            ->take(4)
            ->get();

        return view('home', compact('categories', 'products', 'reviews', 'brands', 'discountedProducts'));
    }
}