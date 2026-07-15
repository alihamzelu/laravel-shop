<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .custom-checkbox:checked {
            background-color: #0ea5e9;
            border-color: #0ea5e9;
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #0b0c10;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #1f2937;
            border-radius: 2px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #0ea5e9;
        }
    </style>
</head>

<body class="bg-[#0b0c10] text-gray-200 antialiased min-h-screen flex flex-col relative overflow-x-hidden">

    <div class="absolute top-[20%] left-[-10%] w-[500px] h-[500px] bg-sky-500/5 rounded-full blur-[150px] pointer-events-none z-0"></div>

    @include('components.header')

    <main x-data="{ filterOpen: false }" class="container mx-auto px-4 py-8 flex-grow z-10 flex flex-col lg:flex-row gap-8">

        <aside class="w-full lg:w-1/4 lg:block" :class="filterOpen ? 'block' : 'hidden'">
            <div class="bg-[#12141c] border border-gray-800 rounded-xl p-5 sticky top-24">

                <div class="flex items-center justify-between mb-6 lg:mb-4">
                    <h2 class="text-lg font-black text-white uppercase tracking-wider">Filters</h2>
                    <button @click="filterOpen = false" class="lg:hidden text-gray-500 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="filter-form" action="{{ route('products') }}" method="GET" class="space-y-6">

                    <div>
                        <label class="text-xs text-gray-400 font-bold uppercase mb-2 block">Search</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                                class="w-full bg-[#0b0c10] border border-gray-800 text-sm text-white rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:border-sky-500 transition">
                            <svg class="w-4 h-4 text-gray-500 absolute left-3 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <hr class="border-gray-800/60">

                    <div>
                        <label class="text-xs text-gray-400 font-bold uppercase mb-3 block">Category</label>
                        <div class="space-y-2.5 max-h-48 overflow-y-auto custom-scrollbar pr-1">
                            @foreach($categories as $category)
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input
                                    type="checkbox"
                                    name="category[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}
                                    class="custom-checkbox appearance-none w-4 h-4 bg-[#0b0c10] border border-gray-700 rounded cursor-pointer transition group-hover:border-sky-500">
                                <span class="text-sm text-gray-400 group-hover:text-white transition">
                                    {{ $category->name }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-gray-800/60">

                    <div>
                        <label class="text-xs text-gray-400 font-bold uppercase mb-3 block">Brand</label>
                        <div class="space-y-2.5 max-h-48 overflow-y-auto custom-scrollbar pr-1">
                            @foreach($brands as $brand)
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input
                                    type="checkbox"
                                    name="brand[]"
                                    value="{{ $brand->id }}"
                                    {{ in_array($brand->id, request('brand',[])) ? 'checked' : '' }}
                                    class="custom-checkbox appearance-none w-4 h-4 bg-[#0b0c10] border border-gray-700 rounded cursor-pointer transition group-hover:border-sky-500">
                                <span class="text-sm text-gray-400 group-hover:text-white transition">{{ $brand->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-gray-800/60">

                    <div>
                        <label class="text-xs text-gray-400 font-bold uppercase mb-3 block">Price Range ($)</label>
                        <div class="flex items-center space-x-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-1/2 bg-[#0b0c10] border border-gray-800 text-sm text-white rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500 text-center transition">
                            <span class="text-gray-500">-</span>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-1/2 bg-[#0b0c10] border border-gray-800 text-sm text-white rounded-lg px-3 py-2 focus:outline-none focus:border-sky-500 text-center transition">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-sky-500/10 border border-sky-500/50 hover:bg-sky-500 hover:text-black text-sky-400 text-xs font-bold uppercase py-3 rounded-lg transition duration-300 shadow-lg shadow-sky-500/5">
                        Apply Filters
                    </button>
                </form>
            </div>
        </aside>

        <div class="w-full lg:w-3/4 flex flex-col">

            <div class="bg-[#12141c] border border-gray-800 rounded-xl p-4 flex flex-wrap items-center justify-between mb-6 gap-4">

                <button @click="filterOpen = true" class="lg:hidden flex items-center space-x-2 bg-[#0b0c10] border border-gray-700 px-3 py-2 rounded text-sm font-medium text-white hover:border-sky-500 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filters</span>
                </button>

                @if($products->total() > 0)
                <div class="text-sm text-gray-400 hidden sm:block">
                    Showing <span class="text-white font-bold">{{ $products->firstItem() }}-{{ $products->lastItem() }}</span> of <span class="text-white font-bold">{{ $products->total() }}</span> results
                </div>
                @else
                <div class="text-sm text-gray-400 hidden sm:block">
                    No products found.
                </div>
                @endif

                <div class="flex items-center space-x-3 ml-auto relative">
                    <label class="text-xs text-gray-500 uppercase font-bold hidden sm:block">Sort by:</label>
                    <div class="relative flex items-center">
                        <select onchange="this.form.submit()" form="filter-form" name="sort" class="bg-[#0b0c10] border border-gray-800 text-white text-sm rounded-lg pl-3 pr-8 py-2 focus:outline-none focus:border-sky-500 appearance-none cursor-pointer transition">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-2.5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

                @forelse($products as $product)
                <div class="w-full bg-[#12141c] rounded-xl border border-gray-800/80 shadow-lg overflow-hidden hover:shadow-[0_0_30px_rgba(56,189,248,0.08)] hover:border-sky-500/30 transition-all duration-300 flex flex-col justify-between group relative">

                    <div class="relative bg-[#0b0c10] p-4 flex items-center justify-center h-52 overflow-hidden">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="max-h-full max-w-full object-contain mx-auto group-hover:scale-105 transition duration-500">
                        @else
                        <div class="flex flex-col items-center justify-center text-gray-600 group-hover:text-sky-500/20 transition duration-500">
                            <svg class="w-12 h-12 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="text-[10px] uppercase tracking-widest font-mono">No Image</span>
                        </div>
                        @endif

                        @if($product->hasActiveDeal())
                        <span class="absolute top-3 left-3 bg-red-500 text-white font-black text-[10px] px-3 py-1 rounded-full uppercase tracking-wider z-10 shadow-lg shadow-red-500/20">
                            -{{ $product->discount_percent }}% OFF
                        </span>
                        @endif

                        <div class="absolute top-3 right-3 z-20">
                            @auth
                            @php
                            $isWishlisted = auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists();
                            @endphp
                            <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="h-8 w-8 rounded-full bg-[#0b0c10]/80 border flex items-center justify-center transition duration-200 focus:outline-none {{ $isWishlisted ? 'text-red-500 border-red-500/20 bg-red-500/10' : 'text-gray-400 border-gray-800 hover:text-red-400 hover:bg-red-500/5' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="{{ $isWishlisted ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="h-8 w-8 rounded-full bg-[#0b0c10]/80 border border-gray-800 flex items-center justify-center text-gray-400 hover:text-red-400 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </a>
                            @endauth
                        </div>
                    </div>

                    <div class="p-5 flex flex-col justify-between flex-grow">
                        <div class="mb-4">
                            <p class="text-[10px] text-sky-400 font-bold uppercase tracking-wider mb-1">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </p>
                            <a href="{{ route('products.show', $product->slug) }}">
                                <h3 class="text-sm font-bold text-white tracking-tight hover:text-sky-400 transition duration-300 line-clamp-2 min-h-[40px]">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            <p class="text-[11px] text-gray-500 mt-1 uppercase tracking-wider font-mono">
                                {{ $product->brand->name ?? 'Premium Gear' }}
                            </p>
                        </div>

                        <div class="flex justify-between items-center mb-5">
                            <div class="space-y-0.5">
                                <p class="text-lg font-black text-white">
                                    ${{ number_format($product->final_price, 2) }}
                                </p>
                                @if($product->hasActiveDeal())
                                <p class="text-xs text-gray-500 line-through">
                                    ${{ number_format($product->price, 2) }}
                                </p>
                                @endif
                            </div>

                            @php
                            $rating = $product->reviews->avg('rating') ?: 0;
                            $fullStars = floor($rating);
                            $emptyStars = 5 - $fullStars;
                            @endphp
                            <div class="flex items-center gap-0.5">
                                <div class="text-yellow-400 flex text-xs">
                                    {!! str_repeat('★', $fullStars) !!}
                                </div>
                                <div class="text-gray-700 flex text-xs">
                                    {!! str_repeat('★', $emptyStars) !!}
                                </div>
                                <span class="text-[10px] text-gray-500 ml-1">({{ $product->reviews->count() }})</span>
                            </div>
                        </div>

                        <form action="{{ route('cart.add', $product) }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full bg-gray-800/80 hover:bg-sky-500 hover:text-black text-gray-300 hover:shadow-lg hover:shadow-sky-500/10 font-bold py-3 rounded-lg text-xs transition-all duration-300 tracking-wider uppercase flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Deploy to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-12 text-center text-gray-500 border border-dashed border-gray-800 rounded-xl">
                    No products found in this category.
                </div>
                @endforelse

            </div>

            <div class="mt-10 flex justify-center">
                {{ $products->links() }}
            </div>

        </div>
    </main>

    @include('components.footer')

</body>

</html>