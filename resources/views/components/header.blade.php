<!DOCTYPE html>
<html>
<head>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>

<header x-data="{ mobileMenuOpen: false }" class="bg-[#12141c] border-b border-gray-800 sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">

        <div class="flex lg:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-400 hover:text-sky-400 transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="text-2xl font-black text-sky-500 tracking-wider">
            <a href="{{ route('home') }}">TECH <span class="text-white">WORLD</span></a>
        </div>

        <nav class="hidden lg:flex space-x-8 text-sm font-medium">
            <a href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'text-sky-400' : 'text-gray-400 hover:text-white' }} transition">
                Home
            </a>

            <a href="{{ route('products') }}"
                class="{{ request()->routeIs('products') ? 'text-sky-400' : 'text-gray-400 hover:text-white' }} transition">
                Products
            </a>
            
            <a href="{{ route('category.index') }}"
                class="{{ request()->routeIs('category.index') ? 'text-sky-400' : 'text-gray-400 hover:text-white' }} transition">
                Categories
            </a>
            
            <a href="{{ route('brands.index') }}"
                class="{{ request()->routeIs('brands.index') ? 'text-sky-400' : 'text-gray-400 hover:text-white' }} transition">
                Brands
            </a>

            @if(Route::has('deals.index'))
                <a href="{{ route('deals.index') }}"
                    class="{{ request()->routeIs('deals.index') ? 'text-sky-400' : 'text-gray-400 hover:text-white' }} transition">
                    Deals
                </a>
            @endif

        </nav>


        <div class="flex items-center space-x-4 sm:space-x-6">


            <a href="{{ route('cart.index') }}">
                <button class="relative text-gray-400 hover:text-sky-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if(Auth::check() && Auth::user()->cart && Auth::user()->cart->items->count() > 0)
                        <span class="absolute -top-2 -right-2 bg-sky-500 text-black font-bold text-xs w-4 h-4 rounded-full flex items-center justify-center">
                            {{ Auth::user()->cart->items->count() }}
                        </span>
                    @endif
                </button>
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="hidden lg:flex items-center space-x-2 border border-gray-800 bg-[#161922]/50 hover:border-sky-500/30 px-3 py-1.5 rounded-full transition group">
                    <div class="w-6 h-6 rounded-full bg-sky-500/20 text-sky-400 flex items-center justify-center text-xs font-bold group-hover:bg-sky-500 group-hover:text-black transition">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <span class="text-xs text-gray-300 font-semibold group-hover:text-white transition">Dashboard</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="hidden lg:flex items-center space-x-2 border border-gray-800 bg-[#161922]/50 hover:border-sky-500/30 px-3 py-1.5 rounded-full transition">
                    <span class="text-xs text-gray-300 font-semibold hover:text-white transition">Login</span>
                </a>
            @endauth
        </div>
    </div>

    <div x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden bg-[#12141c] border-b border-gray-800 px-4 pt-2 pb-6 space-y-3"
        x-cloak>

        <a href="{{ route('home') }}" class="block text-sky-400 text-sm font-semibold py-2">Home</a>
        <a href="{{ route('products') }}" class="block text-gray-400 hover:text-white text-sm font-medium py-2 transition">Products</a>
        <a href="{{ route('category.index') }}" class="block text-gray-400 hover:text-white text-sm font-medium py-2 transition">Categories</a>
        <a href="{{ route('brands.index') }}" class="block text-gray-400 hover:text-white text-sm font-medium py-2 transition">Brands</a>
        @if(Route::has('deals.index'))
            <a href="{{ route('deals.index') }}" class="block text-gray-400 hover:text-white text-sm font-medium py-2 transition">Deals</a>
        @endif
        <a href="{{ route('contact.index') }}" class="block text-gray-400 hover:text-white text-sm font-medium py-2 transition">Contact</a>

        <div class="pt-4 border-t border-gray-800/60">
            @auth
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 bg-[#0b0c10] border border-gray-800 rounded-lg p-3 text-sm font-medium text-white hover:border-sky-500 transition">
                    <div class="w-8 h-8 rounded-full bg-sky-500/10 text-sky-400 flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-xs font-bold">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-sky-400 font-semibold">Go to Dashboard →</p>
                    </div>
                </a>
            @else
                <a href="{{ route('login') }}" class="block bg-sky-500 hover:bg-sky-600 text-black font-bold text-sm py-2 px-4 rounded-lg text-center transition">
                    Login
                </a>
            @endauth
        </div>
    </div>
</header>

</body>
</html>