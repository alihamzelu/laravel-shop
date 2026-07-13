<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Reset Password | Tech World</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0c10] text-gray-200 antialiased min-h-screen flex flex-col justify-between relative overflow-x-hidden">

    <!-- Background Decorative Glows -->
    <div class="absolute top-[-20%] left-[-10%] w-[500px] h-[500px] bg-sky-500/5 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-sky-500/5 rounded-full blur-[120px] pointer-events-none"></div>

    <!-- Header / Logo Only -->
    <header class="py-6 text-center z-10">
        <a href="/" class="text-2xl font-black text-sky-500 tracking-wider inline-block">
            TECH <span class="text-white">WORLD</span>
        </a>
    </header>

    <!-- Main Auth Card Container -->
    <main class="flex-grow flex items-center justify-center px-4 py-6 z-10">
        <div class="bg-[#12141c] border border-gray-800 rounded-xl max-w-md w-full p-6 sm:p-8 shadow-2xl shadow-sky-500/5">
            
            <!-- Key / Shield Icon Indicator -->
            <div class="w-14 h-14 bg-sky-500/10 text-sky-400 rounded-full flex items-center justify-center mx-auto mb-4 border border-sky-500/20 text-xl">
                🔑
            </div>

            <h2 class="text-xl font-black uppercase tracking-tight text-white text-center mb-2">Create New Password</h2>
            <p class="text-xs text-gray-500 text-center mb-6">Please enter your email and choose a strong secure password.</p>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf

                <!-- Password Reset Token (Crucial for Breeze Backend) -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition">
                    @error('email')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">New Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition">
                    @error('password')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Confirm New Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition">
                    @error('password_confirmation')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-black font-extrabold uppercase tracking-wider py-3.5 px-4 rounded-md shadow-lg shadow-sky-500/10 transition duration-300 mt-2 text-sm">
                    {{ __('Reset Password') }}
                </button>
            </form>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#0e1017] border-t border-gray-900 py-4 text-gray-600 text-[10px] text-center z-10">
        <p>&copy; {{ date('Y') }} Tech World. Secured Auth Pipeline.</p>
    </footer>

</body>
</html>