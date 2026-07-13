<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ request()->routeIs('register') ? 'Sign Up' : 'Sign In' }} | Tech World</title>
    
    <!-- Scripts & Styles (Tailwind & Alpine) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js is perfect for Laravel Breeze template toggles -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .tab-active {
            border-color: #0ea5e9;
            color: #ffffff;
        }
    </style>
</head>
<body class="bg-[#0b0c10] text-gray-200 antialiased min-h-screen flex flex-col justify-between relative overflow-x-hidden"
      x-data="{ activeTab: '{{ request()->routeIs('register') ? 'signup' : 'login' }}' }">

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
            
            <!-- Tabs for Login / Sign Up -->
            <div class="flex border-b border-gray-800 mb-6 text-sm font-bold uppercase tracking-wider text-gray-500">
                <button type="button" 
                        @click="activeTab = 'login'; window.history.pushState({}, '', '{{ route('login') }}')" 
                        :class="{ 'tab-active': activeTab === 'login' }" 
                        class="flex-1 pb-3 border-b-2 border-transparent text-center hover:text-gray-300 transition">
                    Sign In
                </button>
                <button type="button" 
                        @click="activeTab = 'signup'; window.history.pushState({}, '', '{{ route('register') }}')" 
                        :class="{ 'tab-active': activeTab === 'signup' }" 
                        class="flex-1 pb-3 border-b-2 border-transparent text-center hover:text-gray-300 transition">
                    Sign Up
                </button>
            </div>

            <!-- Session Status (Laravel Breeze standard notification) -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-400 bg-green-500/10 p-3 rounded border border-green-500/20">
                    {{ session('status') }}
                </div>
            @endif

            <!-- 1. LARAVEL BREEZE LOGIN FORM -->
            <form id="login-form" method="POST" action="{{ route('login') }}" x-show="activeTab === 'login'" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="login_email" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Email Address</label>
                    <input id="login_email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition">
                    @error('email')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label Custom class="text-xs text-gray-400 font-semibold uppercase tracking-wider block">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-sky-400 hover:underline">Forgot password?</a>
                        @endif
                    </div>
                    <input id="login_password" type="password" name="password" required autocomplete="current-password"
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition">
                    @error('password')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center pt-1">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-sky-500 bg-gray-900 border-gray-700 rounded focus:ring-sky-500 focus:ring-offset-gray-900">
                    <label for="remember_me" class="ml-2 text-xs text-gray-400 cursor-pointer select-none">Keep me signed in on this device</label>
                </div>

                <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-black font-extrabold uppercase tracking-wider py-3 px-4 rounded-md shadow-lg shadow-sky-500/10 transition duration-300 mt-2 text-sm">
                    Sign In to Account
                </button>
            </form>


            <!-- 2. LARAVEL BREEZE REGISTER FORM -->
            <form id="signup-form" method="POST" action="{{ route('register') }}" x-show="activeTab === 'signup'" class="space-y-4" x-cloak>
                @csrf

                <!-- Name -->
                <div>
                    <label for="reg_name" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Full Name</label>
                    <input id="reg_name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition">
                    @error('name')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="reg_email" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Email Address</label>
                    <input id="reg_email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition">
                    @error('email')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="reg_password" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Password</label>
                    <input id="reg_password" type="password" name="password" required autocomplete="new-password"
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition">
                    @error('password')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password (Required by Breeze backend) -->
                <div>
                    <label for="password_confirmation" class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-800' }} focus:outline-none focus:border-sky-500 transition">
                    @error('password_confirmation')
                        <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-black font-extrabold uppercase tracking-wider py-3 px-4 rounded-md shadow-lg shadow-sky-500/10 transition duration-300 mt-4 text-sm">
                    Create Free Account
                </button>
            </form>

            <!-- Social Logins Divider -->
            <div class="relative my-6 flex items-center justify-center">
                <div class="border-t border-gray-800 w-full absolute"></div>
                <span class="bg-[#12141c] text-xs text-gray-500 uppercase px-3 z-10 font-bold tracking-wider">Or continue with</span>
            </div>

            <!-- Social Buttons -->
            <div class="grid grid-cols-2 gap-3">
                <button type="button" class="bg-[#0b0c10] border border-gray-800 hover:bg-[#161922] text-white text-xs font-bold py-2.5 px-4 rounded transition flex items-center justify-center gap-2">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z" fill="#EA4335"/></svg>
                    Google
                </button>
                <button type="button" class="bg-[#0b0c10] border border-gray-800 hover:bg-[#161922] text-white text-xs font-bold py-2.5 px-4 rounded transition flex items-center justify-center gap-2">
                    <svg class="h-4 w-4 text-[#5865F2]" viewBox="0 0 127.14 96.36" fill="currentColor"><path d="M107.7,8.07A105.15,105.15,0,0,0,77.26,0a77.19,77.19,0,0,0-3.3,6.83A96.67,96.67,0,0,0,53.22,6.83,77.19,77.19,0,0,0,49.88,0,105.15,105.15,0,0,0,19.44,8.07C3.66,31.58-1.86,54.65,1,77.53A105.73,105.73,0,0,0,32,96.36a74.37,74.37,0,0,0,6.71-11,68.6,68.6,0,0,1-10.57-5.12c.9-.65,1.76-1.34,2.58-2a75.58,75.58,0,0,0,72.76,0c.82.68,1.68,1.37,2.58,2a68.42,68.42,0,0,1-10.57,5.12,74.45,74.45,0,0,0,6.71,11,105.51,105.51,0,0,0,31-18.83C129.5,49.7,123.57,26.85,107.7,8.07ZM42.45,65.69C36.18,65.69,31,60,31,53S36.18,40.36,42.45,40.36,53.9,46,53.9,53,48.72,65.69,42.45,65.69Zm42.24,0C78.41,65.69,73.24,60,73.24,53S78.41,40.36,84.69,40.36,96.14,46,96.14,53,91,65.69,84.69,65.69Z"/></svg>
                    Discord
                </button>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#0e1017] border-t border-gray-900 py-4 text-gray-600 text-[10px] text-center z-10">
        <p>&copy; {{ date('Y') }} Tech World. Secured Laravel Breeze Environment.</p>
    </footer>

</body>
</html>