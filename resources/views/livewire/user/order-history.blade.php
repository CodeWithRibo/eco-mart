<div>
    <div>
        <x-ui.tabs>
            <x-ui.tab.group class="justify-start">
                <x-ui.tab name="All Orders" label="All Orders"/>
                <x-ui.tab name="Processing" label="Processing"/>
                <x-ui.tab name="Shipped" label="Shipped"/>
                <x-ui.tab name="Delivered" label="Delivered"/>
                <x-ui.tab name="Cancelled" label="Cancelled"/>
            </x-ui.tab.group>
            @if($orders->isNotEmpty())
                <x-ui.tab.panel name="All Orders">
                    <div class="mt-10 flex flex-col gap-5">
                        @foreach($orders as $order)
                            <div wire:key="{{$order->id}}"
                                 class="border-1 border-gray-200 hover:border-green-700 transition-all duration-200 rounded-lg">
                                <div class="p-5 space-y-5">
                                    <div class="flex items-center justify-between space-x-3">
                                        <div>
                                      <span class="flex gap-4">
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
                                        </div>
                                        <div>
                                            @php
                                                $countItem = $order->orderItems->pluck('product_name')->count();
                                                $orderItems = $order->orderItems;
                                                $totalSubtotal = $orderItems->sum('subtotal');
                                            @endphp
                                            <p class="text-gray-500 text-sm mb-2">{{$countItem}} items</p>
                                            <p class="text-gray-900 text-base"><span
                                                    class="text-sm text-gray-500">Total: </span>₱{{$totalSubtotal}}
                                            </p> {{--Total--}}
                                        </div>
                                    </div>
                                    <div class="w-full border text-gray-200 my-2"></div>
                                    @foreach($orderItems as $item)
                                        <div class="flex items-center justify-between my-1 p-0">
                                            <p class="text-gray-500 text-sm">{{$item->quantity}}
                                                x {{$item->product_name}}</p>
                                            <p class="text-gray-700 text-sm ">₱{{$item->subtotal}}</p>
                                        </div>
                                    @endforeach
                                </div>
                                {{--View Details--}}
                                <div class="flex flex-col  gap-5 mx-5 my-3">
                                    <x-ui.modal.trigger id="view-details-{{ $order->id }}">
                                        <x-ui.button icon="ps:eye" class="w-full rounded-full bg-green-700 text-white hover:opacity-75 transition-all duration-300 ">View
                                            Details
                                        </x-ui.button>
                                    </x-ui.modal.trigger>

                                    <x-ui.modal
                                        width="xl"
                                        id="view-details-{{ $order->id }}"
                                        heading="Order Details"
                                    >
                                        <div class="">
                                            <div class="flex items-center justify-between">
                                           <span>
                                                <h1 class="text-gray-500 text-sm">Order Number</h1>
                                            <p class="text-gray-800 text-base">{{$order->order_number}}</p>
                                           </span>
                                                <span>
                                             <h1 class="text-gray-500 text-sm">Order Date</h1>
                                            <p class="text-gray-800 text-base">{{$order->created_at->format('F j, Y')}}</p>
                                        </span>
                                            </div>
                                            <div class="">
                                                <h1 class="text-gray-500 text-sm">Status</h1>
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
                                            </div>

                                            <div class="w-full border border-gray-200 my-2"></div>

                                            <div class="my-3">
                                                <h1 class="text-gray-500 text-sm">Delivery Address</h1>
                                                @php
                                                    $fullAddress = $order->delivery;

                                                    $deliveryAddress = $fullAddress->address . $fullAddress->barangay . ',' . $fullAddress->city . ',' . $fullAddress->province;

                                                @endphp
                                                <p class="text-gray-800 text-base">{{ $order->delivery ? $deliveryAddress  : 'No Delivery Address Found'}}</p>

                                            </div>

                                            <div class="w-full border border-gray-200 my-2"></div>

                                            <div class="my-3 space-y-3">
                                                <h1 class="text-xl font-semibold mb-2 text-gray-900">Order Items ({{$countItem}} Items)</h1>
                                                @foreach($orderItems as $item)
                                                    <div class="p-3 rounded-xl bg-gray-50 flex items-center justify-between">
                                                <span class="space-y-2">
                                                        <p>{{$item->product_name}}</p>
                                                        <p class="text-gray-500">Quantity: {{$item->quantity}} x ₱{{number_format($item->unit_price, 2)}} </p>
                                                </span>
                                                        <p>₱{{number_format($item->subtotal, 2)}}</p>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="w-full border border-gray-200 my-2"></div>
                                            <div class="flex items-center justify-between my-2">
                                                <span class="text-gray-500">Subtotal</span>
                                                <span >₱{{number_format($totalSubtotal, 2)}}</span>
                                            </div>
                                            <div class="flex items-center justify-between my-2">
                                                <span class="text-gray-500">Delivery Fee</span>
                                                <span>₱40.00</span>
                                            </div>

                                            <div class="w-full border border-gray-200 my-2"></div>

                                            <div class="flex items-center justify-between my-2">
                                                <span>Total</span>
                                                <span class="text-green-700">₱{{number_format($order->total_amount, 2)}}</span>
                                            </div>

                                            <x-ui.button
                                                class="hover:opacity-75  bg-green-700 text-white transition-all duration-300 w-full rounded-full"
                                                x-on:click="$modal.close('view-details-{{ $order->id }}')">
                                                Close
                                            </x-ui.button>

                                        </div>
                                    </x-ui.modal>


                                    @if($order->status === 'Processing')
                                        <x-ui.modal.trigger id="cancel-order">
                                            <x-ui.button color="red"  class="w-full hover:opacity-75 transition-all duration-300 rounded-full" >Cancel Order</x-ui.button>
                                        </x-ui.modal.trigger>
                                    @endif
                                </div>

                            </div>

                        @endforeach
                    </div>
                </x-ui.tab.panel>
                <x-ui.tab.panel name="Processing">
                    <div class="mt-10 flex flex-col gap-5">
                        @foreach($orders as $order)
                            @if($order->status === 'Processing')
                                <div wire:key="{{$order->id}}"
                                     class="border-1 border-gray-200 hover:border-green-700 transition-all duration-200 rounded-lg">
                                    <div class="p-5 space-y-5">
                                        <div class="flex items-center justify-between space-x-3">
                                            <div>
                                      <span class="flex gap-4">
                                       <span>
                                      <h2 class="text-xl text-gray-700">{{$order->order_number}}</h2>
                                       <h3 class="text-gray-500 text-sm">{{$order->created_at->format('M d, Y')}}</h3>
                                       </span>
                                      <x-ui.badge pill class="rounded-full mb-5"
                                                  color="processing">{{$order->status}}</x-ui.badge>
                                   </span>
                                            </div>
                                            <div>
                                                @php
                                                    $countItem = $order->orderItems->pluck('product_name')->count();
                                                    $orderItems = $order->orderItems;
                                                    $totalSubtotal = $orderItems->sum('subtotal');
                                                @endphp
                                                <p class="text-gray-500 text-sm mb-2">{{$countItem}} items</p>
                                                <p class="text-gray-900 text-base"><span
                                                        class="text-sm text-gray-500">Total: </span>₱{{$totalSubtotal}}</p>
                                            </div>
                                        </div>
                                        <div class="w-full border text-gray-200 my-2"></div>
                                        @foreach($orderItems as $item)

                                            <div class="flex items-center justify-between my-1 p-0">
                                                <p class="text-gray-500 text-sm">{{$item->quantity}}
                                                    x {{$item->product_name}}</p>
                                                <p class="text-gray-700 text-sm ">₱{{$item->subtotal}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex flex-col gap-5 mx-5 my-3">
                                        {{--View Details--}}
                                        <div class="flex flex-col  gap-5 my-3">
                                            <x-ui.modal.trigger id="view-details-{{ $order->id }}">
                                                <x-ui.button icon="ps:eye" class="w-full rounded-full bg-green-700 text-white hover:opacity-75 transition-all duration-300 ">View
                                                    Details
                                                </x-ui.button>
                                            </x-ui.modal.trigger>

                                            <x-ui.modal
                                                width="xl"
                                                id="view-details-{{ $order->id }}"
                                                heading="Order Details"
                                            >
                                                <div class="">
                                                    <div class="flex items-center justify-between">
                                           <span>
                                                <h1 class="text-gray-500 text-sm">Order Number</h1>
                                            <p class="text-gray-800 text-base">{{$order->order_number}}</p>
                                           </span>
                                                        <span>
                                             <h1 class="text-gray-500 text-sm">Order Date</h1>
                                            <p class="text-gray-800 text-base">{{$order->created_at->format('F j, Y')}}</p>
                                        </span>
                                                    </div>
                                                    <div class="">
                                                        <h1 class="text-gray-500 text-sm">Status</h1>
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
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="my-3">
                                                        <h1 class="text-gray-500 text-sm">Delivery Address</h1>
                                                        <p class="text-gray-800 text-base">{{ $order->delivery ? $order->delivery->address : 'No Delivery Address Found'}}</p>

                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="my-3 space-y-3">
                                                        <h1 class="text-xl font-semibold mb-2 text-gray-900">Order Items ({{$countItem}} Items)</h1>
                                                        @foreach($orderItems as $item)
                                                            <div class="p-3 rounded-xl bg-gray-50 flex items-center justify-between">
                                                <span class="space-y-2">
                                                        <p>{{$item->product_name}}</p>
                                                        <p class="text-gray-500">Quantity: {{$item->quantity}} x ₱{{number_format($item->unit_price, 2)}} </p>
                                                </span>
                                                                <p>₱{{number_format($item->subtotal, 2)}}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>
                                                    <div class="flex items-center justify-between my-2">
                                                        <span class="text-gray-500">Subtotal</span>
                                                        <span >₱{{number_format($totalSubtotal, 2)}}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between my-2">
                                                        <span class="text-gray-500">Delivery Fee</span>
                                                        <span>₱40.00</span>
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="flex items-center justify-between my-2">
                                                        <span>Total</span>
                                                        <span class="text-green-700">₱{{number_format($order->total_amount, 2) }}</span>
                                                    </div>

                                                    <x-ui.button
                                                        class="hover:opacity-75  bg-green-700 text-white transition-all duration-300 w-full rounded-full"
                                                        x-on:click="$modal.close('view-details-{{ $order->id }}')">
                                                        Close
                                                    </x-ui.button>

                                                </div>
                                            </x-ui.modal>
                                        </div>

                                        <x-ui.modal.trigger id="cancel-order">
                                            <x-ui.button color="red"  class="w-full hover:opacity-75 transition-all duration-300 rounded-full" >Cancel Order</x-ui.button>
                                        </x-ui.modal.trigger>

                                        <x-ui.modal
                                            id="cancel-order"
                                            heading="Cancel Order"
                                        >
                                            <p class="pb-2">Are you sure want to Cancel your order?</p>
                                            <div class="flex items-center justify-end space-x-3">
                                                <x-ui.button color="slate"
                                                             class="hover:opacity-75 transition-all duration-300 w-full rounded-full"
                                                             x-on:click="$modal.close('cancel-order')">
                                                    No
                                                </x-ui.button>

                                                <x-ui.button color="red" wire:click="cancelOrder({{$item->id}})" class="w-full hover:opacity-75 transition-all duration-300 rounded-full" >
                                                    Yes, Cancel Order</x-ui.button>

                                            </div>
                                        </x-ui.modal>


                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </x-ui.tab.panel>
                <x-ui.tab.panel name="Shipped">
                    <div class="mt-10 flex flex-col gap-5">
                        @foreach($orders as $order)
                            @if($order->status === 'Shipped')
                                <div wire:key="{{$order->id}}"
                                     class="border-1 border-gray-200 hover:border-green-700 transition-all duration-200 rounded-lg">
                                    <div class="p-5 space-y-5">
                                        <div class="flex items-center justify-between space-x-3">
                                            <div>
                                      <span class="flex gap-4">
                                       <span>
                                      <h2 class="text-xl text-gray-700">{{$order->order_number}}</h2>
                                       <h3 class="text-gray-500 text-sm">{{$order->created_at->format('M d, Y')}}</h3>
                                       </span>
                                      <x-ui.badge pill class="rounded-full mb-5"
                                                  color="shipped">{{$order->status}}</x-ui.badge>
                                   </span>
                                            </div>
                                            <div>
                                                @php
                                                    $countItem = $order->orderItems->pluck('product_name')->count();
                                                    $orderItems = $order->orderItems;
                                                @endphp
                                                <p class="text-gray-500 text-sm mb-2">{{$countItem}} items</p>
                                                <p class="text-gray-900 text-base"><span class="text-sm text-gray-500">Total: </span>₱{{$order->total_amount}}
                                                </p> {{--Total--}}
                                            </div>
                                        </div>
                                        <div class="w-full border text-gray-200 my-2"></div>
                                        @foreach($orderItems as $item)
                                            <div class="flex items-center justify-between my-1 p-0">
                                                <p class="text-gray-500 text-sm">{{$item->quantity}}
                                                    x {{$item->product_name}}</p>
                                                <p class="text-gray-700 text-sm ">₱{{$item->subtotal}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex flex-col gap-5 my-3">
                                        {{--View Details--}}
                                        <div class="flex flex-col  gap-5 my-3">
                                            <x-ui.modal.trigger id="view-details-{{ $order->id }}">
                                                <x-ui.button icon="ps:eye" class="w-full rounded-full bg-green-700 text-white hover:opacity-75 transition-all duration-300 ">View
                                                    Details
                                                </x-ui.button>
                                            </x-ui.modal.trigger>

                                            <x-ui.modal
                                                width="xl"
                                                id="view-details-{{ $order->id }}"
                                                heading="Order Details"
                                            >
                                                <div class="">
                                                    <div class="flex items-center justify-between">
                                           <span>
                                                <h1 class="text-gray-500 text-sm">Order Number</h1>
                                            <p class="text-gray-800 text-base">{{$order->order_number}}</p>
                                           </span>
                                                        <span>
                                             <h1 class="text-gray-500 text-sm">Order Date</h1>
                                            <p class="text-gray-800 text-base">{{$order->created_at->format('F j, Y')}}</p>
                                        </span>
                                                    </div>
                                                    <div class="">
                                                        <h1 class="text-gray-500 text-sm">Status</h1>
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
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="my-3">
                                                        <h1 class="text-gray-500 text-sm">Delivery Address</h1>
                                                        <p class="text-gray-800 text-base">{{ $order->delivery ? $order->delivery->address : 'No Delivery Address Found'}}</p>

                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="my-3 space-y-3">
                                                        <h1 class="text-xl font-semibold mb-2 text-gray-900">Order Items ({{$countItem}} Items)</h1>
                                                        @foreach($orderItems as $item)
                                                            <div class="p-3 rounded-xl bg-gray-50 flex items-center justify-between">
                                                <span class="space-y-2">
                                                        <p>{{$item->product_name}}</p>
                                                        <p class="text-gray-500">Quantity: {{$item->quantity}} x ₱{{number_format($item->unit_price, 2)}} </p>
                                                </span>
                                                                <p>₱{{number_format($item->subtotal, 2)}}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>
                                                    <div class="flex items-center justify-between my-2">
                                                        <span class="text-gray-500">Subtotal</span>
                                                        <span >₱{{number_format($totalSubtotal, 2)}}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between my-2">
                                                        <span class="text-gray-500">Delivery Fee</span>
                                                        <span>₱40.00</span>
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="flex items-center justify-between my-2">
                                                        <span>Total</span>
                                                        <span class="text-green-700">₱{{number_format($order->total_amount, 2) }}</span>
                                                    </div>

                                                    <x-ui.button
                                                        class="hover:opacity-75  bg-green-700 text-white transition-all duration-300 w-full rounded-full"
                                                        x-on:click="$modal.close('view-details-{{ $order->id }}')">
                                                        Close
                                                    </x-ui.button>

                                                </div>
                                            </x-ui.modal>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </x-ui.tab.panel>
                <x-ui.tab.panel name="Delivered">
                    <div class="mt-10 flex flex-col gap-5">
                        @foreach($orders as $order)
                            @if($order->status === 'Delivered')
                                <div wire:key="{{$order->id}}"
                                     class="border-1 border-gray-200 hover:border-green-700 transition-all duration-200 rounded-lg">
                                    <div class="p-5 space-y-5">
                                        <div class="flex items-center justify-between space-x-3">
                                            <div>
                                      <span class="flex gap-4">
                                       <span>
                                      <h2 class="text-xl text-gray-700">{{$order->order_number}}</h2>
                                       <h3 class="text-gray-500 text-sm">{{$order->created_at->format('M d, Y')}}</h3>
                                       </span>
                                      <x-ui.badge pill class="rounded-full mb-5"
                                                  color="delivered">{{$order->status}}</x-ui.badge>
                                   </span>
                                            </div>
                                            <div>
                                                @php
                                                    $countItem = $order->orderItems->pluck('product_name')->count();
                                                    $orderItems = $order->orderItems;
                                                @endphp
                                                <p class="text-gray-500 text-sm mb-2">{{$countItem}} items</p>
                                                <p class="text-gray-900 text-base"><span class="text-sm text-gray-500">Total: </span>₱{{$order->total_amount}}
                                                </p> {{--Total--}}
                                            </div>
                                        </div>
                                        <div class="w-full border text-gray-200 my-2"></div>
                                        @foreach($orderItems as $item)
                                            <div class="flex items-center justify-between my-1 p-0">
                                                <p class="text-gray-500 text-sm">{{$item->quantity}}
                                                    x {{$item->product_name}}</p>
                                                <p class="text-gray-700 text-sm ">₱{{$item->subtotal}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex flex-col gap-5 mx-5 my-3">
                                        {{--View Details--}}
                                        <div class="flex flex-col gap-5 my-3">
                                            <x-ui.modal.trigger id="view-details-{{ $order->id }}">
                                                <x-ui.button icon="ps:eye" class="w-full rounded-full bg-green-700 text-white hover:opacity-75 transition-all duration-300 ">View
                                                    Details
                                                </x-ui.button>
                                            </x-ui.modal.trigger>

                                            <x-ui.modal
                                                width="xl"
                                                id="view-details-{{ $order->id }}"
                                                heading="Order Details"
                                            >
                                                <div class="">
                                                    <div class="flex items-center justify-between">
                                           <span>
                                                <h1 class="text-gray-500 text-sm">Order Number</h1>
                                            <p class="text-gray-800 text-base">{{$order->order_number}}</p>
                                           </span>
                                                        <span>
                                             <h1 class="text-gray-500 text-sm">Order Date</h1>
                                            <p class="text-gray-800 text-base">{{$order->created_at->format('F j, Y')}}</p>
                                        </span>
                                                    </div>
                                                    <div class="">
                                                        <h1 class="text-gray-500 text-sm">Status</h1>
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
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="my-3">
                                                        <h1 class="text-gray-500 text-sm">Delivery Address</h1>
                                                        <p class="text-gray-800 text-base">{{ $order->delivery ? $order->delivery->address : 'No Delivery Address Found'}}</p>

                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="my-3 space-y-3">
                                                        <h1 class="text-xl font-semibold mb-2 text-gray-900">Order Items ({{$countItem}} Items)</h1>
                                                        @foreach($orderItems as $item)
                                                            <div class="p-3 rounded-xl bg-gray-50 flex items-center justify-between">
                                                <span class="space-y-2">
                                                        <p>{{$item->product_name}}</p>
                                                        <p class="text-gray-500">Quantity: {{$item->quantity}} x ₱{{number_format($item->unit_price, 2)}} </p>
                                                </span>
                                                                <p>₱{{number_format($item->subtotal, 2)}}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>
                                                    <div class="flex items-center justify-between my-2">
                                                        <span class="text-gray-500">Subtotal</span>
                                                        <span >₱{{number_format($totalSubtotal, 2)}}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between my-2">
                                                        <span class="text-gray-500">Delivery Fee</span>
                                                        <span>₱40.00</span>
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="flex items-center justify-between my-2">
                                                        <span>Total</span>
                                                        <span class="text-green-700">₱{{number_format(($order->total_amount + 40), 2) }}</span>
                                                    </div>

                                                    <x-ui.button
                                                        class="hover:opacity-75  bg-green-700 text-white transition-all duration-300 w-full rounded-full"
                                                        x-on:click="$modal.close('view-details-{{ $order->id }}')">
                                                        Close
                                                    </x-ui.button>

                                                </div>
                                            </x-ui.modal>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </x-ui.tab.panel>
                <x-ui.tab.panel name="Cancelled">
                    <div class="mt-10 flex flex-col gap-5">
                        @foreach($orders as $order)
                            @if($order->status === 'Cancelled')
                                <div wire:key="{{$order->id}}"
                                     class="border-1 border-gray-200 hover:border-green-700 transition-all duration-200 rounded-lg">
                                    <div class="p-5 space-y-5">
                                        <div class="flex items-center justify-between space-x-3">
                                            <div>
                                      <span class="flex gap-4">
                                       <span>
                                      <h2 class="text-xl text-gray-700">{{$order->order_number}}</h2>
                                       <h3 class="text-gray-500 text-sm">{{$order->created_at->format('M d, Y')}}</h3>
                                       </span>
                                      <x-ui.badge pill class="rounded-full mb-5"
                                                  color="cancelled">{{$order->status}}</x-ui.badge>
                                   </span>
                                            </div>
                                            <div>
                                                @php
                                                    $countItem = $order->orderItems->pluck('product_name')->count();
                                                    $orderItems = $order->orderItems;
                                                @endphp
                                                <p class="text-gray-500 text-sm mb-2">{{$countItem}} items</p>
                                                <p class="text-gray-900 text-base"><span class="text-sm text-gray-500">Total: </span>₱{{$order->total_amount}}
                                                </p> {{--Total--}}
                                            </div>
                                        </div>
                                        <div class="w-full border text-gray-200 my-2"></div>
                                        @foreach($orderItems as $item)
                                            <div class="flex items-center justify-between my-1 p-0">
                                                <p class="text-gray-500 text-sm">{{$item->quantity}}
                                                    x {{$item->product_name}}</p>
                                                <p class="text-gray-700 text-sm ">₱{{$item->subtotal}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex flex-col gap-5 mx-5 my-3">
                                        {{--View Details--}}
                                        <div class="flex flex-col gap-5 my-3">
                                            <x-ui.modal.trigger id="view-details-{{ $order->id }}">
                                                <x-ui.button icon="ps:eye" class="w-full rounded-full bg-green-700 text-white hover:opacity-75 transition-all duration-300 ">View
                                                    Details
                                                </x-ui.button>
                                            </x-ui.modal.trigger>

                                            <x-ui.modal
                                                width="xl"
                                                id="view-details-{{ $order->id }}"
                                                heading="Order Details"
                                            >
                                                <div class="">
                                                    <div class="flex items-center justify-between">
                                           <span>
                                                <h1 class="text-gray-500 text-sm">Order Number</h1>
                                            <p class="text-gray-800 text-base">{{$order->order_number}}</p>
                                           </span>
                                                        <span>
                                             <h1 class="text-gray-500 text-sm">Order Date</h1>
                                            <p class="text-gray-800 text-base">{{$order->created_at->format('F j, Y')}}</p>
                                        </span>
                                                    </div>
                                                    <div class="">
                                                        <h1 class="text-gray-500 text-sm">Status</h1>
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
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="my-3">
                                                        <h1 class="text-gray-500 text-sm">Delivery Address</h1>
                                                        <p class="text-gray-800 text-base">{{ $order->delivery ? $order->delivery->address : 'No Delivery Address Found'}}</p>

                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="my-3 space-y-3">
                                                        <h1 class="text-xl font-semibold mb-2 text-gray-900">Order Items ({{$countItem}} Items)</h1>
                                                        @foreach($orderItems as $item)
                                                            <div class="p-3 rounded-xl bg-gray-50 flex items-center justify-between">
                                                <span class="space-y-2">
                                                        <p>{{$item->product_name}}</p>
                                                        <p class="text-gray-500">Quantity: {{$item->quantity}} x ₱{{number_format($item->unit_price, 2)}} </p>
                                                </span>
                                                                <p>₱{{number_format($item->subtotal, 2)}}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>
                                                    <div class="flex items-center justify-between my-2">
                                                        <span class="text-gray-500">Subtotal</span>
                                                        <span >₱{{number_format($totalSubtotal, 2)}}</span>
                                                    </div>
                                                    <div class="flex items-center justify-between my-2">
                                                        <span class="text-gray-500">Delivery Fee</span>
                                                        <span>₱40.00</span>
                                                    </div>

                                                    <div class="w-full border border-gray-200 my-2"></div>

                                                    <div class="flex items-center justify-between my-2">
                                                        <span>Total</span>
                                                        <span class="text-green-700">₱{{number_format($order->total_amount, 2) }}</span>
                                                    </div>

                                                    <x-ui.button
                                                        class="hover:opacity-75  bg-green-700 text-white transition-all duration-300 w-full rounded-full"
                                                        x-on:click="$modal.close('view-details-{{ $order->id }}')">
                                                        Close
                                                    </x-ui.button>

                                                </div>
                                            </x-ui.modal>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </x-ui.tab.panel>
            @else
                <h1 class="text-xl italic font-semibold text-center">NO ORDER HISTORY FOUND</h1>
            @endif

        </x-ui.tabs>

    </div>
</div>
