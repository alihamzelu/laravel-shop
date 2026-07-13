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

<body class="bg-[#0b0c10] text-gray-200 antialiased">

    @include('components.header')

    <!-- Hero Section -->
    <section class="relative bg-[#12141c] overflow-hidden border-b border-gray-800">
        <div class="absolute inset-0 z-0 opacity-40">
            <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Gaming Hardware" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0b0c10] via-transparent to-[#0b0c10]"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 py-24 md:py-36 max-w-4xl text-center md:text-left">
            <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tight leading-tight mb-6">
                Elevate Your Gaming <br class="hidden md:inline"> & Tech. <span class="text-sky-500">Shop Now!</span>
            </h1>
            <p class="text-lg text-gray-400 mb-8 max-w-xl">
                Discover the latest high-performance PCs, next-gen consoles, premium components, and elite gaming accessories.
            </p>
            <a href="{{ route('products') }}" class="inline-block bg-sky-500 hover:bg-sky-600 text-black font-extrabold tracking-wider uppercase py-4 px-10 rounded shadow-lg shadow-sky-500/20 transition duration-300">
                Shop Now
            </a>
        </div>
    </section>

    <!-- Quick Categories Grid -->
    <section class="py-16 container mx-auto px-4">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- ✅ Category Icons - dynamic --}}
            @php
                $categoryIcons = [
                    '🖥️',  // Computers
                    '🎮',  // Gaming
                    '⚙️',  // Components
                    '🎧',  // Accessories
                ];
            @endphp

            @foreach ($categories as $key => $category)
                <div class="bg-[#161922] border border-gray-800 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:border-sky-500/50 transition group cursor-pointer">
                    <div class="text-4xl mb-3 group-hover:scale-110 transition duration-300">
                        {{ $categoryIcons[$key % count($categoryIcons)] }}
                    </div>
                    <a href="{{ route('products', ['category[]' => $category->id]) }}">
                        <h3 class="font-bold text-lg text-white group-hover:text-sky-400 transition">
                            {{ $category->name }}
                        </h3>
                    </a>
                </div>
            @endforeach

        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="py-12 bg-[#0e1017]">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-end mb-8">
                <h2 class="text-2xl md:text-3xl font-black uppercase tracking-wide">New Arrivals</h2>
                <a href="{{ route('products') }}" class="text-sky-400 hover:underline text-sm font-semibold">View All Items &rarr;</a>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($products as $product)
                <div class="bg-[#161922] border border-gray-800 rounded-lg p-5 flex flex-col justify-between hover:shadow-xl transition-all duration-300 hover:border-sky-500/30">

                    <!-- تصویر محصول -->
                    <div class="bg-[#1a1e29] rounded p-4 mb-4 flex items-center justify-center h-48 overflow-hidden">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="max-h-full w-full object-contain hover:scale-105 transition-transform duration-500">
                        @else
                        <span class="text-xs text-gray-500">No Image</span>
                        @endif
                    </div>

                    <!-- امتیاز -->
                    <div class="flex items-center text-amber-400 text-sm mb-2">
                        ★
                        <span class="text-gray-400 ml-1">
                            {{ $product->reviews->avg('rating') ? number_format($product->reviews->avg('rating'), 1) : '0.0' }}
                        </span>
                        <span class="text-gray-500 text-xs ml-2">
                            ({{ $product->reviews->count() }})
                        </span>
                    </div>

                    <!-- نام محصول -->
                    <a href="{{ route('products.show', $product) }}" class="block group">
                        <h3 class="font-bold text-white tracking-tight mb-3 line-clamp-2 min-h-[44px] group-hover:text-sky-400 transition">
                            {{ $product->name }}
                        </h3>
                    </a>

                    <!-- قیمت و تخفیف -->
                    <div class="mt-auto">
                        <div class="flex items-baseline gap-2 mb-4">
                            @php
                            $finalPrice = $product->final_price ?? $product->price;
                            $hasDiscount = $product->deal && $product->deal->discount_percent > 0;
                            @endphp

                            <span class="text-2xl font-black text-sky-400">
                                ${{ number_format($finalPrice, 2) }}
                            </span>

                            @if($hasDiscount)
                            <span class="text-sm text-gray-400 line-through">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            <span class="text-[10px] bg-red-500/10 text-red-400 px-1.5 py-0.5 rounded font-medium">
                                -{{ $product->deal->discount_percent }}%
                            </span>
                            @endif
                        </div>

                        {{-- ✅ صحیح شده: فرم درست --}}
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit"
                                class="w-full bg-gray-800 hover:bg-sky-500 hover:text-black text-white font-bold py-3 px-4 rounded text-sm transition-all duration-300 tracking-wide uppercase flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Add to Cart
                            </button>
                        </form>

                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Promotional Banner -->
    <section class="py-8 container mx-auto px-4">
        <div class="bg-gradient-to-r from-purple-900 via-indigo-950 to-blue-900 rounded-lg p-8 flex flex-col md:flex-row items-center justify-between border border-indigo-500/30 shadow-2xl">
            <div class="mb-6 md:mb-0 text-center md:text-left">
                <span class="bg-sky-500/10 text-sky-400 font-bold uppercase tracking-widest text-xs px-3 py-1 rounded border border-sky-500/20">Limited Time Offer</span>
                <h2 class="text-3xl font-black uppercase tracking-tight mt-3 mb-2">GAME ON! <span class="text-sky-400">15% OFF</span> ALL ACCESSORIES</h2>
                <p class="text-gray-300 text-sm max-w-md">Upgrade your headsets, mice, and controller setups. Use code <span class="text-white font-mono font-bold">GEAR15</span> at checkout.</p>
            </div>
            {{-- ✅ Link درست --}}
            <a href="{{ route('products') }}" class="bg-white hover:bg-gray-100 text-black font-extrabold uppercase px-8 py-3.5 rounded tracking-wide transition text-sm">
                Claim Discount
            </a>
        </div>
    </section>

    <!-- Brand Section -->
    <section class="py-12 border-t border-gray-900">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-8">Shop by Brand</h3>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 transition duration-500">
                <span class="text-xl font-black tracking-tighter text-white">NVIDIA</span>
                <span class="text-xl font-black tracking-widest text-white">SONY</span>
                <span class="text-xl font-bold tracking-tight text-white">XBOX</span>
                <span class="text-xl font-medium tracking-normal text-white">ASUS</span>
                <span class="text-xl font-semibold tracking-wider text-green-500">RAZER</span>
                <span class="text-xl font-bold italic text-white">intel</span>
                <span class="text-xl font-black text-red-500">AMD</span>
            </div>
        </div>
    </section>

    @include('components.footer')

</body>

</html>