<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;

class BrandController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $brands = Brand::all();
        return view('brands',compact('categories','brands'));
    }
}
