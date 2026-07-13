<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0c10] text-gray-200 antialiased min-h-screen flex flex-col justify-between relative overflow-x-hidden">

    <div class="absolute top-[10%] left-[-10%] w-[600px] h-[600px] bg-sky-500/5 rounded-full blur-[150px] pointer-events-none"></div>
    <div class="absolute bottom-[20%] right-[-10%] w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[130px] pointer-events-none"></div>

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
                <a href="/">TECH <span class="text-white">WORLD</span></a>
            </div>
            <nav class="hidden lg:flex space-x-8 text-sm font-medium text-gray-400">
                <a href="#" class="hover:text-white transition">Home</a>
                <a href="#" class="hover:text-white transition">Computers</a>
                <a href="#" class="hover:text-white transition">Components</a>
                <a href="#" class="hover:text-white transition">Gaming PCs</a>
                <a href="#" class="hover:text-white transition">Consoles</a>
                <a href="#" class="hover:text-white transition">Accessories</a>
                <a href="#" class="text-sky-400 transition">Contact</a>
            </nav>
            <div class="flex items-center space-x-6">
                <button class="text-gray-400 hover:text-sky-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}" class="hidden lg:flex items-center space-x-2 border border-gray-800 bg-[#161922]/50 hover:border-sky-500/30 px-3 py-1.5 rounded-full transition group">
                    <div class="w-6 h-6 rounded-full bg-sky-500/20 text-sky-400 flex items-center justify-center text-xs font-bold group-hover:bg-sky-500 group-hover:text-black transition">JD</div>
                    <span class="text-xs text-gray-300 font-semibold group-hover:text-white transition">Dashboard</span>
                </a>
            </div>
        </div>
        <div x-show="mobileMenuOpen" class="lg:hidden bg-[#12141c] border-b border-gray-800 px-4 pt-2 pb-6 space-y-3" x-cloak>
            <a href="#" class="block text-gray-400 hover:text-white text-sm font-medium py-2">Home</a>
            <a href="#" class="block text-gray-400 hover:text-white text-sm font-medium py-2">Computers</a>
            <a href="#" class="block text-gray-400 hover:text-white text-sm font-medium py-2">Components</a>
            <a href="#" class="block text-gray-400 hover:text-white text-sm font-medium py-2">Gaming PCs</a>
            <a href="#" class="block text-sky-400 text-sm font-semibold py-2">Contact</a>
            <div class="pt-4 border-t border-gray-800/60">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 bg-[#0b0c10] border border-gray-800 rounded-lg p-3 text-sm font-medium text-white hover:border-sky-500 transition">
                    <div class="w-8 h-8 rounded-full bg-sky-500/10 text-sky-400 flex items-center justify-center font-bold">JD</div>
                    <span class="text-xs font-bold">John Doe</span>
                </a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-12 flex-grow">
        
        <div class="text-center max-w-xl mx-auto mb-16">
            <h1 class="text-3xl font-black text-white uppercase tracking-tight mb-3">Get in Touch</h1>
            <p class="text-xs text-gray-500 leading-relaxed">Have a question about a custom gaming rig, component warranties, or wholesale orders? Drop us a line and our matrix tech team will respond within 24 hours.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 max-w-6xl mx-auto">
            
            <div class="lg:col-span-5 space-y-4">
                
                <div class="bg-[#12141c] border border-gray-800 p-5 rounded-xl flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-lg bg-sky-500/10 border border-sky-500/20 text-sky-400 flex items-center justify-center text-lg shrink-0">
                        ✉️
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-white uppercase tracking-wider mb-1">Electronic Mail</h3>
                        <p class="text-sm text-gray-300 font-mono">support@techworld.com</p>
                        <p class="text-[11px] text-gray-500 mt-0.5">For general and business inquiries.</p>
                    </div>
                </div>

                <div class="bg-[#12141c] border border-gray-800 p-5 rounded-xl flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-lg bg-sky-500/10 border border-sky-500/20 text-sky-400 flex items-center justify-center text-lg shrink-0">
                        📞
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-white uppercase tracking-wider mb-1">Hotline Support</h3>
                        <p class="text-sm text-gray-300 font-mono">+1 (555) 019-2834</p>
                        <p class="text-[11px] text-gray-500 mt-0.5">Mon - Fri, 9:00 AM to 6:00 PM EST.</p>
                    </div>
                </div>

                <div class="bg-[#12141c] border border-gray-800 p-5 rounded-xl flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-lg bg-sky-500/10 border border-sky-500/20 text-sky-400 flex items-center justify-center text-lg shrink-0">
                        📍
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-white uppercase tracking-wider mb-1">Headquarters</h3>
                        <p class="text-sm text-gray-300">Silicon Core Valley, Suite 404</p>
                        <p class="text-[11px] text-gray-500 mt-0.5">Tech City, CA 94016</p>
                    </div>
                </div>

                <div class="bg-[#12141c]/40 border border-gray-800/80 p-5 rounded-xl">
                    <h4 class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Connect on Networks</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="w-8 h-8 rounded bg-[#0b0c10] border border-gray-800 text-gray-400 hover:text-sky-400 hover:border-sky-500/30 flex items-center justify-center transition text-xs font-bold">TW</a>
                        <a href="#" class="w-8 h-8 rounded bg-[#0b0c10] border border-gray-800 text-gray-400 hover:text-sky-400 hover:border-sky-500/30 flex items-center justify-center transition text-xs font-bold">IG</a>
                        <a href="#" class="w-8 h-8 rounded bg-[#0b0c10] border border-gray-800 text-gray-400 hover:text-sky-400 hover:border-sky-500/30 flex items-center justify-center transition text-xs font-bold">DC</a>
                        <a href="#" class="w-8 h-8 rounded bg-[#0b0c10] border border-gray-800 text-gray-400 hover:text-sky-400 hover:border-sky-500/30 flex items-center justify-center transition text-xs font-bold">GH</a>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-7">
                <div class="bg-[#12141c] border border-gray-800 rounded-xl p-6 sm:p-8 shadow-xl">
                    
                    @if (session('success'))
                        <div class="mb-6 font-medium text-xs text-green-400 bg-green-500/10 p-4 rounded border border-green-500/20 text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="/contact" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Full Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition"
                                       placeholder="John Doe">
                                @error('name')
                                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                       class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition"
                                       placeholder="john@example.com">
                                @error('email')
                                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Subject</label>
                            <input id="subject" type="text" name="subject" value="{{ old('subject') }}" required
                                   class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('subject') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition"
                                   placeholder="Hardware Inquiry / Order Issue">
                            @error('subject')
                                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="5" required
                                      class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('message') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition resize-none"
                                      placeholder="Type your transmission here..."></textarea>
                            @error('message')
                                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-black font-extrabold uppercase tracking-wider py-3.5 px-4 rounded-md shadow-lg shadow-sky-500/10 transition duration-300 text-xs">
                                Dispatch Message
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </main>

    <footer class="bg-[#0e1017] border-t border-gray-900 py-6 text-gray-600 text-[10px] text-center z-10">
        <p>&copy; {{ date('Y') }} Tech World. Secure Communication Node.</p>
    </footer>

</body>
</html>