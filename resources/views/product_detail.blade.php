<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Tech World</title>

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






                    <p class="text-gray-400 leading-relaxed mb-8 break-words whitespace-normal overflow-hidden">
                        {!! $product->description !!}
                    </p>



                </div>


                <div class="border-t border-gray-800 pt-6">
                    <div class="flex flex-col sm:flex-row gap-4 items-stretch">

                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1 flex flex-col sm:flex-row gap-4">
                            @csrf

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
        <section class="mb-16 border-t border-gray-800 pt-12">
            <h2 class="text-xl font-black uppercase tracking-wider text-white mb-8 flex items-center gap-3">
                <span>Customer Reviews</span>
                <span class="text-xs bg-sky-500/10 text-sky-400 px-2.5 py-1 rounded-full">
                    {{ $product->reviews->count() }} {{ Str::plural('Review', $product->reviews->count()) }}
                </span>
            </h2>

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg text-sm">
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-lg text-sm">
                {{ session('error') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-2 space-y-6">
                    @forelse($product->reviews as $review)
                    <div class="bg-[#12141c] border border-gray-800 rounded-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-sky-500/10 flex items-center justify-center text-sky-400 font-bold border border-sky-500/20">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white">{{ $review->user->name }}</h4>
                                    <p class="text-xs text-gray-500">
                                        {{ $review->created_at ? $review->created_at->diffForHumans() : 'Recently' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-1 text-amber-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="{{ $i <= $review->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    @endfor
                            </div>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed">{{ $review->comment }}</p>
                    </div>
                    @empty
                    <div class="bg-[#12141c]/50 border border-dashed border-gray-800 rounded-xl p-12 text-center text-gray-500">
                        No reviews yet. Be the first to review this product!
                    </div>
                    @endforelse
                </div>

                <div>
                    @auth
                    <div class="bg-[#12141c] border border-gray-800 rounded-xl p-6 sticky top-6">
                        <h3 class="text-lg font-bold text-white mb-4">Write a Review</h3>

                        <form action="{{ route('products.reviews.store', $product) }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-xs text-gray-500 uppercase mb-2">Your Rating</label>
                                <div class="flex items-center gap-2" id="star-rating-container">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button" data-rating="{{ $i }}" class="star-btn text-gray-600 hover:text-amber-400 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        </button>
                                        @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating-input" value="" required>
                                @error('rating')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="comment" class="block text-xs text-gray-500 uppercase mb-2">Your Comment</label>
                                <textarea name="comment" id="comment" rows="4"
                                    class="w-full bg-[#0b0c10] border border-gray-700 rounded-md p-3 text-white text-sm focus:outline-none focus:border-sky-500 transition placeholder-gray-600"
                                    placeholder="Share your thoughts about this product..." required>{{ old('comment') }}</textarea>
                                @error('comment')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-black font-extrabold uppercase tracking-wider py-3.5 rounded-md transition text-sm">
                                Submit Review
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="bg-[#12141c] border border-gray-800 rounded-xl p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <p class="text-gray-400 text-sm mb-4">You need to be logged in to write a review.</p>
                        <a href="{{ route('login') }}" class="inline-block bg-gray-800 hover:bg-gray-700 text-white font-bold px-6 py-2.5 rounded-md transition text-sm">
                            Login Now
                        </a>
                    </div>
                    @endauth
                </div>

            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const stars = document.querySelectorAll('.star-btn');
                const ratingInput = document.getElementById('rating-input');

                stars.forEach(star => {
                    star.addEventListener('click', function() {
                        const rating = this.getAttribute('data-rating');
                        ratingInput.value = rating;

                        stars.forEach(s => {
                            const sRating = s.getAttribute('data-rating');
                            if (sRating <= rating) {
                                s.classList.remove('text-gray-600');
                                s.classList.add('text-amber-400');
                                s.querySelector('svg').setAttribute('fill', 'currentColor');
                            } else {
                                s.classList.remove('text-amber-400');
                                s.classList.add('text-gray-600');
                                s.querySelector('svg').setAttribute('fill', 'none');
                            }
                        });
                    });
                });
            });
        </script>
    </main>
    @include('components.footer')
</body>

</html>