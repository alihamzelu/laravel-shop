<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#0b0c10] text-gray-200 antialiased">

    @include('components.header')

    <main class="container mx-auto px-4 py-12 max-w-2xl">

        <div class="bg-[#12141c] border border-gray-800 rounded-lg p-8 text-center space-y-6">
            <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500 mx-auto flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <h1 class="text-3xl font-black text-white uppercase">Payment Failed</h1>

            @if(session('error'))
            <p class="text-red-400 bg-red-500/10 border border-red-500 rounded-lg p-3">{{ session('error') }}</p>
            @else
            <p class="text-gray-400">Unfortunately, your payment could not be processed. Please try again.</p>
            @endif

            <div class="bg-[#0b0c10] border border-red-500/30 rounded-lg p-6">
                <p class="text-sm text-gray-400">
                    If the problem persists, please contact our support team or try a different payment method.
                </p>
            </div>
        </div>

        <div class="flex gap-4 mt-8">
            <a href="{{ route('cart.index') }}" class="flex-1 bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg text-center transition">
                Back to Cart
            </a>
            <a href="{{ route('home') }}" class="flex-1 bg-sky-500 hover:bg-sky-600 text-black font-extrabold py-3 px-4 rounded-lg text-center transition uppercase tracking-wider">
                Home
            </a>
        </div>

    </main>

    @include('components.footer')

</body>

</html>