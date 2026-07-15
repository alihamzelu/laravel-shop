<footer class="bg-[#0e1017] border-t border-gray-900 pt-16 pb-8 text-gray-400 text-sm">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">

            <div>
                <h4 class="text-white font-bold uppercase tracking-wider mb-4 text-xs">
                    Navigation
                </h4>

                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white transition">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('products') }}" class="hover:text-white transition">
                            Products
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('cart.index') }}" class="hover:text-white transition">
                            Cart
                        </a>
                    </li>

                    <li>
                        <a href="" class="hover:text-white transition">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>


            <div>
                <h4 class="text-white font-bold uppercase tracking-wider mb-4 text-xs">
                    Categories
                </h4>

                <ul class="space-y-2">

                    @foreach($footerCategories as $category)
                        <li>
                            <a href="{{ route('products', ['category[]' => $category->id]) }}"
                               class="hover:text-white transition">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>


            <div>
                <h4 class="text-white font-bold uppercase tracking-wider mb-4 text-xs">
                    Popular Brands
                </h4>

                <ul class="space-y-2">

                    @foreach($footerBrands as $brand)
                        <li>
                            <a href="{{ route('products', ['brand[]' => $brand->id]) }}"
                               class="hover:text-white transition">
                                {{ $brand->name }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>


            <div>
                <div class="text-xl font-black text-sky-500 tracking-wider mb-4">
                    TECH <span class="text-white">WORLD</span>
                </div>

                <p class="text-xs leading-relaxed text-gray-500">
                    Your destination for premium PC components,
                    gaming hardware and next-generation technology.
                </p>

                <div class="mt-5 text-xs text-gray-500 space-y-1">
                    <p>Email: alihamzelu3@gmail.com </p>
                    <p>Gaming • Hardware • Innovation</p>
                </div>
            </div>

        </div>


        <div class="flex flex-col md:flex-row justify-between items-center text-xs text-gray-600 border-t border-gray-900 pt-8">

            <p>
                © {{ date('Y') }} Tech World. All rights reserved.
            </p>

            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-gray-400 transition">
                    Instagram
                </a>

                <a href="#" class="hover:text-gray-400 transition">
                    Discord
                </a>

                <a href="#" class="hover:text-gray-400 transition">
                    YouTube
                </a>
            </div>

        </div>

    </div>
</footer>