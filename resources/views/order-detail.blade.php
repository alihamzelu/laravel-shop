<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} Details | Tech World</title>
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
                <div class="bg-[#12141c] border border-gray-800 rounded-xl p-5 space-y-6">

                    <div class="flex items-center space-x-3 pb-4 border-b border-gray-800">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-sky-500 to-indigo-600 flex items-center justify-center font-black text-white text-base shadow-lg shadow-sky-500/20">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-white text-sm">{{ auth()->user()->name }}</h3>
                            <span class="text-[10px] bg-sky-500/10 text-sky-400 font-extrabold uppercase px-2 py-0.5 rounded tracking-wide border border-sky-500/15">Member</span>
                        </div>
                    </div>

                    <nav class="space-y-1 text-sm">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-gray-400 hover:bg-[#161922]/50 hover:text-white transition">
                            <span>📊</span> <span>Dashboard Overview</span>
                        </a>
                        <a href="{{ route('orders') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-md bg-[#161922] text-white font-semibold transition">
                            <span>📦</span> <span>My Orders</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-gray-400 hover:bg-[#161922]/50 hover:text-white transition">
                            <span>❤️</span> <span>Wishlist</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-gray-400 hover:bg-[#161922]/50 hover:text-white transition">
                            <span>👤</span> <span>Account Settings</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-gray-400 hover:bg-[#161922]/50 hover:text-white transition">
                            <span>🎫</span> <span>Support Tickets</span>
                        </a>

                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-red-400 hover:bg-red-500/10 transition pt-4 border-t border-gray-800/60 mt-4">
                            <span>🚪</span> <span>Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </nav>

                </div>
            </aside>

            <div class="w-full lg:w-3/4 space-y-6">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center space-x-2 text-xs text-gray-500 mb-1">
                            <a href="{{ route('orders') }}" class="hover:text-sky-400 transition">Orders</a>
                            <span>/</span>
                            <span class="text-gray-400 font-mono">#{{ $order->id }}</span>
                        </div>
                        <h1 class="text-2xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                            <span>Order Manifest</span>
                            <span class="font-mono text-lg text-gray-500 font-normal">#{{ $order->id }}</span>
                        </h1>
                    </div>

                    <div>
                        @if($order->status === 'pending')
                        <a href="{{ route('payment.index', $order) }}" class="inline-flex h-9 px-4 items-center bg-sky-500 text-black hover:bg-sky-400 font-bold text-xs uppercase rounded transition duration-200 tracking-wider">
                            Pay Now
                        </a>
                        @else
                        <button class="inline-flex h-9 px-4 items-center bg-[#12141c] border border-gray-800 text-gray-400 hover:text-white hover:border-gray-700 font-bold text-xs uppercase rounded transition duration-200 tracking-wider">
                            Download Invoice
                        </button>
                        @endif
                    </div>
                </div>

                <div class="bg-[#12141c] border border-gray-800 rounded-lg p-5 grid grid-cols-2 sm:grid-cols-4 gap-6 text-xs">
                    <div>
                        <span class="block text-gray-500 uppercase font-bold tracking-wider text-[10px] mb-1">Timestamp</span>
                        <span class="text-white font-mono">{{ $order->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="block text-gray-500 uppercase font-bold tracking-wider text-[10px] mb-1">Node Status</span>
                        @if($order->status === 'success' || $order->status === 'paid' || $order->status === 'completed')
                        <span class="text-emerald-400 font-bold uppercase tracking-wide text-[10px] bg-emerald-500/10 px-2 py-0.5 border border-emerald-500/20 rounded">● {{ $order->status }}</span>
                        @elseif($order->status === 'processing')
                        <span class="text-blue-400 font-bold uppercase tracking-wide text-[10px] bg-blue-500/10 px-2 py-0.5 border border-blue-500/20 rounded">● {{ $order->status }}</span>
                        @elseif($order->status === 'pending')
                        <span class="text-amber-400 font-bold uppercase tracking-wide text-[10px] bg-amber-500/10 px-2 py-0.5 border border-amber-500/20 rounded">○ {{ $order->status }}</span>
                        @else
                        <span class="text-rose-400 font-bold uppercase tracking-wide text-[10px] bg-rose-500/10 px-2 py-0.5 border border-rose-500/20 rounded">✕ {{ $order->status }}</span>
                        @endif
                    </div>
                    <div>
                        <span class="block text-gray-500 uppercase font-bold tracking-wider text-[10px] mb-1">Items Deployed</span>
                        <span class="text-white font-mono">{{ $order->items->sum('quantity') }} Units</span>
                    </div>
                    <div>
                        <span class="block text-gray-500 uppercase font-bold tracking-wider text-[10px] mb-1">Gross Value</span>
                        <span class="text-sky-400 font-mono font-bold">${{ number_format($order->total_price, 2) }}</span>
                    </div>
                </div>

                <div class="bg-[#12141c] border border-gray-800 rounded-lg p-5">
                    <h2 class="text-sm font-black uppercase tracking-wider text-white mb-4 pb-2 border-b border-gray-800">Manifest Elements</h2>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="text-gray-500 uppercase font-bold tracking-wider border-b border-gray-800">
                                    <th class="pb-3">Hardware Component</th>
                                    <th class="pb-3">Unit Price</th>
                                    <th class="pb-3 text-center">Qty</th>
                                    <th class="pb-3 text-right">Total Price</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-300 divide-y divide-gray-800/40">
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="py-4 flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-[#0b0c10] border border-gray-800 rounded flex items-center justify-center p-1 flex-shrink-0">
                                            @if($item->product->image)
                                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="object-contain h-full w-full">
                                            @else
                                            <span class="text-gray-700 text-[10px]">📦</span>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="block text-[9px] text-sky-400 font-bold uppercase tracking-wide">{{ $item->product->category->name ?? 'Hardware' }}</span>
                                            <a href="{{ route('products.show', $item->product->slug) }}" class="text-white font-medium hover:underline line-clamp-1 max-w-xs sm:max-w-md">{{ $item->product->name }}</a>
                                        </div>
                                    </td>

                                    <td class="py-4 font-mono">${{ number_format($item->price, 2) }}</td>

                                    <td class="py-4 font-mono text-center text-gray-400">{{ $item->quantity }}</td>

                                    <td class="py-4 font-mono text-right text-white font-semibold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-[#12141c] border border-gray-800 rounded-lg p-5 text-xs space-y-4">
                        <h2 class="text-sm font-black uppercase tracking-wider text-white pb-2 border-b border-gray-800">Logistics Destination</h2>

                        <div>
                            <span class="block text-gray-500 font-bold uppercase tracking-wider text-[9px] mb-1">Receiver & Shipping Address</span>
                            @if($order->addresses)
                            <p class="text-white font-semibold mb-1">
                                {{ $order->addresses->first_name }} {{ $order->addresses->last_name }}
                            </p>
                            <p class="text-gray-300 leading-relaxed">
                                {{ $order->addresses->city }}، {{ $order->addresses->street_addresses }}
                            </p>
                            <p class="text-gray-400 mt-1 font-mono">
                                Postal Code: {{ $order->addresses->postal_code }} | Phone: {{ $order->addresses->phone_number }}
                            </p>
                            @else
                            <p class="text-gray-300 leading-relaxed">{{ $order->shipping_addresses ?? 'No address record found.' }}</p>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div>
                                <span class="block text-gray-500 font-bold uppercase tracking-wider text-[9px] mb-1">Carrier Router</span>
                                <span class="text-white font-medium">{{ $order->shipping_method ?? 'Standard Delivery' }}</span>
                            </div>
                            <div>
                                <span class="block text-gray-500 font-bold uppercase tracking-wider text-[9px] mb-1">Tracking Code</span>
                                <span class="text-white font-mono">{{ $order->tracking_code ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#12141c] border border-gray-800 rounded-lg p-5 text-xs space-y-3">
                        <h2 class="text-sm font-black uppercase tracking-wider text-white pb-2 border-b border-gray-800">Financial Ledger</h2>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Elements Subtotal</span>
                            <span class="font-mono text-gray-300">${{ number_format($order->total_price - ($order->shipping_cost ?? 0), 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Logistics Routing Fee</span>
                            <span class="font-mono text-gray-300">${{ number_format($order->shipping_cost ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between pb-2 border-b border-gray-800/50">
                            <span class="text-gray-500">Network Discount</span>
                            <span class="font-mono text-emerald-400">-${{ number_format($order->discount ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between pt-1 items-center">
                            <span class="text-white font-bold uppercase tracking-wider text-[10px]">Total Core Value</span>
                            <span class="font-mono text-base font-black text-sky-500">${{ number_format($order->total_price, 2) }}</span>
                        </div>
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