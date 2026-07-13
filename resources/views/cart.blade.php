<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0c10] text-gray-200 antialiased">

    @include('components.header')

    <main class="container mx-auto px-4 py-8">
        
        <h1 class="text-3xl font-black uppercase tracking-tight text-white mb-8 border-b border-gray-800 pb-4">Shopping Cart</h1>

        {{-- ✅ Messages --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-500/20 border border-green-500 text-green-400 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-500/20 border border-red-500 text-red-400 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-2/3 space-y-4">
                
                {{-- ✅ Check if cart exists and has items --}}
                @if($cart && $cart->items->count() > 0)
                    
                    {{-- ✅ Loop through cart items --}}
                    @forelse($cart->items as $item)
                        <div class="bg-[#12141c] border border-gray-800 rounded-lg p-4 flex flex-col sm:flex-row items-center justify-between gap-4 hover:border-gray-700 transition">
                            
                            <div class="flex items-center space-x-4 w-full sm:w-auto">
                                {{-- Product Image --}}
                                <div class="bg-[#0b0c10] rounded p-2 flex items-center justify-center w-20 h-20 flex-shrink-0">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="max-w-full max-h-full object-contain">
                                    @else
                                        <span class="text-[10px] text-gray-600">[No Image]</span>
                                    @endif
                                </div>

                                {{-- Product Info --}}
                                <div>
                                    @if($item->product->brand)
                                        <span class="text-[10px] uppercase font-bold text-sky-400 tracking-wider">{{ $item->product->brand->name }}</span>
                                    @endif
                                    <h3 class="font-bold text-white text-sm md:text-base line-clamp-1 hover:text-sky-400 transition cursor-pointer">
                                        <a href="{{ route('products.show', $item->product) }}">
                                            {{ $item->product->name }}
                                        </a>
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Unit Price: <span class="text-sky-400 font-bold">${{ number_format($item->product->price, 2) }}</span></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-8 border-t sm:border-t-0 border-gray-800 pt-3 sm:pt-0">
                                
                                {{-- ✅ Quantity Input with Form --}}
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="flex items-center border border-gray-800 bg-[#0b0c10] rounded h-9">
                                        <button type="button" onclick="this.nextElementSibling.stepDown(); this.closest('form').submit();" class="px-3 text-gray-500 hover:text-white font-bold text-sm h-full">-</button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-8 text-center bg-transparent text-white font-bold text-sm outline-none h-full [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        <button type="button" onclick="this.previousElementSibling.stepUp(); this.closest('form').submit();" class="px-3 text-gray-500 hover:text-white font-bold text-sm h-full">+</button>
                                    </div>
                                </form>

                                {{-- Price --}}
                                <div class="text-right">
                                    <div class="text-lg font-black text-sky-400">
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        x{{ $item->quantity }}
                                    </div>
                                </div>

                                {{-- ✅ Delete Button with Form --}}
                                <form action="{{ route('cart.remove', $item) }}" method="POST" onsubmit="return confirm('Remove this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-400 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="bg-[#12141c] border border-gray-800 rounded-lg p-8 text-center">
                            <p class="text-gray-400 text-lg mb-4">Your cart is empty</p>
                            <a href="{{ route('products') }}" class="text-sky-400 hover:text-sky-300 font-semibold">← Continue Shopping</a>
                        </div>
                    @endforelse

                @else
                    {{-- ✅ Empty Cart --}}
                    <div class="bg-[#12141c] border border-gray-800 rounded-lg p-8 text-center">
                        <p class="text-gray-400 text-lg mb-4">Your cart is empty</p>
                        <a href="{{ route('products') }}" class="text-sky-400 hover:text-sky-300 font-semibold">← Continue Shopping</a>
                    </div>
                @endif

                <div class="pt-4">
                    <a href="{{ route('products') }}" class="text-sky-400 hover:underline text-sm font-semibold flex items-center gap-2">
                        &larr; Continue Shopping
                    </a>
                </div>
            </div>

            {{-- ✅ Order Summary (Dynamic) --}}
            <div class="w-full lg:w-1/4 flex-shrink-0">
                <div class="bg-[#12141c] border border-gray-800 rounded-lg p-5 sticky top-24 space-y-6">
                    <h2 class="text-lg font-bold text-white uppercase tracking-wider border-b border-gray-800 pb-2">Order Summary</h2>
                    
                    @php
                        $subtotal = $cart ? $cart->items->sum(fn($item) => $item->product->price * $item->quantity) : 0;
                        $itemCount = $cart ? $cart->items->count() : 0;
                        $shipping = 0; // Free shipping
                        $tax = 0; // No tax for now
                        $total = $subtotal + $shipping + $tax;
                    @endphp
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-gray-400">
                            <span>Subtotal ({{ $itemCount }} {{ $itemCount === 1 ? 'item' : 'items' }})</span>
                            <span class="text-white font-mono">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Shipping</span>
                            <span class="text-green-400 uppercase font-bold text-xs">{{ $shipping === 0 ? 'Free' : '$' . number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Estimated Tax</span>
                            <span class="text-white font-mono">${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-800 my-4 pt-4 flex justify-between text-base font-bold">
                            <span class="text-white">Total Amount</span>
                            <span class="text-xl font-black text-sky-400 font-mono">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="pt-2">
                        <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Have a promo code?</label>
                        <div class="flex">
                            <input type="text" placeholder="e.g. GEAR15" class="bg-[#0b0c10] text-white text-sm px-3 py-2 rounded-l border border-gray-800 focus:outline-none focus:border-sky-500 w-full font-mono">
                            <button class="bg-gray-800 hover:bg-gray-700 text-white font-bold px-4 rounded-r text-xs tracking-wider transition">Apply</button>
                        </div>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="m-1">
                    <button {{ $cart && $cart->items->count() > 0 ? '' : 'disabled' }} class="w-full bg-sky-500 hover:bg-sky-600 disabled:bg-gray-700 disabled:cursor-not-allowed text-black font-extrabold uppercase tracking-wider py-3.5 px-4 rounded-md shadow-lg shadow-sky-500/10 transition duration-300 flex justify-center items-center gap-2 text-sm">
                        Proceed to Checkout
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </button>
                    </a>
                </div>
            </div>

        </div>
    </main>

    @include('components.footer')

</body>
</html>