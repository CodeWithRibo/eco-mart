<div>
    <div class="mx-auto max-w-2xl mb-20">
        {{--Search Product--}}
        <div class="relative w-full z-0 px-10 lg:px-0 ">
            <x-ui.icon name="ps:magnifying-glass" class="size-5  absolute bottom-[0.8rem] left-12 lg:left-3 text-gray-500"/>
            <input type="search"
                   placeholder="Search for fresh groceries..."
                   class="w-full pl-10 bg-gray-100 rounded-xl shadow border-1 border-gray-100 py-3 border-none
                   focus:outline-none focus:ring-2 focus:ring-[#66BB6A]
                   transition-all duration-300"/>
        </div>
    </div>

    <div class="grid md:grid-cols-1 lg:grid-cols-4 gap-8">
        {{--Filters--}}
        <div class="px-10 lg:px-0">
            <div class="shadow rounded-lg lg:col-span-1 ">
                <h2 class="p-5 text-xl text-gray-700 font-semibold">Filters</h2>
                {{--Category--}}
                <div x-data="{ open : true}" class="px-10 pb-5 mb-2">
                    <div class="flex items-center justify-between mb-3">
                        <button @click="open = ! open">Category</button>
                        <template x-if="open">
                            <x-ui.icon name="ps:caret-up" class="size-5 fill-gray-700" />
                        </template>

                        <template x-if="!open">
                            <x-ui.icon name="ps:caret-down" class="size-5 fill-gray-700" />
                        </template>
                    </div>
                    <div x-show="open">
                        <div class="my-2 flex flex-col gap-3">
                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="filter_category" class="">
                                <span class="text-gray-800">Fruits</span>
                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="filter_category" class="">
                                <span class="text-gray-800">Vegetables</span>

                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="filter_category" class="">
                                <span class="text-gray-800">Bakery</span>
                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="filter_category" class="">
                                <span class="text-gray-800">Dairy</span>
                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="filter_category" class="">
                                <span class="text-gray-800">Pantry</span>

                            </div>

                        </div>

                    </div>
                </div>
                {{--Price Range--}}
                <div x-data="{ open : true}" class="px-10 pb-5">
                    <div class="flex items-center justify-between mb-3">
                        <button @click="open = ! open">Price Range</button>
                        <template x-if="open">
                            <x-ui.icon name="ps:caret-up" class="size-5 fill-gray-700" />
                        </template>

                        <template x-if="!open">
                            <x-ui.icon name="ps:caret-down" class="size-5 fill-gray-700" />
                        </template>
                    </div>
                    <div x-show="open">
                        <div class="my-2 flex flex-col gap-3">
                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="filter_category" class="rounded-full">
                                <span class="text-gray-800">Under ₱100</span>
                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="filter_category" class="rounded-full">
                                <span class="text-gray-800">₱100 - ₱200 </span>
                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="filter_category" class="rounded-full">
                                <span class="text-gray-800">₱200 - ₱500 </span>
                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="filter_category" class="rounded-full">
                                <span class="text-gray-800">₱600+ </span>

                            </div>


                        </div>

                    </div>
                </div>
                {{--Special Filters--}}
                <div x-data="{ open : true}" class="px-10 pb-5">
                    <div class="flex items-center justify-between mb-3">
                        <button @click="open = ! open">Special Filters</button>
                        <template x-if="open">
                            <x-ui.icon name="ps:caret-up" class="size-5 fill-gray-700" />
                        </template>

                        <template x-if="!open">
                            <x-ui.icon name="ps:caret-down" class="size-5 fill-gray-700" />
                        </template>
                    </div>
                    <div x-show="open">
                        <div class="my-2 flex flex-col gap-3">
                            <div class="inline-flex items-center gap-2">
                                <input type="checkbox" name="special-filters" class="">
                                <span class="text-gray-800">Organic Only </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--List Products--}}
        <div class="lg:col-span-3 px-10 lg:px-0">
            <div class="grid  md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="card-group space-y-5  ">

                        <img src="{{$product->product_image}}"
                             alt="Product Image"
                             class="w-full aspect-[4/3] object-cover object-center rounded-t-2xl mb-0 ">
                        <div class="space-y-5 p-4">
                    <span>
                        <h6 class="text-[1.125rem] text-gray-900 mb-2 hover:text-[#2E7D32] transition-colors">{{$product->product_name}}</h6>
                        <p class="text-[#2E7D32] text-[1.5rem] mb-2">${{$product->price}} <span class="text-gray-500 text-sm">/kg</span></p>
                    </span>
                            <x-ui.button
                                wire:click="addToCart({{$product->id}})"
                                icon="ps:shopping-cart"
                                class="bg-green-700 hover:opacity-70 transition-all duration-200 text-white rounded-full cursor-pointer w-[80%] py-2.5 ">
                                Add
                            </x-ui.button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <button class="btn btn-ghost" wire:click="testing()">Test</button>

</div>
