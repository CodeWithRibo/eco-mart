    {{--NEED TO POLISH UI--}}
<div>
    {{--Search & Filter--}}
    <div
        class="bg-white rounded-lg shadow w-full p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">

        <div class="relative w-full z-0 lg:px-0 flex-1 max-w-md">
            <x-ui.icon name="ps:magnifying-glass"
                       class="size-5  absolute bottom-[0.8rem] left-4 lg:left-3 text-gray-500"/>
            <input type="search"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Search for fresh groceries..."
                   class="w-full pl-10 rounded-xl  border-1 border-gray-200 py-3 border-none
                   focus:outline-none focus:border-transparent shadow focus:ring-2 focus:ring-[#66BB6A]
                   transition-all duration-300"/>
        </div>

        <div class="inline-flex items-center gap-4 ">
            <div>
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
                </x-ui.select>
            </div>
            <x-ui.modal.trigger id="add-product">
                <x-ui.button
                    icon="ps:plus"
                    class="bg-green-700 text-white rounded-full hover:opacity-75 py-5">
                    Add Product
                </x-ui.button>
            </x-ui.modal.trigger>
        </div>

    </div>
    {{--Card Product Overview--}}
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        <div class="p-5 rounded-lg w-full space-y-4 bg-white shadow">
            <h1 class="text-gray-500 text-lg">Total Products</h1>
            <span class="text-3xl">{{$countProducts}}</span>
        </div>
        <div class="p-5 rounded-lg w-full space-y-4 bg-white shadow">
            <h1 class="text-gray-500 text-lg">In Stock</h1>
            <span class="text-3xl text-[#2E7D32]">{{$countInStock}}</span>
        </div>
        <div class="p-5 rounded-lg w-full space-y-4 bg-white shadow">
            <h1 class="text-gray-500 text-lg">Low Stock</h1>
            <span class="text-3xl text-[#F9C74F]">{{$countLowStock}}</span>
        </div>
        <div class="p-5 rounded-lg w-full space-y-4 bg-white shadow">
            <h1 class="text-gray-500 text-lg">Out of Stock</h1>
            <span class="text-3xl text-red-600">{{$countOutOfStock}}</span>
        </div>
    </div>
    {{--Product Table--}}
    <div class="overflow-x-auto ">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr wire:key="{{$product->id}}">
                    <td>{{$product->id}}</td>
                    <td class="flex items-center px-6 py-4">
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                            <img src="{{asset('storage/' . $product->product_image)}}"
                                 class="w-full h-full object-cover" alt="">
                        </div>
                        <p class="pl-5 font-semibold">{{$product->product_name}}</p>
                    </td>
                    <td class="px-6 py-4">{{$product->category}}</td>
                    <td class=" px-6 py-4">₱{{$product->price}}</td>
                    <td class=" px-6 py-4">{{$product->stock}} stocks</td>
                    <td class=" px-6 py-4">
                        @if($product->stock <= 0)
                            <x-ui.badge color="red" pill>Out of Stock</x-ui.badge>
                        @elseif($product->stock >= 1 && $product->stock <= 10)
                            <x-ui.badge color="yellow" pill>Low stock</x-ui.badge>
                        @else
                            <x-ui.badge color="green" pill>In stock</x-ui.badge>
                        @endif
                    </td>
                    <td class=" px-6 py-4">
                        <x-ui.modal.trigger id="edit-product">
                            <x-ui.icon name="ps:pencil-simple" class="size-4" wire:click="edit({{$product->id}})"/>
                        </x-ui.modal.trigger>
                        <x-ui.modal.trigger id="delete-product">
                            <x-ui.icon name="ps:trash" class="size-4" wire:click="delete({{$product->id}})"/>
                        </x-ui.modal.trigger>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$products->links()}}
    </div>
</div>
