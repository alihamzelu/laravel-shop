<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $reviews = Review::all();


        $products = Product::where('is_active', 1)
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('categories','products','reviews'));
    }
}
