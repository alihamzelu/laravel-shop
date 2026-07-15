<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::where('status', true)->get();

        return view('category',compact('categories','brands'));
    }
}
