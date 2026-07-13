<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket #{{ $ticket->id }} | Tech World</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#0b0c10] text-gray-200 antialiased">

    @include('components.header')

    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <aside class="w-full lg:w-1/4">
                @include('components.dashboard-aside')
            </aside>

            <div class="w-full lg:w-3/4 space-y-6">
                
                {{-- Top Header Action Bar --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-gray-800">
                    <div>
                        <div class="flex items-center space-x-2 text-xs text-gray-500 mb-1">
                            <a href="{{ route('support.index') }}" class="hover:text-sky-400 transition">Tickets</a>
                            <span>/</span>
                            <span class="text-gray-300 font-mono">#{{ $ticket->id }}</span>
                        </div>
                        <h1 class="text-xl font-black text-white uppercase tracking-tight">{{ $ticket->subject }}</h1>
                    </div>
                    <div class="flex gap-2">
                        {{-- نمایش وضعیت تیکت --}}
                        @if($ticket->status === 'open')
                            <span class="bg-sky-500/10 text-sky-400 font-bold px-3 py-1.5 rounded border border-sky-500/20 text-xs uppercase">Status: Open</span>
                        @elseif($ticket->status === 'pending')
                            <span class="bg-amber-500/10 text-amber-400 font-bold px-3 py-1.5 rounded border border-amber-500/20 text-xs uppercase">Status: Pending</span>
                        @elseif($ticket->status === 'answered')
                            <span class="bg-emerald-500/10 text-emerald-400 font-bold px-3 py-1.5 rounded border border-emerald-500/20 text-xs uppercase">Status: Answered</span>
                        @else
                            <span class="bg-gray-800 text-gray-500 font-bold px-3 py-1.5 rounded border border-gray-700 text-xs uppercase">Status: Closed</span>
                        @endif
                    </div>
                </div>

                {{-- چت‌باکس و لاگ پیام‌ها --}}
                <div class="space-y-4">
                    
                    {{-- پیام اصلی استارت تیکت توسط کاربر --}}
                    <div class="bg-[#12141c] border border-gray-800 rounded-lg p-5">
                        <div class="flex justify-between items-center text-[10px] text-gray-500 mb-3 font-mono">
                            <span class="text-sky-400 font-bold">CLIENT (YOU)</span>
                            <span>{{ $ticket->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <p class="text-sm text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $ticket->message }}</p>
                    </div>

                    {{-- شبیه‌سازی پاسخ پشتیبان (در صورت داشتن جدول پاسخ‌ها لوپ بزنید) --}}
                    {{-- @foreach($ticket->replies as $reply) --}}
                    {{-- اگر این بخش هنوز در دیتابیس پیاده نشده، این صرفاً برای دیدن استایل چت ادمین است --}}
                    <div class="bg-sky-950/10 border border-sky-500/10 rounded-lg p-5 ml-6 sm:ml-12 shadow-md shadow-sky-500/5">
                        <div class="flex justify-between items-center text-[10px] text-gray-500 mb-3 font-mono">
                            <span class="text-emerald-400 font-bold">🛡️ TECH SUPPORT DEPLOYMENT</span>
                            <span>Just Now</span>
                        </div>
                        <p class="text-sm text-gray-300 leading-relaxed">
                            Diagnostics pack received. Systems status operational. Our technician is verifying your network layout. Please hold.
                        </p>
                    </div>
                    {{-- @endforeach --}}

                </div>

                {{-- باکس ارسال پاسخ جدید (فقط در صورتی که بسته نشده باشد) --}}
                @if($ticket->status !== 'closed')
                    <div class="bg-[#12141c] border border-gray-800 rounded-lg p-5 mt-6">
                        <h3 class="text-xs font-black uppercase tracking-wider text-white mb-3">Transmit Response</h3>
                        <form method="POST" action="#" class="space-y-4">
                            @csrf
                            <textarea name="message" rows="4" placeholder="Type data stream response..." required class="w-full bg-[#0b0c10] border border-gray-800 focus:border-sky-500 rounded-lg p-3 text-xs text-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition resize-none"></textarea>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="h-9 px-6 bg-sky-500 text-black hover:bg-sky-400 font-bold text-xs uppercase rounded transition tracking-wider">
                                    Send Reply
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="bg-gray-900/40 border border-gray-800/60 p-4 rounded-lg text-center text-xs text-gray-500">
                        This terminal thread has been terminated (Closed). You cannot deploy further packets.
                    </div>
                @endif

            </div>
        </div>
    </main>

    @include('components.footer')
</body>
</html>