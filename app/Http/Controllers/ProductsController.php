<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Review;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query();


        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }



        if ($request->filled('category')) {

            $query->whereIn('category_id', $request->category);
        }



        if ($request->filled('brand')) {

            $query->whereIn('brand_id', $request->brand);
        }



        if ($request->filled('min_price')) {

            $query->where('price', '>=', $request->min_price);
        }



        if ($request->filled('max_price')) {

            $query->where('price', '<=', $request->max_price);
        }



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
            'deal',
            'reviews.user'
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

    public function storeReview(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);

        if (!auth()->check()) {
            return back()->with('error', 'You must be logged in to leave a review.');
        }

        $product->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Your review has been submitted successfully!');
    }
}

