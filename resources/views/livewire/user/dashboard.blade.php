<div class="mt-5">
    {{--Card Overview--}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="rounded-lg p-10 bg-white shadow">
            <span class="w-12 h-12 bg-[#2E7D32]  rounded-full flex items-center justify-center mb-4">
                <x-ui.icon name="ps:shopping-bag" class="size-6 fill-white"/>
            </span>
            <h2 class="text-gray-500 text-sm">Total Orders</h2>
            <h3 class="text-gray-900 text-lg">{{$totalOrders ?? 0}}</h3>
        </div>
        <div class="rounded-lg p-10 bg-white shadow">
            <span class="w-12 h-12 bg-[#F9C74F]  rounded-full flex items-center justify-center mb-4">
                <x-ui.icon name="ps:package" class="size-6 fill-white"/>
            </span>
            <h2 class="text-gray-500 text-sm">Processing</h2>
            <h3 class="text-gray-900 text-lg">{{$Processing ?? 0}}</h3>
        </div>
        <div class="rounded-lg p-10 bg-white shadow">
            <span class="w-12 h-12 bg-[#66BB6A]  rounded-full flex items-center justify-center mb-4">
                <x-ui.icon name="ps:check-circle" class="size-6 fill-white"/>
            </span>
            <h2 class="text-gray-500 text-sm">Delivered</h2>
            <h3 class="text-gray-900 text-lg">{{$delivered ?? 0}}</h3>
        </div>

        <div class="rounded-lg p-10 bg-white shadow">
            <span class="w-12 h-12 bg-red-700 rounded-full flex items-center justify-center mb-4">
                <x-ui.icon name="ps:x" class="size-6 fill-white"/>
            </span>
            <h2 class="text-gray-500 text-sm">Cancelled</h2>
            <h3 class="text-gray-900 text-lg">{{$cancelled ?? 0}}</h3>
        </div>

    </div>

    {{--ORDER HISTORY--}}
    <div class="bg-white w-full mt-14 p-5 rounded-xl ">
        <span class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold">Recent Orders</h1>
            <a href="{{route('order-history')}}" class="hover:text-green-600 transition-all duration-200">View All</a>
        </span>
        <div class="mt-10 flex flex-col gap-5">
                @if($recentOrders->isNotEmpty())
                @foreach($recentOrders as $order)
                    <div class="border-1 border-gray-200 hover:border-green-700 transition-all duration-200 rounded-lg">
                        <div class="p-5 space-y-5">
                    <span class="flex items-center justify-between">
                        <span>
                            <h2 class="text-xl text-gray-700">{{$order->order_number}}</h2>
                            <h3 class="text-gray-500 text-sm">{{$order->created_at->format('M d, Y')}}</h3>
                        </span>
                         @switch($order->status)
                            @case('Processing')
                                <x-ui.badge pill class="rounded-full mb-5"
                                            color="processing">{{$order->status}}</x-ui.badge>
                                @break
                            @case('Shipped')
                                <x-ui.badge pill class="rounded-full mb-5"
                                            color="shipped">{{$order->status}}</x-ui.badge>
                                @break
                            @case('Delivered')
                                <x-ui.badge pill class="rounded-full mb-5"
                                            color="delivered">{{$order->status}}</x-ui.badge>
                                @break
                            @case('Cancelled')
                                <x-ui.badge pill class="rounded-full mb-5"
                                            color="cancelled">{{$order->status}}</x-ui.badge>
                                @break
                        @endswitch
                    </span>
                            @php
                                $countItem = $order->orderItems->pluck('product_name')->count();
                            @endphp
                            <span class="flex items-center justify-between">
                                <p class="text-gray-500 text-sm">{{$countItem}} items</p>
                                <p class="text-base text-gray-700">₱{{$order->total_amount}}</p>
                            </span>
                        </div>
                    </div>
                @endforeach
                @else
                <h1 class="text-xl italic font-semibold text-center">NO ORDER HISTORY FOUND</h1>
            @endif
        </div>
    </div>

    <div class="mt-10">
        <div class="p-6 rounded-lg bg-white shadow">
            <h1 class="text-3xl font-semibold mb-5 ">Quick Actions</h1>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 ">
                <div class="bg-gradient-to-br from-[#2E7D32] to-[#66BB6A] shadow rounded-lg p-5">
                    <a href="{{route('products')}}">
                        <span class="flex flex-col items-center justify-center ">
                        <x-ui.icon name="ps:shopping-bag" class="size-8 fill-white"/>
                        <h1 class="text-lg text-white">Continue Shopping</h1>
                    </span>
                    </a>
                </div>
                <div class="bg-gradient-to-br from-[#F9C74F] to-[#FFD700] shadow rounded-lg p-5">
                    <a href="{{route('order-history')}}">
                         <span class="flex flex-col items-center justify-center ">
                        <x-ui.icon name="ps:package" class="size-8 fill-white"/>
                        <h1 class="text-lg text-white">Track Orders</h1>
                    </span>
                    </a>
                </div>
                <div class="bg-gradient-to-br from-[#8D6E63] to-[#A1887F] shadow rounded-lg p-5">
                    <a href="{{route('shopping-carts')}}">
                         <span class="flex flex-col items-center justify-center ">
                        <x-ui.icon name="ps:package" class="size-8 fill-white"/>
                        <h1 class="text-lg text-white">View Cart</h1>
                    </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
