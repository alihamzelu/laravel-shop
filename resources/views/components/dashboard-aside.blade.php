<div class="bg-[#12141c] border border-gray-800 rounded-xl p-5 space-y-6">

    <div class="flex items-center space-x-3 pb-4 border-b border-gray-800">
        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-sky-500 to-indigo-600 flex items-center justify-center font-black text-white text-base shadow-lg shadow-sky-500/20">
            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
        </div>

        <div>
            <h3 class="font-bold text-white text-sm">
                {{ auth()->user()->name }}
            </h3>

            <span class="text-[10px] bg-sky-500/10 text-sky-400 font-extrabold uppercase px-2 py-0.5 rounded tracking-wide border border-sky-500/15">
                Member
            </span>
        </div>
    </div>


    <nav class="space-y-1 text-sm">


        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="flex items-center space-x-3 px-4 py-2.5 rounded-md transition
            {{ request()->routeIs('dashboard') 
                ? 'bg-[#161922] text-white font-semibold' 
                : 'text-gray-400 hover:bg-[#161922]/50 hover:text-white' }}">
            
            <span>📊</span>
            <span>Dashboard Overview</span>
        </a>



        {{-- Orders --}}
        <a href="{{ route('orders') }}"
            class="flex items-center space-x-3 px-4 py-2.5 rounded-md transition
            {{ request()->routeIs('orders') || request()->routeIs('orders.*')
                ? 'bg-[#161922] text-white font-semibold' 
                : 'text-gray-400 hover:bg-[#161922]/50 hover:text-white' }}">
            
            <span>📦</span>
            <span>My Orders</span>
        </a>



        {{-- Wishlist --}}
        <a href="{{ route('wishlist.index') }}"
            class="flex items-center space-x-3 px-4 py-2.5 rounded-md transition
            {{ request()->routeIs('wishlist.*')
                ? 'bg-[#161922] text-white font-semibold' 
                : 'text-gray-400 hover:bg-[#161922]/50 hover:text-white' }}">
            
            <span>❤️</span>
            <span>Wishlist</span>
        </a>



        {{-- Profile --}}
        <a href="{{ route('profile.edit') }}"
            class="flex items-center space-x-3 px-4 py-2.5 rounded-md transition
            {{ request()->routeIs('profile.*')
                ? 'bg-[#161922] text-white font-semibold' 
                : 'text-gray-400 hover:bg-[#161922]/50 hover:text-white' }}">
            
            <span>👤</span>
            <span>Account Settings</span>
        </a>



        {{-- Support --}}
        <a href="{{ route('support.index') }}"
            class="flex items-center space-x-3 px-4 py-2.5 rounded-md transition
            {{ request()->routeIs('support.*')
                ? 'bg-[#161922] text-white font-semibold' 
                : 'text-gray-400 hover:bg-[#161922]/50 hover:text-white' }}">
            
            <span>🎫</span>
            <span>Support Tickets</span>
        </a>



        {{-- Logout --}}
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-red-400 hover:bg-red-500/10 transition pt-4 border-t border-gray-800/60 mt-4">
            
            <span>🚪</span>
            <span>Log Out</span>
        </a>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>


    </nav>

</div>