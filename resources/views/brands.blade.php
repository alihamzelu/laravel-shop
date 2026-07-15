<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorized Brands | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#0b0c10] text-gray-200 antialiased min-h-screen flex flex-col justify-between relative overflow-x-hidden">

    <div class="absolute top-[15%] left-[-5%] w-[600px] h-[600px] bg-sky-500/5 rounded-full blur-[160px] pointer-events-none"></div>
    <div class="absolute bottom-[25%] right-[-5%] w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[140px] pointer-events-none"></div>

    @include('components.header')

    <main class="container mx-auto px-4 py-12 flex-grow z-10">

        <div class="max-w-xl mx-auto text-center mb-16">
            <h1 class="text-3xl font-black text-white uppercase tracking-tight mb-3">Hardware Manufacturers</h1>
            <p class="text-xs text-gray-500 leading-relaxed">We source directly from the core architects of computing. Filter inventory by authorized silicon developers and performance engineering brands.</p>
        </div>

        <div class="max-w-6xl mx-auto mb-20">
            <h2 class="text-xs font-bold text-sky-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span> Featured Powerhouses
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($brands as $brand)
                <a href="{{ route('products', ['brand' => [$brand->id]]) }}" class="bg-[#12141c] border border-gray-800 rounded-xl p-6 hover:border-sky-500/40 hover:shadow-2xl hover:shadow-sky-500/5 transition duration-300 text-center group flex flex-col justify-center items-center h-28">
                    <span class="text-lg font-black tracking-wider text-white group-hover:text-sky-400 transition font-mono">
                        {{ $brand->name }}
                    </span>
                    <span class="text-[9px] text-gray-600 uppercase tracking-widest mt-2 group-hover:text-gray-400 transition">
                        Official Partner Node
                    </span>
                </a>
                @endforeach
            </div>
        </div>

        <div class="max-w-6xl mx-auto">
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-8">Complete Brand Index (A-Z)</h2>

            <div class="space-y-8">
                @php
                // گروه‌بندی خودکار برندها بر اساس حرف اول نام آن‌ها و مرتب‌سازی کلیدها (A تا Z)
                $groupedBrands = $brands->groupBy(function($item) {
                return strtoupper(substr($item->name, 0, 1));
                })->sortKeys();
                @endphp

                @forelse ($groupedBrands as $letter => $brandList)
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 border-t border-gray-800/60 pt-6">
                    <div class="md:col-span-2 flex items-center">
                        <span class="text-3xl font-black text-sky-500/20 font-mono tracking-wider">{{ $letter }}</span>
                    </div>

                    <div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach ($brandList as $indexedBrand)
                        <a href="{{ route('products', ['brand' => [$indexedBrand->id]]) }}" class="text-xs text-gray-400 hover:text-sky-400 transition duration-200 flex items-center space-x-1.5 group">
                            <span class="w-1 h-1 bg-gray-800 group-hover:bg-sky-500 rounded-full transition"></span>
                            <span>{{ $indexedBrand->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="text-center p-8 bg-[#12141c] border border-gray-800 rounded-xl">
                    <p class="text-xs text-gray-500">No core manufacturers registered in the database array.</p>
                </div>
                @endforelse
            </div>
        </div>

    </main>

    @include('components.footer')
</body>

</html>