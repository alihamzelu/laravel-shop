<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Confirm Password | Tech World</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0c10] text-gray-200 antialiased min-h-screen flex flex-col justify-between relative overflow-x-hidden">

    <div class="absolute top-[-20%] left-[-10%] w-[500px] h-[500px] bg-sky-500/5 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-sky-500/5 rounded-full blur-[120px] pointer-events-none"></div>

    <header class="py-6 text-center z-10">
        <a href="/" class="text-2xl font-black text-sky-500 tracking-wider inline-block">
            TECH <span class="text-white">WORLD</span>
        </a>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-6 z-10">
        <div class="bg-[#12141c] border border-gray-800 rounded-xl max-w-md w-full p-6 sm:p-8 shadow-2xl shadow-sky-500/5">
            
            <div class="w-14 h-14 bg-sky-500/10 text-sky-400 rounded-full flex items-center justify-center mx-auto mb-4 border border-sky-500/20 text-xl">
                🛡️
            </div>

            <h2 class="text-xl font-black uppercase tracking-tight text-white text-center mb-2">Security Check</h2>
            
            <p class="text-xs text-gray-400 text-center leading-relaxed mb-6">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="password" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Your Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" autofocus
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition"
                           placeholder="••••••••">
                    @error('password')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-black font-extrabold uppercase tracking-wider py-3.5 px-4 rounded-md shadow-lg shadow-sky-500/10 transition duration-300 text-xs">
                    {{ __('Confirm') }}
                </button>
            </form>

        </div>
    </main>

    <footer class="bg-[#0e1017] border-t border-gray-900 py-4 text-gray-600 text-[10px] text-center z-10">
        <p>&copy; {{ date('Y') }} Tech World. Secure Access Verification.</p>
    </footer>

</body>
</html>