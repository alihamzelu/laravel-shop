<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#0b0c10] text-gray-200 antialiased">

    <header class="bg-[#12141c] border-b border-gray-800 sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-black text-sky-500 tracking-wider">
                TECH <span class="text-white">WORLD</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="text-xs text-gray-400 hover:text-white transition">Back to Store</a>
                <div class="w-8 h-8 rounded-full bg-sky-500/20 border border-sky-500/50 flex items-center justify-center font-bold text-sky-400 text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}        
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">

            <aside class="w-full lg:w-1/4">
                @include('components.dashboard-aside')
            </aside>

            <div class="w-full lg:w-3/4 space-y-6">

                <div>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight">Saved Configurations</h1>
                    <p class="text-xs text-gray-500">Your personal wishlist network. Monitor stock availability and deploy to cart instantly.</p>
                </div>

                @if ($message = Session::get('success'))
                    <div class="bg-green-500/10 border border-green-500/30 rounded-lg p-4 text-green-400 text-sm animate-pulse">
                        {{ $message }}
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($wishlists as $wishlist)
                        <div class="bg-[#12141c] border border-gray-800 rounded-xl overflow-hidden group hover:border-sky-500/30 transition duration-300 flex flex-col relative">
                            
                            <form action="{{ route('wishlist.toggle', $wishlist->product) }}" method="POST" class="absolute top-3 right-3 z-10">
                                @csrf
                                <button type="submit" class="w-7 h-7 bg-[#0b0c10]/80 hover:bg-red-500/20 text-gray-400 hover:text-red-400 rounded-md border border-gray-800 hover:border-red-500/30 flex items-center justify-center transition duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>

                            <div class="h-40 bg-[#0b0c10] flex items-center justify-center p-4 relative overflow-hidden">
                                @if($wishlist->product->image)
                                    <img src="{{ asset('storage/'.$wishlist->product->image) }}" alt="{{ $wishlist->product->name }}" class="h-full w-full object-contain group-hover:scale-105 transition duration-500">
                                @else
                                    <svg class="w-12 h-12 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                @endif
                            </div>

                            <div class="p-4 flex flex-col flex-grow">
                                <span class="text-[9px] text-sky-400 font-bold uppercase tracking-wider mb-1">
                                    {{ $wishlist->product->category->name ?? 'Hardware' }}
                                </span>
                                
                                <a href="{{ route('products.show', $wishlist->product) }}" class="text-white font-semibold text-xs hover:text-sky-400 transition line-clamp-2 h-8 mb-4">
                                    {{ $wishlist->product->name }}
                                </a>

                                <div class="mt-auto pt-3 border-t border-gray-800/60 flex items-center justify-between">
                                    <span class="text-sm font-black text-white font-mono">
                                        ${{ number_format($wishlist->product->price, 2) }}
                                    </span>

                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full bg-[#12141c] border border-gray-800 rounded-xl p-16 text-center">
                            <svg class="w-10 h-10 text-gray-700 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Matrix Empty</h3>
                            <p class="text-[11px] text-gray-600 mb-4">You haven't bookmarked any hardware architectures yet.</p>
                            <a href="{{ route('home') }}" class="inline-block text-xs font-bold text-sky-400 hover:text-sky-300 transition uppercase">
                                Browse Products →
                            </a>
                        </div>
                    @endforelse
                </div>

                @if($wishlists->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="flex items-center space-x-2">
                            @if ($wishlists->onFirstPage())
                                <span class="px-3 py-2 text-xs text-gray-600 bg-gray-800/50 rounded border border-gray-800">← Previous</span>
                            @else
                                <a href="{{ $wishlists->previousPageUrl() }}" class="px-3 py-2 text-xs text-gray-400 hover:text-white bg-gray-800/50 hover:bg-sky-500/20 rounded border border-gray-800 hover:border-sky-500/30 transition">← Previous</a>
                            @endif

                            @foreach ($wishlists->getUrlRange(1, $wishlists->lastPage()) as $page => $url)
                                @if ($page == $wishlists->currentPage())
                                    <span class="px-3 py-2 text-xs font-bold text-sky-400 bg-sky-500/20 rounded border border-sky-500/30">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-3 py-2 text-xs text-gray-400 hover:text-white bg-gray-800/50 hover:bg-sky-500/20 rounded border border-gray-800 hover:border-sky-500/30 transition">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($wishlists->hasMorePages())
                                <a href="{{ $wishlists->nextPageUrl() }}" class="px-3 py-2 text-xs text-gray-400 hover:text-white bg-gray-800/50 hover:bg-sky-500/20 rounded border border-gray-800 hover:border-sky-500/30 transition">Next →</a>
                            @else
                                <span class="px-3 py-2 text-xs text-gray-600 bg-gray-800/50 rounded border border-gray-800">Next →</span>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </main>

    <footer class="bg-[#0e1017] border-t border-gray-900 pt-6 pb-6 text-gray-600 text-[10px] text-center mt-16">
        <p>&copy; 2026 Tech World. User Control Matrix.</p>
    </footer>

</body>

</html>