<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | Tech World</title>
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
    <div class="container mx-auto max-w-2xl mt-4 px-4">
        {{-- نمایش خطاهای متنی کنترلر --}}
        @if (session('error'))
        <div class="bg-red-500/20 border border-red-500 text-red-400 p-4 rounded mb-4 text-center">
            {{ session('error') }}
        </div>
        @endif

        {{-- نمایش خطاهای ولیدیشن یا موارد دیگر --}}
        @if ($errors->any())
        <div class="bg-red-500/20 border border-red-500 text-red-400 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <main class="container mx-auto px-4 py-8 max-w-2xl">

        <h1 class="text-3xl font-black uppercase tracking-tight text-white mb-8">Secure Payment</h1>

        <div class="bg-[#12141c] border border-gray-800 rounded-lg p-8 space-y-8">

            {{-- Order Details --}}
            <div class="bg-[#0b0c10] border border-gray-800 rounded-lg p-6">
                <h2 class="text-lg font-bold text-white mb-4 uppercase tracking-wider">Order Details</h2>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Order ID:</span>
                        <span class="text-white font-mono">#{{ $order->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Items:</span>
                        <span class="text-white">{{ $order->items->count() }} item(s)</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-gray-800">
                        <span class="text-gray-400">Total Amount:</span>
                        <span class="text-sky-400 font-bold text-lg">${{ number_format($order->total_price, 2) }}</span>
                    </div>
                </div>
            </div>

            {{-- Items List --}}
            <div>
                <h2 class="text-lg font-bold text-white mb-4 uppercase tracking-wider">Order Items</h2>

                <div class="space-y-2 max-h-48 overflow-y-auto">
                    @forelse($order->items as $item)
                    <div class="bg-[#0b0c10] border border-gray-800 rounded-lg p-4 flex justify-between items-center">
                        <div>
                            <p class="text-white font-semibold">{{ $item->product->name }}</p>
                            <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                        </div>
                        <span class="text-sky-400 font-bold">${{ number_format($item->price * $item->quantity, 2) }}</span>
                    </div>
                    @empty
                    <p class="text-gray-500">No items</p>
                    @endforelse
                </div>
            </div>

            {{-- Payment Method --}}
            <div class="bg-[#0b0c10] border border-gray-800 rounded-lg p-6">
                <h2 class="text-lg font-bold text-white mb-4 uppercase tracking-wider">Payment Method</h2>

                <div class="space-y-3">
                    <div class="flex items-center p-4 bg-[#12141c] border border-sky-500/30 rounded-lg">
                        <div class="w-12 h-12 rounded-full bg-sky-500/10 flex items-center justify-center mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-semibold">{{ ucfirst($payment->method) }}</p>
                            <p class="text-xs text-gray-500">Secure Online Payment Gateway</p>
                        </div>
                        <span class="text-green-400 font-bold text-sm">SELECTED</span>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-4">
                <a href="{{ route('cart.index') }}" class="flex-1 bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg text-center transition">
                    ← Cancel
                </a>
                <form action="{{ route('payment.zarinpal', $order) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-black font-extrabold py-3 px-4 rounded-lg transition uppercase tracking-wider flex items-center justify-center gap-2">
                        🔒 Pay Now ({{ $payment->method }})
                    </button>
                </form>
            </div>

            {{-- Security Note --}}
            <p class="text-xs text-center text-gray-500 border-t border-gray-800 pt-6">
                🔐 Your payment information is encrypted and secure. We use industry-standard SSL encryption.
            </p>
        </div>

    </main>

    @include('components.footer')

</body>

</html>