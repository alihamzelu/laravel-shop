<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Tech World</title>
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

            {{-- Sidebar Aside --}}
            <aside class="w-full lg:w-1/4">
                @include('components.dashboard-aside')
            </aside>

            {{-- Main Content Area --}}
            <div class="w-full lg:w-3/4 space-y-6">

                <div>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight">Welcome Back, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
                    <p class="text-xs text-gray-500">Monitor your orders, hardware warranties, and profile status here.</p>
                </div>

                {{-- Stats Cards (اصلاح شده - فقط آمار سفارشات) --}}
                <div class="w-full">
                    <div class="bg-[#12141c] border border-gray-800 p-5 rounded-lg max-w-sm">
                        <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Orders Placed</span>
                        <div class="text-3xl font-black text-white mt-2">{{ $orders->count() }}</div>
                    </div>
                </div>

                {{-- Recent Orders Table --}}
                <div class="bg-[#12141c] border border-gray-800 rounded-lg p-5">
                    <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-800">
                        <h2 class="text-sm font-black uppercase tracking-wider text-white">Recent Orders</h2>
                        <a href="#" class="text-xs text-sky-400 hover:underline font-semibold">View All</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="text-gray-500 uppercase font-bold tracking-wider border-b border-gray-800">
                                    <th class="pb-3">Order ID</th>
                                    <th class="pb-3">Date</th>
                                    <th class="pb-3">Total Amount</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-300 divide-y divide-gray-800/50">
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="py-4 font-mono font-bold text-white">#{{ $order->id }}</td>
                                        <td class="py-4">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="py-4 font-mono">${{ number_format($order->total_price, 2) }}</td>
                                        <td class="py-4">
                                            @if($order->status === 'success' || $order->status === 'paid' || $order->status === 'completed')
                                                <span class="bg-green-500/10 text-green-400 font-bold px-2 py-0.5 rounded border border-green-500/20 uppercase tracking-wide text-[10px]">
                                                    {{ $order->status }}
                                                </span>
                                            @elseif($order->status === 'pending')
                                                <span class="bg-yellow-500/10 text-yellow-400 font-bold px-2 py-0.5 rounded border border-yellow-500/20 uppercase tracking-wide text-[10px]">
                                                    {{ $order->status }}
                                                </span>
                                            @else
                                                <span class="bg-red-500/10 text-red-400 font-bold px-2 py-0.5 rounded border border-red-500/20 uppercase tracking-wide text-[10px]">
                                                    {{ $order->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 text-right">
                                            @if($order->status === 'pending')
                                                <a href="{{ route('payment.index', $order) }}" class="text-sky-400 hover:underline font-semibold">Pay Now</a>
                                            @else
                                                <button class="text-gray-500 hover:text-white transition font-semibold">Track</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-500">
                                            You haven't placed any orders yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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