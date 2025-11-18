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
                <a href="#" class="text-base text-gray-500 focus:text-green-700 hover:opacity-80">Login</a>
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
    <footer class="py-10 bg-gray-100">
        <div class="mx-auto max-w-7xl">

        </div>
    </footer>

    <footer class="footer sm:footer-horizontal bg-base-200 text-base-content p-10">
        <aside>
            <svg
                width="50"
                height="50"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
                fill-rule="evenodd"
                clip-rule="evenodd"
                class="fill-current">
                <path
                    d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z"></path>
            </svg>
            <p>
                ACME Industries Ltd.
                <br />
                Providing reliable tech since 1992
            </p>
        </aside>
        <nav>
            <h6 class="footer-title">Services</h6>
            <a class="link link-hover">Branding</a>
            <a class="link link-hover">Design</a>
            <a class="link link-hover">Marketing</a>
            <a class="link link-hover">Advertisement</a>
        </nav>
        <nav>
            <h6 class="footer-title">Company</h6>
            <a class="link link-hover">About us</a>
            <a class="link link-hover">Contact</a>
            <a class="link link-hover">Jobs</a>
            <a class="link link-hover">Press kit</a>
        </nav>
        <nav>
            <h6 class="footer-title">Legal</h6>
            <a class="link link-hover">Terms of use</a>
            <a class="link link-hover">Privacy policy</a>
            <a class="link link-hover">Cookie policy</a>
        </nav>
    </footer>

</div>
</body>
</html>
