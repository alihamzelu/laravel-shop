<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0c10] text-gray-200 antialiased">

    @include('components.header')

    <main class="container mx-auto px-4 py-12 max-w-2xl">
        
        {{-- Success Message --}}
        <div class="bg-[#12141c] border border-gray-800 rounded-lg p-8 text-center space-y-6 mb-8">
            <div class="w-16 h-16 rounded-full bg-green-500/10 border border-green-500 mx-auto flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-3xl font-black text-white uppercase">Order Confirmed!</h1>
            
            <p class="text-gray-400">Your payment has been processed successfully. Thank you for your purchase!</p>

            <div class="bg-[#0b0c10] border border-gray-800 rounded-lg p-6 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Order ID:</span>
                    <span class="text-white font-mono font-bold">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Order Date:</span>
                    <span class="text-white">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between text-sm border-t border-gray-800 pt-3">
                    <span class="text-gray-400">Total Paid:</span>
                    <span class="text-sky-400 font-bold">${{ number_format($order->total_price, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="bg-[#12141c] border border-gray-800 rounded-lg p-6 mb-8">
            <h2 class="text-lg font-bold text-white mb-4 uppercase tracking-wider">Order Items</h2>
            
            <div class="space-y-3">
                @forelse($order->items as $item)
                    <div class="flex justify-between items-center pb-3 border-b border-gray-800 last:border-0">
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

        {{-- Next Steps --}}
        <div class="bg-[#12141c] border border-gray-800 rounded-lg p-6 mb-8">
            <h2 class="text-lg font-bold text-white mb-4 uppercase tracking-wider">What's Next?</h2>
            
            <div class="space-y-3 text-sm">
                <div class="flex gap-3">
                    <span class="w-6 h-6 rounded-full bg-sky-500/10 text-sky-400 flex items-center justify-center flex-shrink-0 text-xs font-bold">1</span>
                    <p class="text-gray-400">You'll receive a confirmation email shortly</p>
                </div>
                <div class="flex gap-3">
                    <span class="w-6 h-6 rounded-full bg-sky-500/10 text-sky-400 flex items-center justify-center flex-shrink-0 text-xs font-bold">2</span>
                    <p class="text-gray-400">Your order will be prepared and shipped within 2-3 business days</p>
                </div>
                <div class="flex gap-3">
                    <span class="w-6 h-6 rounded-full bg-sky-500/10 text-sky-400 flex items-center justify-center flex-shrink-0 text-xs font-bold">3</span>
                    <p class="text-gray-400">Track your shipment using the tracking number provided in your email</p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex gap-4">
            <a href="{{ route('home') }}" class="flex-1 bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg text-center transition">
                Continue Shopping
            </a>
            <a href="{{ route('cart.index') }}" class="flex-1 bg-sky-500 hover:bg-sky-600 text-black font-extrabold py-3 px-4 rounded-lg text-center transition uppercase tracking-wider">
                View My Orders
            </a>
        </div>

    </main>

    @include('components.footer')

</body>
</html>