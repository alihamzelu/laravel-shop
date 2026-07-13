<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0c10] text-gray-200 antialiased min-h-screen flex flex-col justify-between relative overflow-x-hidden">

    <div class="absolute top-[30%] right-[-10%] w-[500px] h-[500px] bg-sky-500/5 rounded-full blur-[150px] pointer-events-none"></div>
    <div class="absolute bottom-[10%] left-[-10%] w-[600px] h-[600px] bg-indigo-500/5 rounded-full blur-[180px] pointer-events-none"></div>

    @include('components.header')

    <main class="container mx-auto px-4 py-12 flex-grow z-10">
        
        <div class="max-w-2xl mx-auto text-center mb-16">
            <h1 class="text-3xl font-black text-white uppercase tracking-tight mb-3">Hardware Departments</h1>
            <p class="text-xs text-gray-500 leading-relaxed">Explore our specialized sectors. Select a category to filter down your perfect build components, peripheral arrays, or specialized computing systems.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 max-w-7xl mx-auto">
            @foreach ($categories as $category)
                @php
                    // اختصاص هوشمند آیکون بر اساس اسلاگ کتگوری برای تنوع بصری صفحه
                    $icon = '⚙️';
                    if (str_contains($category->slug, 'gpu') || str_contains($category->slug, 'graph')) $icon = '🔌';
                    elseif (str_contains($category->slug, 'cpu') || str_contains($category->slug, 'proc')) $icon = '🔲';
                    elseif (str_contains($category->slug, 'laptop') || str_contains($category->slug, 'note')) $icon = '💻';
                    elseif (str_contains($category->slug, 'monitor') || str_contains($category->slug, 'screen')) $icon = '🖥️';
                    elseif (str_contains($category->slug, 'game') || str_contains($category->slug, 'consol')) $icon = '🎮';
                    elseif (str_contains($category->slug, 'access') || str_contains($category->slug, 'key')) $icon = '⌨️';
                @endphp
            
                <div class="bg-[#12141c] border border-gray-800 rounded-xl p-6 hover:border-sky-500/50 hover:shadow-2xl hover:shadow-sky-500/5 transition duration-300 flex flex-col justify-between group shadow-xl">
                    <div>
                        <div class="w-12 h-12 bg-sky-500/10 border border-sky-500/20 text-sky-400 flex items-center justify-center text-xl rounded-lg mb-5 group-hover:bg-sky-500 group-hover:text-black transition duration-300">
                            {{ $icon }}
                        </div>
                        
                        <h2 class="text-lg font-bold text-white mb-1 group-hover:text-sky-400 transition">{{ $category->name }}</h2>
                        
                        <p class="text-[11px] text-gray-500 tracking-wide uppercase font-mono">Department Node: {{ $category->slug }}</p>
                    </div>
                    
                    <div class="mt-8">
                        <a href="{{ route('products', ['category' => [$category->id]]) }}" class="block text-center bg-[#0b0c10] border border-gray-800 hover:border-sky-500/40 text-gray-400 hover:text-white text-[11px] font-bold uppercase py-2.5 rounded transition duration-300 tracking-wider">
                            Explore Sector →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    @include('components.footer')

</body>
</html>