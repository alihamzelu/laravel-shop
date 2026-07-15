<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings | Tech World</title>
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

            <div class="w-full lg:w-3/4 space-y-8">

                <div>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight">Identity Settings</h1>
                    <p class="text-xs text-gray-500">Update your account credentials, security node information, and email address.</p>
                </div>

                @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl text-xs font-semibold flex items-center space-x-2">
                    <span>✓</span> <span>System parameters updated successfully inside the core network.</span>
                </div>
                @endif

                <div class="grid grid-cols-1 gap-8">

                    <div class="bg-[#12141c] border border-gray-800 rounded-lg p-6">
                        <div class="mb-6 pb-2 border-b border-gray-800">
                            <h2 class="text-sm font-black uppercase tracking-wider text-white">Profile Information</h2>
                            <p class="text-[11px] text-gray-500 mt-0.5">Update your account's profile name and email address contact.</p>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="space-y-4 max-w-xl">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="name" class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-2">Display Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required autofocus
                                    class="w-full h-11 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-4 text-xs text-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition font-medium">
                                @error('name')
                                <p class="text-red-400 text-[11px] mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-2">Email Node</label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                    class="w-full h-11 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-4 text-xs text-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition font-medium font-mono">
                                @error('email')
                                <p class="text-red-400 text-[11px] mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="h-10 px-5 bg-sky-500/10 border border-sky-500/20 text-sky-400 hover:bg-sky-500 hover:text-black font-bold text-xs uppercase rounded-lg transition duration-200 tracking-wider">
                                    Save Profile
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-[#12141c] border border-gray-800 rounded-lg p-6">
                        <div class="mb-6 pb-2 border-b border-gray-800">
                            <h2 class="text-sm font-black uppercase tracking-wider text-white">Update Password</h2>
                            <p class="text-[11px] text-gray-500 mt-0.5">Ensure your account is using a long, random password to stay secure.</p>
                        </div>

                        <form method="post" action="{{ route('password.update') }}" class="space-y-4 max-w-xl">
                            @csrf
                            @method('put')

                            <div>
                                <label for="current_password" class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-2">Current Security Key</label>
                                <input type="password" id="current_password" name="current_password" required
                                    class="w-full h-11 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-4 text-xs text-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition font-medium">
                                @error('current_password', 'updatePassword')
                                <p class="text-red-400 text-[11px] mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-2">New Security Key</label>
                                <input type="password" id="password" name="password" required
                                    class="w-full h-11 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-4 text-xs text-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition font-medium">
                                @error('password', 'updatePassword')
                                <p class="text-red-400 text-[11px] mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-2">Confirm New Key</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    class="w-full h-11 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-4 text-xs text-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition font-medium">
                                @error('password_confirmation', 'updatePassword')
                                <p class="text-red-400 text-[11px] mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="h-10 px-5 bg-sky-500/10 border border-sky-500/20 text-sky-400 hover:bg-sky-500 hover:text-black font-bold text-xs uppercase rounded-lg transition duration-200 tracking-wider">
                                    Update Security
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <footer class="bg-[#0e1017] border-t border-gray-900 pt-6 pb-6 text-gray-600 text-[10px] text-center mt-16">
        <p>&copy; 2026 Tech World. User Control Matrix.</p>
    </footer>

</body>

</html>