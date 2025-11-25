<div>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5">
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
            <span class="space-y-3">
                 <h1 class="text-gray-500 text-base">Total Orders</h1>
                <p class="text-2xl text-gray-800">{{$totalOrders}}</p>
            </span>
        </div>
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
            <span class="space-y-3">
                 <h1 class="text-gray-500 text-base">Pending</h1>
                <p class="text-2xl text-yellow-800">{{$pendingOrders}}</p>
            </span>
        </div>
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
            <span class="space-y-3">
                 <h1 class="text-gray-500 text-base">In Transit</h1>
                <p class="text-2xl text-purple-600">{{$inTransitOrders}}</p>
            </span>
        </div>
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
            <span class="space-y-3">
                 <h1 class="text-gray-500 text-base">Delivered</h1>
                <p class="text-2xl text-green-600">{{$deliveredOrders}}</p>
            </span>
        </div>
    </div>

    <div class="bg-white shadow rounded-xl p-5 mt-12">
        <div class="flex items-center gap-8">
            <div class="relative w-full z-0 lg:px-0 flex-1 max-w-md">
                <x-ui.icon name="ps:magnifying-glass"
                           class="size-5  absolute bottom-[0.8rem] rounded-full left-4 lg:left-3 text-gray-500"/>
                <input type="search"
                       wire:model.live.debounce.300ms="search"
                       placeholder="Search orders..."
                       class="w-full pl-10 rounded-xl  border-1 border-gray-200 py-3 border-none
                   focus:outline-none focus:border-transparent shadow focus:ring-2 focus:ring-[#66BB6A]
                   transition-all duration-300"/>
            </div>
            <div>
                <x-ui.select
                    wire:model.live="status_filter"
                    wire:change="sortBy('status')"
                    placeholder="All Status"
                    icon="exclamation-circle">
                    <x-ui.select.option value="All Status">All Status</x-ui.select.option>
                    <x-ui.select.option value="Processing">Pending</x-ui.select.option>
                    <x-ui.select.option value="Assigned">Assigned</x-ui.select.option>
                    <x-ui.select.option value="Shipped">In Transit</x-ui.select.option>
                    <x-ui.select.option value="Delivered">Delivered</x-ui.select.option>
                </x-ui.select>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto mt-12">
        <table class="table w-full">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Rider</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($orders as $order)
                @php
                    $orderItems = $order->orderItems;
                    $countItems = $orderItems ? $orderItems->count() : 0;
                    $customer = $order->user;
                    $delivery = $order->delivery;
                    $address = $delivery;
                @endphp
                <tr class="bg-white rounded-xl" wire:key="{{$order->id}}">
                    <td class="text-gray-800">#{{$order->order_number}}</td>
                    <td>{{$customer->name ?? 'Guest'}}</td>
                    <td>{{$countItems}} Items</td>
                    <td>₱{{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        @php
                            $customerStatusMap = [
                                'pending' => 'Processing',
                                'assigned' => 'Processing',
                                'Processing' => 'Processing',
                                'Shipped' => 'Shipped',
                                'Delivered' => 'Delivered',
                                'Cancelled' => 'Cancelled',
                            ];

                            $displayStatus = $customerStatusMap[$order->status] ?? $order->status;
                        @endphp

                        @switch($displayStatus)
                            @case('Processing')
                                <x-ui.badge pill class="rounded-full" color="processing">{{$displayStatus}}</x-ui.badge>
                                @break
                            @case('Shipped')
                                <x-ui.badge pill class="rounded-full" color="shipped">{{$displayStatus}}</x-ui.badge>
                                @break
                            @case('Delivered')
                                <x-ui.badge pill class="rounded-full" color="delivered">{{$displayStatus}}</x-ui.badge>
                                @break
                            @case('Cancelled')
                                <x-ui.badge pill class="rounded-full" color="cancelled">{{$displayStatus}}</x-ui.badge>
                                @break
                            @default
                                <x-ui.badge pill class="rounded-full" color="gray">{{$displayStatus}}</x-ui.badge>
                        @endswitch
                    </td>

                    <td class="text-sm text-gray-600">
                        {{ $delivery && $delivery->rider ? $delivery->rider->name : 'Unassigned' }}
                    </td>

                    <td>{{$order->created_at->format('M d, Y')}}</td>
                    <td>
                        <x-ui.modal.trigger id="view-details-{{ $order->id }}">
                            <x-ui.icon name="ps:eye" class="size-5 text-gray-500 cursor-pointer hover:text-gray-700 transition"/>
                        </x-ui.modal.trigger>
                    </td>
                </tr>

                <x-ui.modal
                    position="center"
                    width="md"
                    id="view-details-{{ $order->id }}"
                    heading="Order Details"
                >
                    <div class="space-y-4 p-2">
                        <div class="flex items-center justify-between border-b pb-2">
                            <h1 class="text-gray-500">Order Number:</h1>
                            <h1 class="font-semibold">#{{$order->order_number}}</h1>
                        </div>
                        <div class="flex items-center justify-between border-b pb-2">
                            <h1 class="text-gray-500">Customer:</h1>
                            <h1 class="font-semibold">{{$customer->name ?? 'N/A'}}</h1>
                        </div>

                        <div class="flex items-center justify-between border-b pb-2">
                            <h1 class="text-gray-500">Address:</h1>
                            <h1 class="font-semibold text-right max-w-[60%]">{{$delivery->address ?? 'No address'}}</h1>
                        </div>
                        <div class="flex items-center justify-between border-b pb-2">
                            <h1 class="text-gray-500">Items:</h1>
                            <h1 class="font-semibold">{{$countItems}}</h1>
                        </div>
                        <div class="flex items-center justify-between border-b pb-2">
                            <h1 class="text-gray-500">Amount:</h1>
                            <h1 class="font-semibold">₱{{ number_format($order->total_amount, 2) }}</h1>
                        </div>
                        <div class="flex items-center justify-between border-b pb-2">
                            <h1 class="text-gray-500">Status:</h1>
                            <div>
                                @switch($order->status)
                                    @case('Processing')
                                        <x-ui.badge pill class="rounded-full" color="processing">{{$order->status}}</x-ui.badge>
                                        @break
                                    @case('Shipped')
                                        <x-ui.badge pill class="rounded-full" color="shipped">{{$order->status}}</x-ui.badge>
                                        @break
                                    @case('Delivered')
                                        <x-ui.badge pill class="rounded-full" color="delivered">{{$order->status}}</x-ui.badge>
                                        @break
                                    @case('Cancelled')
                                        <x-ui.badge pill class="rounded-full" color="cancelled">{{$order->status}}</x-ui.badge>
                                        @break
                                    @default
                                        <x-ui.badge pill class="rounded-full" color="gray">{{$order->status}}</x-ui.badge>
                                @endswitch                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <h1 class="text-gray-700 font-medium">Assign Rider:</h1>
                            <div class="w-1/2">
                                @if(!in_array(strtolower($order->status), ['delivered', 'cancelled']))
                                    <select
                                        wire:change="assignRider({{ $order->id }}, $event.target.value)"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                    >
                                        <option value="">Select Rider</option>
                                        @if(isset($riders))
                                            @foreach($riders as $rider)
                                                <option
                                                    value="{{ $rider->id }}"
                                                    {{ optional($order->delivery)->rider_id == $rider->id ? 'selected' : '' }}
                                                >
                                                    {{ $rider->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                @else
                                    <span class="text-gray-800 font-semibold">
                                        {{ optional($order->delivery?->rider)->name ?? 'Not Assigned' }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-ui.button x-on:click="$modal.close('view-details-{{ $order->id }}')" class="w-full rounded-full bg-green-700 text-white hover:opacity-75 transition-all duration-300 ">
                                Close
                            </x-ui.button>
                        </div>
                    </div>
                </x-ui.modal>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
