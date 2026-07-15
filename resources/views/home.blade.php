<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech World | Premium Gaming & Components</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#0b0c10] text-gray-200 antialiased selection:bg-sky-500 selection:text-black">

    @include('components.header')

    <section class="relative bg-[#12141c] overflow-hidden border-b border-gray-800/80">
        <div class="absolute inset-0 z-0 opacity-25">
            <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Gaming Hardware" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b0c10] via-transparent to-[#12141c]"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 py-28 md:py-40 max-w-5xl text-center">
            <span class="inline-block bg-sky-500/10 text-sky-400 font-bold uppercase tracking-widest text-[10px] px-3 py-1 rounded-full border border-sky-500/20 mb-6">
                Next-Gen Gaming Gear is Here
            </span>
            <h1 class="text-4xl md:text-7xl font-black uppercase tracking-tight leading-none mb-6 text-white">
                Elevate Your Gaming <br> & Tech Matrix. <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-indigo-500">Shop Now!</span>
            </h1>
            <p class="text-base md:text-lg text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                Discover the latest high-performance PCs, next-gen consoles, premium components, and elite gaming accessories built for champions.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('products') }}" class="w-full sm:w-auto inline-block bg-sky-500 hover:bg-sky-400 text-black font-black tracking-wider uppercase py-4 px-10 rounded transition duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-sky-500/10">
                    Explore Inventory
                </a>
                <a href="#new-arrivals" class="w-full sm:w-auto inline-block bg-transparent border border-gray-700 hover:border-gray-500 text-gray-300 hover:text-white font-bold py-4 px-10 rounded transition duration-300">
                    See New Arrivals
                </a>
            </div>
        </div>
    </section>

    <section class="py-12 border-b border-gray-900 bg-[#0e1017]/50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex items-center gap-4 p-5 rounded-lg bg-[#12141c]/40 border border-gray-800/40">
                    <div class="w-12 h-12 rounded bg-sky-500/10 flex items-center justify-center text-sky-400 text-xl font-bold">⚡</div>
                    <div>
                        <h4 class="text-sm font-bold text-white uppercase tracking-wider">Lightning Delivery</h4>
                        <p class="text-xs text-gray-500 mt-1">Instant dispatcher integration & rapid dispatch.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 p-5 rounded-lg bg-[#12141c]/40 border border-gray-800/40">
                    <div class="w-12 h-12 rounded bg-indigo-500/10 flex items-center justify-center text-indigo-400 text-xl font-bold">🛡️</div>
                    <div>
                        <h4 class="text-sm font-bold text-white uppercase tracking-wider">Secured Payments</h4>
                        <p class="text-xs text-gray-500 mt-1">Full checkout encryption & 100% security guarantee.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 p-5 rounded-lg bg-[#12141c]/40 border border-gray-800/40">
                    <div class="w-12 h-12 rounded bg-emerald-500/10 flex items-center justify-center text-emerald-400 text-xl font-bold">🎧</div>
                    <div>
                        <h4 class="text-sm font-bold text-white uppercase tracking-wider">Elite Support</h4>
                        <p class="text-xs text-gray-500 mt-1">24/7 diagnostic support via our matrix console.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 container mx-auto px-4">
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-xs font-black uppercase tracking-widest text-sky-400">Classified Equipment</h2>
            <h3 class="text-2xl md:text-3xl font-black uppercase text-white mt-1">Browse by Department</h3>
        </div>

        @php
        $categoryBorders = [
        'hover:border-sky-500/30 hover:shadow-[0_0_20px_rgba(56,189,248,0.15)]',
        'hover:border-purple-500/30 hover:shadow-[0_0_20px_rgba(168,85,247,0.15)]',
        'hover:border-emerald-500/30 hover:shadow-[0_0_20px_rgba(16,185,129,0.15)]',
        'hover:border-rose-500/30 hover:shadow-[0_0_20px_rgba(244,63,94,0.15)]'
        ];
        @endphp

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($categories as $key => $category)
            @php
            $styleIndex = $key % count($categoryBorders);
            @endphp

            <a href="{{ route('products', ['category[]' => $category->id]) }}"
                class="bg-[#12141c] border border-gray-800/80 rounded-xl p-8 flex flex-col items-center justify-center text-center transition-all duration-300 group cursor-pointer {{ $categoryBorders[$styleIndex] }}">

                <div class="w-24 h-24 mb-4 overflow-hidden rounded-lg">
                    <img
                        src="{{ asset('storage/' . $category->image) }}"
                        alt="{{ $category->name }}"
                        class="w-full h-full object-contain group-hover:scale-110 transition duration-300">
                </div>

                <h3 class="font-extrabold text-white uppercase tracking-wider text-sm">
                    {{ $category->name }}
                </h3>

            </a>
            @endforeach
        </div>
    </section>


    @if($discountedProducts->isNotEmpty())
    <section class="py-20 bg-[#0e1017] border-y border-gray-950">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-xs font-black uppercase tracking-widest text-red-500 animate-pulse">● Live Price Drops</h2>
                    <h3 class="text-2xl md:text-3xl font-black uppercase text-white mt-1">Active Hot Deals</h3>
                </div>
                <span class="text-red-400 text-xs font-mono font-bold border border-red-500/20 bg-red-500/5 px-3 py-1 rounded">Time-Sensitive Protocol</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($discountedProducts as $product)
                <div class="w-full bg-[#12141c] rounded-xl border border-red-500/10 shadow-lg overflow-hidden hover:shadow-[0_0_30px_rgba(239,68,68,0.08)] hover:border-red-500/30 transition-all duration-300 flex flex-col justify-between group">

                    <div class="relative bg-[#0b0c10] p-4 flex items-center justify-center h-52">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition duration-500">
                        @else
                        <span class="text-xs text-gray-500 uppercase tracking-widest font-mono">No Image</span>
                        @endif

                        <span class="absolute top-3 left-3 bg-red-500 text-black font-black text-[10px] px-3 py-1 rounded-full uppercase tracking-wider">
                            -{{ $product->discount_percent }}% OFF
                        </span>

                        <div class="absolute top-3 right-3 z-20">
                            @auth
                            @php
                            $isWishlisted = auth()->user()->wishlist && auth()->user()->wishlist->contains($product->id);
                            @endphp
                            <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="h-8 w-8 rounded-full bg-[#0b0c10]/80 border flex items-center justify-center transition duration-200 focus:outline-none {{ $isWishlisted ? 'text-red-500 border-red-500/20 bg-red-500/10' : 'text-gray-400 border-gray-800 hover:text-red-400' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="{{ $isWishlisted ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="h-8 w-8 rounded-full bg-[#0b0c10]/80 border border-gray-800 flex items-center justify-center text-gray-400 hover:text-red-400 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </a>
                            @endauth
                        </div>
                    </div>

                    <div class="p-5 flex flex-col justify-between flex-grow">
                        <div class="mb-4">
                            <a href="{{ route('products.show', $product) }}">
                                <h3 class="text-sm font-bold text-white tracking-tight hover:text-red-400 transition duration-300 line-clamp-2 min-h-[40px]">{{ $product->name }}</h3>
                            </a>
                            <p class="text-[11px] text-gray-500 mt-1 uppercase tracking-wider font-mono">{{ $product->brand->name ?? 'Premium Gear' }}</p>
                        </div>

                        <div class="flex justify-between items-center mb-5">
                            <div class="space-y-0.5">
                                <p class="text-lg font-black text-red-400">${{ number_format($product->final_price, 2) }}</p>
                                <p class="text-xs text-gray-500 line-through">${{ number_format($product->price, 2) }}</p>
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
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-black font-black py-3 rounded-lg text-xs transition duration-300 tracking-wider uppercase flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Secure Deal
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif


    <section id="new-arrivals" class="py-20 bg-[#0b0c10] border-b border-gray-950">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-xs font-black uppercase tracking-widest text-sky-400">Tactical Gear</h2>
                    <h3 class="text-2xl md:text-3xl font-black uppercase text-white mt-1">New Arrivals</h3>
                </div>
                <a href="{{ route('products') }}" class="text-sky-400 hover:text-sky-300 transition text-xs font-bold uppercase tracking-wider flex items-center gap-1">
                    View All Items <span>&rarr;</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
        </div>
    </section>

    @if($reviews->isNotEmpty())
    <section class="py-20 bg-[#0e1017]/80 border-b border-gray-950">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-xs font-black uppercase tracking-widest text-emerald-400">★ User Transmission</h2>
                <h3 class="text-2xl md:text-3xl font-black uppercase text-white mt-1">Operator Feedback</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($reviews as $review)
                <div class="bg-[#12141c] border border-gray-800/40 rounded-xl p-6 relative flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 text-xs gap-0.5 mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                @endfor
                        </div>
                        <p class="text-sm text-gray-300 italic mb-4">"{{ $review->comment }}"</p>
                    </div>
                    <div class="border-t border-gray-800/60 pt-3 flex justify-between items-center text-[11px]">
                        <span class="text-white font-bold uppercase">{{ $review->user->name ?? 'Anonymous' }}</span>
                        <a href="{{ route('products.show', $review->product) }}" class="text-sky-400 hover:underline truncate max-w-[120px]">{{ $review->product->name }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="py-16 border-t border-gray-900/60 bg-[#0e1017]/30">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-xs font-black uppercase tracking-widest text-gray-600 mb-8">
                Certified Partners
            </h3>

            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-30 grayscale hover:opacity-60 transition duration-500">
                @foreach ($brands as $brand)
                <a href="{{ route('products', ['brand[]' => $brand->id]) }}"
                    class="text-xl font-black tracking-wider text-white hover:scale-110 transition duration-300">
                    {{ strtoupper($brand->name) }}
                </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('components.footer')

</body>

</html>