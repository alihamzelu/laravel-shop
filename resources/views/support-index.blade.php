<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Matrix | Tech World</title>
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

    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Aside Navigation Sidebar --}}
            <aside class="w-full lg:w-1/4">
                @include('components.dashboard-aside')
            </aside>

            {{-- Main Support Hub --}}
            <div class="w-full lg:w-3/4 space-y-6">
                <div>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight">Support Terminal</h1>
                    <p class="text-xs text-gray-500">Open a direct diagnostic channel with our tech team or track previous transmissions.</p>
                </div>

                @if (session('status') === 'ticket-created')
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl text-xs font-semibold">
                    ✓ Ticket broadcast successful. Diagnostic queue initialized.
                </div>
                @endif

                <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 items-start">

                    {{-- Form: Open Ticket --}}
                    <div class="xl:col-span-5 bg-[#12141c] border border-gray-800 rounded-lg p-5">
                        <h2 class="text-xs font-black uppercase tracking-wider text-white mb-4 pb-2 border-b border-gray-800">Initialize Ticket</h2>

                        <form method="POST" action="{{ route('support.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1.5">Subject</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" required class="w-full h-10 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-3 text-xs text-white focus:outline-none transition">
                                @error('subject') <span class="text-[10px] text-red-400 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1.5">Priority Level</label>
                                <select name="priority" class="w-full h-10 bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg px-2 text-xs text-white focus:outline-none transition">
                                    <option value="low">Low (Routine)</option>
                                    <option value="medium" selected>Medium (Standard)</option>
                                    <option value="high">High (Critical System Failure)</option>
                                </select>
                                @error('priority') <span class="text-[10px] text-red-400 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1.5">Detailed Message</label>
                                <textarea name="message" rows="6" required class="w-full bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg p-3 text-xs text-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition resize-none">{{ old('message') }}</textarea>
                                @error('message') <span class="text-[10px] text-red-400 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="w-full h-10 bg-sky-500 text-black hover:bg-sky-400 font-bold text-xs uppercase rounded-lg transition tracking-wider">
                                Transmit Packet
                            </button>
                        </form>
                    </div>

                    {{-- List: Active Tickets --}}
                    <div class="xl:col-span-7 bg-[#12141c] border border-gray-800 rounded-lg p-5">
                        <h2 class="text-xs font-black uppercase tracking-wider text-white mb-4 pb-2 border-b border-gray-800">Active Transmission Logs</h2>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="text-gray-500 uppercase font-bold tracking-wider border-b border-gray-800">
                                        <th class="pb-3">ID</th>
                                        <th class="pb-3">Subject</th>
                                        <th class="pb-3">Priority</th>
                                        <th class="pb-3">Status</th>
                                        <th class="pb-3 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-300 divide-y divide-gray-800/40">
                                    @forelse ($tickets as $ticket)
                                    <tr class="hover:bg-[#161922]/20 transition">
                                        <td class="py-3.5 font-mono font-bold text-white">#{{ $ticket->id }}</td>
                                        <td class="py-3.5 font-medium truncate max-w-[140px]">{{ $ticket->subject }}</td>
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
                                            @if($ticket->status === 'open')
                                            <span class="bg-sky-500/10 text-sky-400 font-bold px-2 py-0.5 rounded border border-sky-500/20 text-[9px] uppercase">Open</span>
                                            @elseif($ticket->status === 'pending')
                                            <span class="bg-amber-500/10 text-amber-400 font-bold px-2 py-0.5 rounded border border-amber-500/20 text-[9px] uppercase">Pending</span>
                                            @elseif($ticket->status === 'answered')
                                            <span class="bg-emerald-500/10 text-emerald-400 font-bold px-2 py-0.5 rounded border border-emerald-500/20 text-[9px] uppercase">Answered</span>
                                            @else
                                            <span class="bg-gray-800 text-gray-500 font-bold px-2 py-0.5 rounded border border-gray-700 text-[9px] uppercase">Closed</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 text-right">
                                            <a href="{{ route('support.show', $ticket->id) }}" class="text-sky-400 hover:underline font-semibold text-[11px]">Interact</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center text-gray-500">No active matrix transmissions found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $tickets->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    @include('components.footer')
</body>

</html>