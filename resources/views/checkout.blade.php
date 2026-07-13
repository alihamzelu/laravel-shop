<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0c10] text-gray-200 antialiased">

    @include('components.header')

    <main class="container mx-auto px-4 py-8 max-w-6xl">
        
        <h1 class="text-3xl font-black uppercase tracking-tight text-white mb-8">Checkout</h1>

        {{-- ✅ Messages --}}
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-500/20 border border-red-500 text-red-400 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side: Forms (2/3 Width) -->
            <div class="lg:col-span-2 space-y-6">
                
                {{-- ✅ Step 1: Shipping Information --}}
                <div class="bg-[#12141c] border border-gray-800 rounded-lg p-6">
                    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-6 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-sky-500/10 text-sky-400 text-xs flex items-center justify-center font-bold border border-sky-500/20">1</span>
                        Shipping Information
                    </h2>
                    
                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            {{-- First Name --}}
                            <div>
                                <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="John"
                                    class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border border-gray-800 focus:outline-none focus:border-sky-500 transition @error('first_name') border-red-500 @enderror"
                                    required>
                                @error('first_name')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Last Name --}}
                            <div>
                                <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Doe"
                                    class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border border-gray-800 focus:outline-none focus:border-sky-500 transition @error('last_name') border-red-500 @enderror"
                                    required>
                                @error('last_name')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="sm:col-span-2">
                                <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="johndoe@example.com"
                                    class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border border-gray-800 focus:outline-none focus:border-sky-500 transition @error('email') border-red-500 @enderror"
                                    required>
                                @error('email')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="sm:col-span-2">
                                <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 123-4567"
                                    class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border border-gray-800 focus:outline-none focus:border-sky-500 transition @error('phone') border-red-500 @enderror"
                                    required>
                                @error('phone')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Address --}}
                            <div class="sm:col-span-2">
                                <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Street Address</label>
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="123 Gaming Ave, Suite 404"
                                    class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border border-gray-800 focus:outline-none focus:border-sky-500 transition @error('address') border-red-500 @enderror"
                                    required>
                                @error('address')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- City --}}
                            <div>
                                <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">City</label>
                                <input type="text" name="city" value="{{ old('city') }}" placeholder="Los Angeles"
                                    class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border border-gray-800 focus:outline-none focus:border-sky-500 transition @error('city') border-red-500 @enderror"
                                    required>
                                @error('city')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Postal Code --}}
                            <div>
                                <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">ZIP / Postal Code</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code') }}" placeholder="90001"
                                    class="w-full bg-[#0b0c10] text-white text-sm px-4 py-3 rounded border border-gray-800 focus:outline-none focus:border-sky-500 transition @error('postal_code') border-red-500 @enderror font-mono"
                                    required>
                                @error('postal_code')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-4 mt-8">
                            <a href="{{ route('cart.index') }}" class="flex-1 bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg text-center transition">
                                ← Back to Cart
                            </a>
                            <button type="submit" class="flex-1 bg-sky-500 hover:bg-sky-600 text-black font-extrabold py-3 px-4 rounded-lg transition uppercase tracking-wider">
                                Continue to Payment
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <!-- Right Side: Order Summary Review (1/3 Width) -->
            <div class="lg:col-span-1">
                <div class="bg-[#12141c] border border-gray-800 rounded-lg p-5 sticky top-24 space-y-6">
                    <h2 class="text-lg font-bold text-white uppercase tracking-wider border-b border-gray-800 pb-2">Review Order</h2>
                    
                    {{-- ✅ Compact Items List (Dynamic) --}}
                    <div class="space-y-3 max-h-48 overflow-y-auto pr-1">
                        @forelse($cart->items ?? [] as $item)
                            <div class="flex items-center justify-between text-xs border-b border-gray-800 pb-3">
                                <div class="flex items-center space-x-3 flex-1">
                                    <div class="bg-[#0b0c10] w-10 h-10 rounded flex items-center justify-center flex-shrink-0 text-[8px] text-gray-600 overflow-hidden">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            [Product]
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-white line-clamp-1">{{ $item->product->name }}</h4>
                                        <span class="text-gray-500">Qty: {{ $item->quantity }}</span>
                                    </div>
                                </div>
                                <span class="font-mono text-gray-300 font-semibold ml-2">
                                    ${{ number_format($item->product->final_price * $item->quantity, 2) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-500">No items</p>
                        @endforelse
                    </div>

                    {{-- ✅ Totals Tally (Dynamic) --}}
                    <div class="space-y-3 text-sm border-t border-gray-800 pt-4">
                        <div class="flex justify-between text-gray-400">
                            <span>Subtotal</span>
                            <span class="text-white font-mono">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Shipping</span>
                            <span class="text-green-400 font-bold text-xs uppercase">{{ $shipping === 0 ? 'Free' : '$' . number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Tax</span>
                            <span class="text-white font-mono">${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-800 my-4 pt-4 flex justify-between text-base font-bold">
                            <span class="text-white">Total Amount</span>
                            <span class="text-xl font-black text-sky-400 font-mono">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    {{-- Final Action Button --}}
                    <button form="checkout-form" class="w-full bg-sky-500 hover:bg-sky-600 text-black font-extrabold uppercase tracking-wider py-4 px-4 rounded-md shadow-lg shadow-sky-500/10 transition duration-300 flex justify-center items-center gap-2 text-sm">
                        🔒 Place Secure Order
                    </button>
                    
                    <p class="text-[10px] text-center text-gray-500 leading-relaxed">
                        By clicking "Place Secure Order", you agree to Tech World's terms of service and privacy policy. Your credentials are encrypted end-to-end.
                    </p>
                </div>
            </div>

        </div>
    </main>

    @include('components.footer')

</body>
</html>