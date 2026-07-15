<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Tickets | Tech World</title>
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
                        <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-gray-400 hover:bg-[#161922]/50 hover:text-white transition">
                            <span>📦</span> <span>My Orders</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-gray-400 hover:bg-[#161922]/50 hover:text-white transition">
                            <span>❤️</span> <span>Wishlist</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-gray-400 hover:bg-[#161922]/50 hover:text-white transition">
                            <span>👤</span> <span>Account Settings</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded-md bg-[#161922] text-white font-semibold transition">
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

                <div>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight">Comms Link / Support</h1>
                    <p class="text-xs text-gray-500">Open a direct diagnostic terminal with our technicians or monitor your pending ticket reports.</p>
                </div>

                @if (session('status') === 'ticket-created')
                    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl text-xs font-semibold flex items-center space-x-2">
                        <span>✓</span> <span>Ticket transmission successful. A technician will intercept your request shortly.</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 items-start">
                    
                    <div class="xl:col-span-5 bg-[#12141c] border border-gray-800 rounded-lg p-5">
                        <h2 class="text-xs font-black uppercase tracking-wider text-white mb-4 pb-2 border-b border-gray-800">Initialize New Ticket</h2>
                        
                        <form method="POST" action="#" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1.5">Subject</label>
                                <input type="text" name="subject" required class="w-full h-10 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-3 text-xs text-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1.5">Node Group</label>
                                    <select name="department" class="w-full h-10 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-2 text-xs text-white focus:outline-none transition">
                                        <option value="technical">Technical Dept</option>
                                        <option value="billing">Billing / Finance</option>
                                        <option value="hardware">Hardware Warranty</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1.5">Priority Level</label>
                                    <select name="priority" class="w-full h-10 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-2 text-xs text-white focus:outline-none transition">
                                        <option value="low">Low (Routine)</option>
                                        <option value="medium" selected>Medium (Standard)</option>
                                        <option value="high">High (Critical)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1.5">Diagnostic Message</label>
                                <textarea name="message" rows="5" required class="w-full bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg p-3 text-xs text-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition resize-none"></textarea>
                            </div>

                            <button type="submit" class="w-full h-10 bg-sky-500/10 border border-sky-500/20 text-sky-400 hover:bg-sky-500 hover:text-black font-bold text-xs uppercase rounded-lg transition duration-200 tracking-wider">
                                Transmit Ticket
                            </button>
                        </form>
                    </div>

                    <div class="xl:col-span-7 bg-[#12141c] border border-gray-800 rounded-lg p-5">
                        <h2 class="text-xs font-black uppercase tracking-wider text-white mb-4 pb-2 border-b border-gray-800">Active Transmission Logs</h2>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="text-gray-500 uppercase font-bold tracking-wider border-b border-gray-800">
                                        <th class="pb-3">Ticket ID</th>
                                        <th class="pb-3">Subject</th>
                                        <th class="pb-3">Priority</th>
                                        <th class="pb-3">Status</th>
                                        <th class="pb-3 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-300 divide-y divide-gray-800/40">
                                    @forelse ($tickets as $ticket)
                                        <tr class="hover:bg-[#161922]/20 transition duration-150">
                                            <td class="py-3.5 font-mono font-bold text-white">#{{ $ticket->id }}</td>
                                            <td class="py-3.5 font-medium truncate max-w-[150px]">{{ $ticket->subject }}</td>
                                            <td class="py-3.5 font-mono uppercase text-[10px]">
                                                @if($ticket->priority === 'high')
                                                    <span class="text-rose-400 font-bold">!! High</span>
                                                @elseif($ticket->priority === 'medium')
                                                    <span class="text-amber-400 font-bold">! Mid</span>
                                                @else
                                                    <span class="text-gray-500">Low</span>
                                                @endif
                                            </td>
                                            <td class="py-3.5">
                                                @if($ticket->status === 'open' || $ticket->status === 'active')
                                                    <span class="bg-sky-500/10 text-sky-400 font-bold px-2 py-0.5 rounded border border-sky-500/20 uppercase tracking-wide text-[9px]">
                                                        Open
                                                    </span>
                                                @elseif($ticket->status === 'replied' || $ticket->status === 'answered')
                                                    <span class="bg-emerald-500/10 text-emerald-400 font-bold px-2 py-0.5 rounded border border-emerald-500/20 uppercase tracking-wide text-[9px]">
                                                        Replied
                                                    </span>
                                                @else
                                                    <span class="bg-gray-800 text-gray-500 font-bold px-2 py-0.5 rounded border border-gray-700 uppercase tracking-wide text-[9px]">
                                                        Closed
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3.5 text-right">
                                                <a href="#" class="text-sky-400 hover:underline font-semibold text-[11px]">View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-12 text-center text-gray-500">
                                                No communications found in matrix database.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($tickets->hasPages())
                            <div class="mt-4 pt-3 border-t border-gray-800/40">
                                {{ $tickets->links() }}
                            </div>
                        @endif
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