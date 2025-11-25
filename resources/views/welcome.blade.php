<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">
{{--NEED TO POLISH UI--}}
<div class="bg-white text-black">
    @php
        $products = \App\Models\Product::count('product_name');
        $fruits_vegetables = \App\Models\Product::where('category' , 'Fruits')->orWhere('category', 'Vegetables')->count();
        $dairy_eggs = \App\Models\Product::where('category' , 'dairy_eggs')->count();
        $beverage = \App\Models\Product::where('category' , 'Beverage')->count();
        $bakery = \App\Models\Product::where('category' , 'Bakery')->count();
    @endphp
    <header class="bg-white py-5 shadow-md">
        <nav class="flex items-center justify-between mx-auto max-w-7xl px-6">
            <div class="flex items-center gap-3">
                       <span class="rounded-full p-[10px] bg-[#2E7D32]">
                           <x-ui.icon name="ps:leaf" variant="bold" class="size-6 "/>
                       </span>
                <h1 class="text-2xl text-[#2E7D32]">EcoMart</h1>
            </div>
            <div class="space-x-2 flex items-center  ">
                <x-ui.icon name="ps:user" class="size-5 fill-gray-500"/>
                @auth
                    <form action="{{route('logout-account')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <a
                               class="text-base text-gray-500 focus:text-green-700 hover:opacity-80">Logout</a>
                        </button>
                    </form>
                @endauth
                @guest
                    <a href="{{route('login')}}"
                       class="text-base text-gray-500 focus:text-green-700 hover:opacity-80">Login</a>
                @endguest

            </div>
        </nav>
    </header>
    {{--Hero Section--}}
    <section class="bg-gradient-to-br from-[#F5E6C8] to-[#E8F5E9] py-16">
        <div class="grid lg:grid-cols-2 items-center mx-auto max-w-7xl px-6 space-y-10 lg:space-y-0">
            <div class="space-y-5">
                <div class="inline-flex items-center gap-2 bg-white rounded-full px-5 py-2 text-[#2E7D32]">
                    <x-ui.icon name="ps:leaf" variant="bold" class="size-4 fill-green-700 "/>
                    <span class="text-sm">100% Organic & Fresh</span>
                </div>
                <h1 class="text-5xl font-bold w-[90%]">Fresh Groceries Delivered to Your Door</h1>
                <h2 class="text-lg text-gray-600 font-extralight ">Shop organic, locally-sourced groceries with same-day
                    delivery. Fresh,
                    sustainable, and always delicious.</h2>
                <div class="space-x-5">
                    <a href="{{ route('login') }}">
                        <x-ui.button
                            class="bg-green-700 hover:opacity-70 transition-all duration-200 text-white rounded-lg py-5 cursor-pointer">
                            Shop Now
                        </x-ui.button>
                    </a>
                    <x-ui.button
                        class="bg-white hover:opacity-80 transition-all duration-200 text-green-700 rounded-lg py-5 cursor-auto">
                        Learn More
                    </x-ui.button>
                </div>

                <div class=" pt-10  flex gap-16">
                    <div class="inline-flex items-center flex-col space-y-2">
                        <span class="rounded-full p-2 px-2 bg-green-700">
                           <x-ui.icon name="ps:truck" variant="bold" class="size-6 "/>
                       </span>
                        <span class="text-gray-500 text-xs sm:text-base">Free Delivery</span>
                    </div>

                    <div class="inline-flex items-center flex-col space-y-2">
                        <span class="rounded-full p-2 px-2 bg-[#66BB6A]">
                           <x-ui.icon name="ps:shield" variant="bold" class="size-6 "/>
                       </span>
                        <span class="text-gray-500 text-xs sm:text-base">100% Secure</span>
                    </div>

                    <div class="inline-flex items-center flex-col space-y-2">
                        <span class="rounded-full p-2 px-2 bg-[#F9C74F]">
                           <x-ui.icon name="ps:sparkle" variant="bold" class="size-6 "/>
                       </span>
                        <span class="text-gray-500 text-xs sm:text-base">Best Quality</span>
                    </div>
                </div>
            </div>
            <div class="relative aspect-square rounded-3xl shadow-xl">
                <img
                    src="{{asset('landing-page-image_1.jpg')}}"
                    alt="landing-p
                    age-image"
                    class="w-full h-full object-cover rounded-3xl">
                <div class="absolute bottom-[-1.5rem] left-[-1.5rem] inline-flex gap-5 rounded-2xl bg-white p-4 ">
                         <span class="rounded-full p-[10px] bg-[#2E7D32]">
                           <x-ui.icon name="ps:leaf" variant="bold" class="size-6 "/>
                       </span>
                    <span>
                            <h1 class="text-lg">{{$products ?? 0}}+ Products</h1>
                            <h2 class="text-sm text-gray-500">Organic and Fresh</h2>
                        </span>
                </div>
            </div>
        </div>
    </section>
    {{--Shop By Category--}}
    <section id="category" class="py-10 pb-16 bg-gray-100">
        <div class="mx-auto max-w-7xl">
            <span class="flex flex-col text-center justify-center space-y-2 py-14">
                <h1 class="font-bold text-4xl">Shop by Category</h1>
                <p class="text-gray-500 text-sm">Browse our wide selection of fresh, organic products</p>
            </span>

            <div
                class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 px-10 xl:px-0 gap-5  text-center justify-center cursor-pointer">
                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#66bb6a] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:carrot" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Fruits & Vegetables</h2>
                        <p class="text-gray-500">{{$fruits_vegetables ?? 0}} items</p>
                    </span>
                </a>

                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#f9c74f] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:package" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Dairy & Eggs</h2>
                        <p class="text-gray-500">{{$dairy_eggs ?? 0}} items</p>
                    </span>
                </a>

                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#8d6e63] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:cookie" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Bakery</h2>
                        <p class="text-gray-500">{{$bakery ?? 0}} items</p>
                    </span>
                </a>

                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#66bb6a] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:jar-label" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Beverage</h2>
                        <p class="text-gray-500">{{$beverage ?? 0}} items</p>
                    </span>
                </a>


            </div>
        </div>

    </section>
    {{-- Testimonials --}}
    <section class="py-16 bg-gray-50">
        <div class="mx-auto max-w-7xl px-10 xl:px-0">

            <div class="flex flex-col sm:flex-row sm:justify-between space-y-5 sm:space-y-0 items-center mb-14">
            <span>
                <h1 class="font-bold text-4xl">What Our Customers Say</h1>
                <p class="text-gray-500 text-sm">Real feedback from people who love EcoMart</p>
            </span>

            @auth
                    <x-ui.modal.trigger id="testimonial-modal">
                        <x-ui.button class="rounded-full px-6 py-3 bg-green-700 text-white hover:opacity-80">
                            Share Your Feedback
                        </x-ui.button>
                    </x-ui.modal.trigger>
                @endauth
                <x-ui.modal
                    id="testimonial-modal"
                    heading="Share Your Experience"
                    description="We appreciate your honest feedback!"
                >

                    {{-- Hidden fields for authenticated user --}}
{{--                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">--}}
{{--                    <input type="hidden" name="name" value="{{ auth()->user()->name }}">--}}
{{--                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">--}}

                    <form method="POST" action="" class="space-y-6">
                        @csrf

                        {{-- Rating --}}
                        <x-ui.field required>
                            <x-ui.label>Rating</x-ui.label>
                            <select name="rating" class="w-full border rounded-lg p-3">
                                <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                                <option value="4">⭐⭐⭐⭐ - Very Good</option>
                                <option value="3">⭐⭐⭐ - Good</option>
                                <option value="2">⭐⭐ - Fair</option>
                                <option value="1">⭐ - Poor</option>
                            </select>
                        </x-ui.field>

                        {{-- Message --}}
                        <x-ui.field required>
                            <x-ui.label>Your Feedback</x-ui.label>
                            <x-ui.textarea
                                name="message"
                                placeholder="Tell us about your experience..."
                                class="h-32"
                            />
                        </x-ui.field>

                        {{-- Submit Button --}}
                        <div class="flex justify-end">
                            <x-ui.button
                                type="submit"
                                class="bg-green-700 text-white rounded-lg px-6 py-3 hover:opacity-80">
                                Submit Feedback
                            </x-ui.button>
                        </div>
                    </form>

                </x-ui.modal>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                {{-- Testimonial Card 1 --}}
                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ asset('profile_1.jpg') }}" class="w-14 h-14 rounded-full object-cover" alt="">
                        <div>
                            <h3 class="font-semibold text-lg">Maria Santos</h3>
                            <p class="text-gray-500 text-sm">Verified Customer</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        “The fruits are incredibly fresh! I always order my weekly groceries here. Highly recommended!”
                    </p>
                </div>

                {{-- Testimonial Card 2 --}}
                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ asset('profile_2.jpg') }}" class="w-14 h-14 rounded-full object-cover" alt="">
                        <div>
                            <h3 class="font-semibold text-lg">John Reyes</h3>
                            <p class="text-gray-500 text-sm">Loyal Shopper</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        “Fast delivery and excellent quality. Everything tastes better knowing it's organic.”
                    </p>
                </div>

                {{-- Testimonial Card 3 --}}
                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ asset('profile_3.jpg') }}" class="w-14 h-14 rounded-full object-cover" alt="">
                        <div>
                            <h3 class="font-semibold text-lg">Liza Mendoza</h3>
                            <p class="text-gray-500 text-sm">Eco-Friendly Mom</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        “EcoMart has changed how I shop. I love that I can support sustainable farming.”
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{--Footer--}}
    <div class="bg-gray-100">
        <footer class="footer sm:footer-horizontal sm:px-0 px-10 py-10 mx-auto max-w-7xl text-black">
            <aside>
                <div class="flex items-center gap-3">
                       <span class="rounded-full p-[10px] bg-[#2E7D32]">
                           <x-ui.icon name="ps:leaf" variant="bold" class="size-6 "/>
                       </span>
                    <h1 class="text-2xl text-[#2E7D32]">EcoMart</h1>
                </div>
                <p>
                    Fresh, organic groceries delivered to your doorstep.
                    <br/>
                    <span class="text-gray-500">© {{\Carbon\Carbon::now()->year}} EcoMart. All rights reserved.</span>
                </p>
            </aside>
            <nav>
                <h6 class="footer-title">Shop</h6>
                <a class="link link-hover">All Products</a>
                <a href="#category" class="link link-hover">Categories</a>
                <a class="link link-hover">Deals</a>
            </nav>
            <nav>
                <h6 class="footer-title">Support</h6>
                <a class="link link-hover">Contact Us</a>
                <a class="link link-hover">Track Order</a>
            </nav>
            <nav>
                <h6 class="footer-title">Quick Links</h6>
                @auth
                    <form action="{{route('logout-account')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <a class="link link-hover">Logout</a>
                        </button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="link link-hover">Login</a>
                @endguest
                <a href="{{ route('register') }}" class="link link-hover">Register</a>
                <a class="link link-hover">About Us</a>
            </nav>
        </footer>
    </div>
</div>
</body>
</html>
