<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
        <span class="space-y-3">
             <h1 class="text-gray-500 text-base">Total Customers</h1>
            <p class="text-2xl text-gray-800">{{$totalCustomers ?? 0}}</p>
        </span>
        </div>
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
        <span class="space-y-3">
             <h1 class="text-gray-500 text-base">Total Revenue</h1>
            <p class="text-2xl text-green-600">₱{{number_format($totalRevenue, 2) ?? 0}}</p>
        </span>
        </div>
        <div class=" flex flex-col  rounded-lg shadow bg-white w-full p-5 space-y-3 ">
        <span class="space-y-3">
             <h1 class="text-gray-500 text-base">Avg. Orders</h1>
            <p class="text-2xl text-blue-600">{{number_format($averageTotal, 2) ?? 0}}</p>
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
                       placeholder="Search customers..."
                       class="w-full pl-10 rounded-xl  border-1 border-gray-200 py-3 border-none
                   focus:outline-none focus:border-transparent shadow focus:ring-2 focus:ring-[#66BB6A]
                   transition-all duration-300"/>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto mt-8">
        <table class="table">

            <thead>
            <tr>
                <th>Customer</th>
                <th>Contact</th>
                <th>Total Orders</th>
                <th>Total Spent</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($customers as $customer)
                @php
                    $totalSpent= $customer->orders->sum('total_amount');
                    $totalOrders = $customer->orders->count();
                @endphp
                <tr>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$totalOrders}}</td>
                    <td>₱{{number_format($totalSpent, 2) ?? 0 }}</td>
                    <td>{{$customer->created_at->format('M d, Y')}}</td>
                    <td>
                        <x-ui.modal.trigger id="customer-details-{{ $customer->id }}">
                            <x-ui.icon name="ps:eye" class="size-5 text-gray-500"/>
                        </x-ui.modal.trigger>
                    </td>
                </tr>
                <x-ui.modal
                    position="center"
                    width="md"
                    id="customer-details-{{ $customer->id }}"
                    heading="Customer Details"
                >
                    <div class="flex items-center gap-5">
                       <span class="bg-green-700 px-[18px] py-3 text-white rounded-full text-xl">
                           J
                       </span>
                        <span class="text-gray-900 text-xl">
                           {{$customer->name}}
                       </span>
                    </div>
                    <div class="w-full border border-gray-100 my-2"></div>
                    <div class="mb-2">
                        <label for="email" class="text-gray-500 text-sm flex items-center">
                            <x-ui.icon name="ps:envelope" class="size-6 fill-gray-500"/>
                            Email</label>
                        <p>{{$customer->email}}</p>
                    </div>
                {{----}}
                    <div class="mb-2">
                        <label for="address" class="text-gray-500 text-sm flex items-center">
                            <x-ui.icon name="ps:map-pin" class="size-6 fill-gray-500"/>
                            Address</label>
{{--                        @foreach($customer->orders as $order)--}}
{{--                        <p>{{$customer->orders->address}}</p>--}}
{{--                        @endforeach--}}
                    </div>
                    <div class="w-full border border-gray-100 my-2"></div>
                    <div class="grid grid-cols-3 gap-10 py-4">
                        <div class="text-center">
                            <h1 class="text-gray-500 text-sm">Total Orders</h1>
                            <p class="text-base ">24</p>
                        </div>
                        <div class="text-center">
                            <h1 class="text-gray-500 text-sm">Total Spent</h1>
                            <p class="text-green-700 text-xl">$1234.54</p>
                        </div>
                        <div class="text-center">
                            <h1 class="text-gray-500 text-sm">Member Since</h1>
                            <p class="text-sm">Jan 15, 2024</p>
                        </div>
                    </div>
                    <div>
                        <x-ui.button x-on:click="$modal.close('customer-details-{{ $customer->id }}')" class="w-full rounded-full bg-green-700 text-white hover:opacity-75 transition-all duration-300 ">Close
                        </x-ui.button>
                    </div>
                </x-ui.modal>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
