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
<div class="bg-white text-black">
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
                <a href="{{route('login')}}" class="text-base text-gray-500 focus:text-green-700 hover:opacity-80">Login</a>
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
                    <x-ui.button
                        class="bg-green-700 hover:opacity-70 transition-all duration-200 text-white rounded-lg py-5 cursor-pointer">
                        Shop Now
                    </x-ui.button>
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
                            <h1 class="text-lg">500+ Products</h1>
                            <h2 class="text-sm text-gray-500">Organic and Fresh</h2>
                        </span>
                </div>
            </div>
        </div>
    </section>
    {{--Shop By Category--}}
    <section class="py-10 pb-16 bg-gray-100">
        <div class="mx-auto max-w-7xl">
            <span class="flex flex-col text-center justify-center space-y-2 py-14">
                <h1 class="font-bold text-4xl">Shop by Category</h1>
                <p class="text-gray-500 text-sm">Browse our wide selection of fresh, organic products</p>
            </span>

            <div
                class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 px-10 xl:px-0 gap-5 cursor-pointer">
                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#66bb6a] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:carrot" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Fruits & Vegetables</h2>
                        <p class="text-gray-500">234 items</p>
                    </span>
                </a>

                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#f9c74f] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:package" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Dairy & Eggs</h2>
                        <p class="text-gray-500">156 items</p>
                    </span>
                </a>

                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#8d6e63] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:cookie" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Bakery</h2>
                        <p class="text-gray-500">50 items</p>
                    </span>
                </a>

                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#2e7d32] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:fish" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Meat & Seafood</h2>
                        <p class="text-gray-500">234 items</p>
                    </span>
                </a>

                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#66bb6a] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:jar-label" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Beverage</h2>
                        <p class="text-gray-500">234 items</p>
                    </span>
                </a>

                <a class="inline-flex flex-col justify-center items-center text-center sm:text-start sm:items-start sm:justify-start bg-white py-6 px-8 rounded-xl hover:shadow-xl transition-all duration-300">
                    <span
                        class="rounded-xl p-[10px] bg-[#f9c74f] mb-1 w-16 h-16 hover:w-[70px] hover:h-[70px] transition-all duration-300 flex items-center justify-center">
                           <x-ui.icon name="ps:cherries" variant="bold" class="size-8 "/>
                    </span>
                    <span>
                        <h2 class="text-xl mb-2 font-semibold text-gray-800">Snacks</h2>
                        <p class="text-gray-500">234 items</p>
                    </span>
                </a>

            </div>
        </div>

    </section>
    {{--Featured Products--}}
    <section class="py-10 pb-16 bg-white">
        <div class="mx-auto max-w-7xl">
             <span class="flex flex-col sm:flex-row sm:justify-between space-y-5 sm:space-y-2 py-14 px-10 xl:px-0">
                 <span>
                     <h1 class="font-bold text-4xl">Featured Products</h1>
                     <p class="text-gray-500 text-sm">Our best-selling organic groceries</p>
                 </span>
                 <div>
                     <a
                         href="#"
                         class="rounded-full px-6 py-3 bg-[#F5E6C8] text-[#2E7D32] hover:bg-[#F9C74F] transition-colors">View All</a>
                 </div>
            </span>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 px-10 xl:px-0 gap-5">
                <div class="card-group">
                    <img src="{{asset('tomatoes.jpg')}}"
                         alt="tomatoes"
                         class="w-full aspect-[4/3] object-cover object-center rounded-t-2xl">
                    <div class="pb-5 px-5 space-y-3">
                <span>
                    <h1 class="text-xl text-gray-900 font-semibold">Organic Fresh Tomatoes</h1>
                    <p class="text-green-700">$4.99 <span class="text-gray-500">/kg</span></p>
                </span>
                        <x-ui.button
                            icon="ps:shopping-cart"
                            class="bg-green-700 hover:opacity-70 transition-all duration-200 text-white rounded-full cursor-pointer">
                            Add
                        </x-ui.button>
                    </div>
                </div>
                <div class="card-group">
                    <img src="{{asset('green_apple.jpg')}}"
                         alt="green-apple"
                         class="w-full aspect-[4/3] object-cover object-center rounded-t-2xl ">
                    <div class="pb-5 px-5 space-y-3">
                <span>
                    <h1 class="text-xl text-gray-900 font-semibold">Green Apples Premium</h1>
                    <p class="text-green-700">$4.99 <span class="text-gray-500">/kg</span></p>
                </span>
                        <x-ui.button
                            icon="ps:shopping-cart"
                            class="bg-green-700 hover:opacity-70 transition-all duration-200 text-white rounded-full cursor-pointer">
                            Add
                        </x-ui.button>
                    </div>
                </div>
                <div class="card-group">
                    <img src="{{asset('bread.jpg')}}"
                         alt="bread"
                         class="w-full aspect-[4/3] object-cover object-center rounded-t-2xl">
                    <div class="pb-5 px-5 space-y-3">
                <span>
                    <h1 class="text-xl text-gray-900 font-semibold">Fresh Artisan Bread</h1>
                    <p class="text-green-700">$4.99 <span class="text-gray-500">/loaf</span></p>
                </span>
                        <x-ui.button
                            icon="ps:shopping-cart"
                            class="bg-green-700 hover:opacity-70 transition-all duration-200 text-white rounded-full cursor-pointer">
                            Add
                        </x-ui.button>
                    </div>
                </div>
                <div class="card-group">
                    <img src="{{asset('milk.jpg')}}"
                         alt="milk"
                         class="w-full aspect-[4/3] object-cover object-center rounded-t-2xl">
                    <div class="pb-5 px-5 space-y-3">
                <span>
                    <h1 class="text-xl text-gray-900 font-semibold">Organic Milk</h1>
                    <p class="text-green-700">$4.99 <span class="text-gray-500">/liter</span></p>
                </span>
                        <x-ui.button
                            icon="ps:shopping-cart"
                            class="bg-green-700 hover:opacity-70 transition-all duration-200 text-white rounded-full cursor-pointer">
                            Add
                        </x-ui.button>
                    </div>
                </div>
                <div class="card-group">
                    <img src="{{asset('fresh-vegetable.jpg')}}"
                         alt="fresh-vegetable"
                         class="w-full aspect-[4/3] object-cover object-center rounded-t-2xl">
                    <div class="pb-5 px-5 space-y-3">
                <span>
                    <h1 class="text-xl text-gray-900 font-semibold">Fresh Vegetables Mix</h1>
                    <p class="text-green-700">$5.99 <span class="text-gray-500">/kg</span></p>
                </span>
                        <x-ui.button
                            icon="ps:shopping-cart"
                            class="bg-green-700 hover:opacity-70 transition-all duration-200 text-white rounded-full cursor-pointer">
                            Add
                        </x-ui.button>
                    </div>
                </div>
                <div class="card-group">
                    <img src="{{asset('fruit-basket.jpg')}}"
                         alt="fruit-basket"
                         class="w-full aspect-[4/3] object-cover object-center rounded-t-2xl">
                    <div class="pb-5 px-5 space-y-3">
                <span>
                    <h1 class="text-xl text-gray-900 font-semibold">Organic Fruit Basket</h1>
                    <p class="text-green-700">$11.99 <span class="text-gray-500">/kg</span></p>
                </span>
                        <x-ui.button
                            icon="ps:shopping-cart"
                            class="bg-green-700 hover:opacity-70 transition-all duration-200 text-white rounded-full cursor-pointer">
                            Add
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--Footer--}}
    <div class="bg-gray-100">
        <footer class="footer sm:footer-horizontal  text-base-content py-10 mx-auto max-w-7xl">
            <aside>
                <div class="flex items-center gap-3">
                       <span class="rounded-full p-[10px] bg-[#2E7D32]">
                           <x-ui.icon name="ps:leaf" variant="bold" class="size-6 "/>
                       </span>
                    <h1 class="text-2xl text-[#2E7D32]">EcoMart</h1>
                </div>
                <p>
                    Fresh, organic groceries delivered to your doorstep.
                    <br />
                    <span class="text-gray-500">© {{\Carbon\Carbon::now()->year}} EcoMart. All rights reserved.</span>
                </p>
            </aside>
            <nav>
                <h6 class="footer-title">Shop</h6>
                <a class="link link-hover">All Products</a>
                <a class="link link-hover">Categories</a>
                <a class="link link-hover">Deals</a>
            </nav>
            <nav>
                <h6 class="footer-title">Support</h6>
                <a class="link link-hover">Contact Us</a>
                <a class="link link-hover">Track Order</a>
            </nav>
            <nav>
                <h6 class="footer-title">Quick Links</h6>
                <a href="{{ route('login') }}" class="link link-hover">Login</a>
                <a href="{{ route('register') }}" class="link link-hover">Register</a>
                <a class="link link-hover">About Us</a>
            </nav>
        </footer>
    </div>
</div>
</body>
</html>
