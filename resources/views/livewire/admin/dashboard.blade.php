<div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
        <span class="rounded-full w-10 h-10 flex items-center justify-center bg-green-700">
            <x-ui.icon name="ps:money-wavy" class="size-6 fill-white"/>
        </span>
            <span>
             <h1 class="text-gray-900 text-lg">₱{{number_format($totalRevenue, 2)}}</h1>
            <p class="text-sm text-gray-500">Total Revenue</p>
        </span>
        </div>
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
        <span class="rounded-full w-10 h-10 flex items-center justify-center bg-[#66BB6A]">
            <x-ui.icon name="ps:shopping-bag" class="size-6 fill-white"/>
        </span>
            <span>
             <h1 class="text-gray-900 text-lg">{{$totalOrders}}</h1>
            <p class="text-sm text-gray-500">Total Orders</p>
        </span>
        </div>
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
        <span class="rounded-full w-10 h-10 flex items-center justify-center bg-[#F9C74F]">
            <x-ui.icon name="ps:users" class="size-6 fill-white"/>
        </span>
            <span>
             <h1 class="text-gray-900 text-lg">{{$totalCustomer}}</h1>
            <p class="text-sm text-gray-500">Total Customers</p>
        </span>
        </div>
    </div>

    <div class="mt-14">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Sales Overview</h2>
                    <span class="text-sm text-gray-500">Last 7 Days</span>
                </div>
                <div class="relative h-72 w-full">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Total Orders</h2>
                    <span class="text-sm text-gray-500">Last 12 Months</span>
                </div>
                <div class="relative h-72 w-full">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>

        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                document.addEventListener('livewire:initialized', () => {

                    const salesCtx = document.getElementById('salesChart');
                    if (window.mySalesChart) window.mySalesChart.destroy();

                    window.mySalesChart = new Chart(salesCtx, {
                        type: 'bar',
                        data: {
                            labels: @json($salesLabels),
                            datasets: [{
                                label: 'Sale Revenue',
                                data: @json($salesData),
                                backgroundColor: 'rgba(79, 70, 229, 0.6)',
                                borderColor: 'rgba(79, 70, 229, 1)',
                                borderWidth: 1,
                                borderRadius: 4,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {callback: (value) => '₱' + value}
                                },
                                x: {grid: {display: false}}
                            }
                        }
                    });

                    const ordersCtx = document.getElementById('ordersChart');
                    if (window.myOrdersChart) window.myOrdersChart.destroy();

                    window.myOrdersChart = new Chart(ordersCtx, {
                        type: 'bar',
                        data: {
                            labels: @json($ordersLabels),
                            datasets: [{
                                label: 'Orders',
                                data: @json($ordersData),
                                backgroundColor: 'rgba(16, 185, 129, 0.6)',
                                borderColor: 'rgba(16, 185, 129, 1)',
                                borderWidth: 1,
                                borderRadius: 4,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {stepSize: 1}
                                },
                                x: {grid: {display: false}}
                            }
                        }
                    });

                });
            </script>
        @endpush
    </div>

    <div class="mt-14">
        <div class="bg-white w-full p-5 flex items-center justify-between rounded-xl">
            <h1 class="text-2xl font-semibold text-gray-900">Recent Orders</h1>
            <a href="#" class="text-sm hover:text-green-600">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($recentOrders as $order)
                    @php
                        $orderItems = $order->orderItems;
                        $customer = $order->user;
                    @endphp
                    <tr class="bg-white rounded-xl" wire:key="{{$order->id}}">
                        <td class="text-gray-800">#{{$order->order_number}}</td>
                        <td>{{$customer->name}}</td>
                        @foreach($orderItems as $item)
                            <td>{{$item->product_name}}</td>
                        @endforeach
                        <td>₱{{$order->total_amount}}</td>
                        <td>
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
                        </td>
                        <td>{{$order->created_at->format('M d, Y')}}</td>
                        <td>
                            <x-ui.modal.trigger id="view-details-{{ $order->id }}">
                                <x-ui.icon name="ps:eye" class="size-5 text-gray-500"/>
                            </x-ui.modal.trigger>
                        </td>
                    </tr>
                    <x-ui.modal
                        position="center"
                        width="md"
                        id="view-details-{{ $order->id }}"
                        heading="Order Details"
                    >
                        <div class=" space-y-2">
                            <div class="flex items-center justify-between">
                                <h1 class="text-gray-500">Order Number:</h1>
                                <h1>#{{$order->order_number}}</h1>
                            </div>
                            <div class="flex items-center justify-between">
                                <h1 class="text-gray-500">Customer:</h1>
                                <h1>{{$customer->name}}</h1>
                            </div>
                            <div class="flex items-center justify-between">
                                <h1 class="text-gray-500">Product:</h1>
                                @foreach($orderItems as $item)
                                    <h1>{{$item->product_name}}</h1>
                                @endforeach
                            </div>
                            <div class="flex items-center justify-between">
                                <h1 class="text-gray-500">Amount:</h1>
                                <h1>₱{{$order->total_amount}}</h1>
                            </div>
                            <div class="flex items-center justify-between">
                                <h1 class="text-gray-500">Payment Method: </h1>
                                <h1>{{$order->payment_method}}</h1>
                            </div>
                            <div class="flex items-center justify-between">
                                <h1 class="text-gray-500">Status:</h1>
                                <h1>
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
                                </h1>
                            </div>
                            <div class="flex items-center justify-between">
                                <h1 class="text-gray-500">Date:</h1>
                                <h1>{{$order->created_at->format('M d, Y')}}</h1>
                            </div>
                            <div>
                                <x-ui.button x-on:click="$modal.close('view-details-{{ $order->id }}')" class="w-full rounded-full bg-green-700 text-white hover:opacity-75 transition-all duration-300 ">Close
                                </x-ui.button>
                            </div>
                        </div>
                    </x-ui.modal>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
