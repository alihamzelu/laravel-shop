<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Verify Email | Tech World</title>
    
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
        <div class="bg-[#12141c] border border-gray-800 rounded-xl max-w-md w-full p-6 sm:p-8 shadow-2xl shadow-sky-500/5 text-center">
            
            <div class="w-16 h-16 bg-sky-500/10 text-sky-400 rounded-full flex items-center justify-center mx-auto mb-6 border border-sky-500/20 text-2xl animate-pulse">
                ✉️
            </div>

            <h2 class="text-xl font-black uppercase tracking-tight text-white mb-3">Verify Your Email</h2>

            <div class="mb-6 text-sm text-gray-400 leading-relaxed text-justify sm:text-center">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 font-medium text-xs text-green-400 bg-green-500/10 p-4 rounded border border-green-500/20 leading-relaxed">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-800/60 pt-6">
                
                <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto bg-sky-500 hover:bg-sky-600 text-black font-extrabold uppercase tracking-wider py-2.5 px-5 rounded md text-xs shadow-lg shadow-sky-500/10 transition duration-300">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto text-xs text-gray-500 hover:text-red-400 font-bold uppercase tracking-wider py-2.5 px-4 rounded border border-gray-800 hover:border-red-500/20 bg-[#0b0c10]/50 transition">
                        {{ __('Log Out') }}
                    </button>
                </form>

            </div>

        </div>
    </main>

    <footer class="bg-[#0e1017] border-t border-gray-900 py-4 text-gray-600 text-[10px] text-center z-10">
        <p>&copy; {{ date('Y') }} Tech World. Security Verification Checkpoint.</p>
    </footer>

</body>
</html>