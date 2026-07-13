<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query();


        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }



        // Category Filter
        if ($request->filled('category')) {

            $query->whereIn('category_id', $request->category);
        }



        // Brand Filter
        if ($request->filled('brand')) {

            $query->whereIn('brand_id', $request->brand);
        }



        // Minimum Price
        if ($request->filled('min_price')) {

            $query->where('price', '>=', $request->min_price);
        }



        // Maximum Price
        if ($request->filled('max_price')) {

            $query->where('price', '<=', $request->max_price);
        }



        // Sorting
        switch ($request->sort) {

            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;


            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;


            case 'popular':
                $query->orderBy('views', 'desc');
                break;


            default:
                $query->latest();
        }



        $products = $query
            ->with('category')
            ->paginate(9)
            ->withQueryString();



        $categories = Category::all();

        $brands = brand::all();


        return view('products', compact(
            'products',
            'categories',
            'brands'
        ));
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'brand',
            'deal'
        ]);

        $categories = Category::all();

        $brands = Brand::all();

        $relatedProducts = Product::with(['category', 'brand'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('product_detail', compact(
            'product',
            'categories',
            'brands',
            'relatedProducts'
        ));
    }
}
