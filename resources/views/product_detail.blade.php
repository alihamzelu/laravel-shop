<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Tech World</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>


<body class="bg-[#0b0c10] text-gray-200 antialiased">


    @include('components.header')


    <main class="container mx-auto px-4 py-8">


        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-500 mb-8 flex items-center space-x-2">

            <a href="{{ route('home') }}" class="hover:text-sky-400 transition">
                Home
            </a>

            <span>/</span>

            <span class="text-gray-300">
                {{ $product->category->name }}
            </span>

            <span>/</span>

            <span class="text-gray-300">
                {{ $product->name }}
            </span>

        </nav>




        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">


            <!-- Product Image -->

            <div>

                <div
                    class="bg-[#12141c] border border-gray-800 rounded-xl p-8 flex items-center justify-center h-[400px] md:h-[500px]">


                    @if($product->image)

                    <img src="{{ asset('storage/'.$product->image) }}"
                        alt="{{ $product->name }}"
                        class="max-h-full object-contain">

                    @else

                    <span class="text-gray-600">
                        No Image
                    </span>

                    @endif


                </div>

            </div>





            <!-- Product Info -->

            <div class="flex flex-col justify-between">


                <div>


                    <div class="flex items-center gap-3 mb-4">


                        @if($product->brand)

                        <span
                            class="text-xs font-bold text-sky-400 uppercase tracking-widest bg-sky-500/10 px-2.5 py-1 rounded">

                            {{ $product->brand->name }}

                        </span>

                        @endif



                        <span class="text-xs font-semibold flex items-center gap-1
                    {{ $product->stock > 0 ? 'text-green-400':'text-red-400' }}">


                            <span class="w-2 h-2 rounded-full
                        {{ $product->stock > 0 ? 'bg-green-500':'bg-red-500' }}">
                            </span>


                            {{ $product->stock > 0 ? 'In Stock':'Out of Stock' }}


                        </span>



                    </div>





                    <h1 class="text-3xl md:text-4xl font-black text-white mb-5">

                        {{ $product->name }}

                    </h1>





                    <!-- Price -->

                    <div class="mb-6">


                        <div class="text-xs text-gray-500 uppercase mb-2">
                            Price
                        </div>



                        <div class="flex items-center gap-3">

                            {{-- ✅ استفاده از accessor --}}
                            <span class="text-4xl font-black text-sky-400">
                                ${{ number_format($product->final_price, 2) }}
                            </span>

                            {{-- ✅ اگه deal فعال است --}}
                            @if($product->hasActiveDeal())
                            <span class="text-gray-500 line-through">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            <span class="text-xs bg-red-500/10 text-red-400 px-2 py-1 rounded font-bold">
                                -{{ $product->discount_percent }}%
                            </span>
                            @endif

                        </div>


                    </div>





                    <!-- Description -->

                    <p class="text-gray-400 leading-relaxed mb-8 break-words whitespace-normal overflow-hidden">
                        {!! $product->description !!}
                    </p>



                </div>

                <!-- Actions Area (Add To Cart & Wishlist Toggle) -->

                <div class="border-t border-gray-800 pt-6">
                    <div class="flex flex-col sm:flex-row gap-4 items-stretch">

                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1 flex flex-col sm:flex-row gap-4">
                            @csrf

                            <!-- Quantity -->
                            <div class="flex items-center justify-between sm:justify-start border border-gray-700 bg-[#12141c] rounded-md h-14 flex-shrink-0">
                                <button type="button"
                                    onclick="this.nextElementSibling.stepDown()"
                                    class="px-4 text-gray-400 hover:text-white font-bold text-lg">
                                    -
                                </button>

                                <input type="number"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    max="{{ $product->stock }}"
                                    class="w-14 text-center bg-transparent text-white font-bold outline-none">

                                <button type="button"
                                    onclick="this.previousElementSibling.stepUp()"
                                    class="px-4 text-gray-400 hover:text-white font-bold text-lg">
                                    +
                                </button>
                            </div>

                            <!-- Cart Button -->
                            <button type="submit"
                                class="flex-1 bg-sky-500 hover:bg-sky-600 text-black font-extrabold uppercase tracking-wider h-14 rounded-md transition flex items-center justify-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Add To Cart
                            </button>
                        </form>

                        <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            @php
                            $isWishlisted = auth()->check() &&
                            auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists();
                            @endphp

                            <button type="submit"
                                class="h-14 w-full sm:w-14 bg-[#12141c] border rounded-md flex items-center justify-center transition duration-200 group focus:outline-none
                            {{ $isWishlisted 
                                ? 'text-red-500 border-red-500/30 bg-red-500/10' 
                                : 'text-gray-400 border-gray-700 hover:text-red-400 hover:border-red-500/20 hover:bg-red-500/5' }}">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transition-transform duration-200 group-hover:scale-110"
                                    viewBox="0 0 24 24"
                                    fill="{{ $isWishlisted ? 'currentColor' : 'none' }}"
                                    stroke="{{ $isWishlisted ? 'none' : 'currentColor' }}"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </form>

                    </div>
                </div>



            </div>


        </div>





        <!-- Basic Product Information -->

        <section class="mb-16">


            <h2
                class="text-xl font-black uppercase tracking-wider text-white mb-6 border-b border-gray-800 pb-2">

                Product Information

            </h2>




            <div
                class="bg-[#12141c] border border-gray-800 rounded-lg p-6">


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">



                    <div>

                        <span class="text-gray-500">
                            Category:
                        </span>


                        <span class="text-white ml-2">

                            {{ $product->category->name }}

                        </span>


                    </div>




                    @if($product->brand)

                    <div>

                        <span class="text-gray-500">
                            Brand:
                        </span>


                        <span class="text-white ml-2">

                            {{ $product->brand->name }}

                        </span>


                    </div>

                    @endif





                    <div>

                        <span class="text-gray-500">
                            Stock:
                        </span>


                        <span class="text-white ml-2">

                            {{ $product->stock }}

                        </span>


                    </div>





                    <div>

                        <span class="text-gray-500">
                            Status:
                        </span>


                        <span class="ml-2
                    {{ $product->stock > 0 ? 'text-green-400':'text-red-400' }}">

                            {{ $product->stock > 0 ? 'Available':'Unavailable' }}

                        </span>


                    </div>



                </div>


            </div>


        </section>

    </main>
    @include('components.footer')
</body>

</html>