<div>
    <div class="mx-auto max-w-2xl mb-20">
        {{--Search Product--}}
        <div class="relative w-full z-0 px-10 lg:px-0 ">
            <x-ui.icon name="ps:magnifying-glass"
                       class="size-5  absolute bottom-[0.8rem] left-12 lg:left-3 text-gray-500"/>
            <input type="search"
                   wire:model.live.debounce.300ms="search"
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
                            <x-ui.icon name="ps:caret-up" class="size-5 fill-gray-700"/>
                        </template>

                        <template x-if="!open">
                            <x-ui.icon name="ps:caret-down" class="size-5 fill-gray-700"/>
                        </template>
                    </div>
                    <div x-show="open">
                        <div class="my-2 flex flex-col gap-3">
                            <x-ui.select
                                wire:model.live="category_filter"
                                wire:change="sortBy('category')"
                                placeholder="All Categories"
                                icon="exclamation-circle">
                                <x-ui.select.option value="All Categories">All Categories</x-ui.select.option>
                                <x-ui.select.option value="Vegetables">Vegetables</x-ui.select.option>
                                <x-ui.select.option value="Fruits">Fruits</x-ui.select.option>
                                <x-ui.select.option value="Bakery">Bakery</x-ui.select.option>
                                <x-ui.select.option value="Beverage">Beverage</x-ui.select.option>
                                <x-ui.select.option value="Dairy & Eggs">Dairy & Eggs</x-ui.select.option>
                            </x-ui.select>
                        </div>

                    </div>
                </div>
                {{--Price Range--}}
                <div x-data="{ open : true}" class="px-10 pb-5">
                    <div class="flex items-center justify-between mb-3">
                        <button @click="open = ! open">Price Range</button>
                        <template x-if="open">
                            <x-ui.icon name="ps:caret-up" class="size-5 fill-gray-700"/>
                        </template>

                        <template x-if="!open">
                            <x-ui.icon name="ps:caret-down" class="size-5 fill-gray-700"/>
                        </template>
                    </div>
                    <div x-show="open">
                        <div class="my-2 flex flex-col gap-3">
                            <x-ui.select
                                wire:model.live="price_filter"
                                wire:change="sortBy('price')"
                                placeholder="All Price"
                                icon="exclamation-circle">
                                <x-ui.select.option value="under_100">Under ₱100</x-ui.select.option>
                                <x-ui.select.option value="100_200">₱100 - ₱200</x-ui.select.option>
                                <x-ui.select.option value="300_500">₱300 - ₱500</x-ui.select.option>
                            </x-ui.select>

                        </div>

                    </div>
                </div>
                {{--Special Filters--}}
                <div x-data="{ open : true}" class="px-10 pb-5">
                    <div class="flex items-center justify-between mb-3">
                        <button @click="open = ! open">Label</button>
                        <template x-if="open">
                            <x-ui.icon name="ps:caret-up" class="size-5 fill-gray-700"/>
                        </template>

                        <template x-if="!open">
                            <x-ui.icon name="ps:caret-down" class="size-5 fill-gray-700"/>
                        </template>
                    </div>
                    <div x-show="open">
                        <div class="my-2 flex flex-col gap-3">

                            <div class="inline-flex items-center gap-2">
                                <input type="radio" wire:model.live="special_filters" value="all">
                                <span class="text-gray-800">All</span>
                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="radio" wire:model.live="special_filters" value="organic">
                                <span class="text-gray-800">Organic Only </span>
                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="radio" wire:model.live="special_filters" value="natural">
                                <span class="text-gray-800">Natural Only </span>
                            </div>

                            <div class="inline-flex items-center gap-2">
                                <input type="radio" wire:model.live="special_filters" value="eco-friendly">
                                <span class="text-gray-800">Eco-Friendly Only </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--List Products--}}
        <div class="lg:col-span-3 px-10 lg:px-0">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="card-group space-y-5 relative ">
                        <x-ui.badge pill color="organic" class="absolute right-2 top-2 text-xs">{{$product->label}}</x-ui.badge>
                        <img src="{{$product->product_image}}"
                             alt="Product Image"
                             class="w-full aspect-[4/3] object-cover object-center rounded-t-2xl mb-0 ">
                        <div class="space-y-5 p-4">
                        <span>
                            <h6 class="text-[1.125rem] text-gray-900 mb-2 hover:text-[#2E7D32] transition-colors">{{$product->product_name}}</h6>
                            <h2 class="text-gray-500">{{$product->stock ?? 0}} Stock Available</h2>
                            <p class="text-[#2E7D32] text-[1.5rem] mb-2">₱{{$product->price}} <span
                                    class="text-gray-500 text-sm">/{{$product->unit}}</span></p>
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
    {{$products->links()}}
</div>
