<div>
    {{--Carts--}}
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-10">
        <div class="flex flex-col gap-5 col-span-2">
            @foreach($cart as $index)
                <div class="bg-white rounded-lg shadow w-full p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-5">
                            <div class="w-24 h-24 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{asset('storage/'. $index['product_image'])}}" class="w-full h-full object-cover object-center" alt="tomatoes">
                            </div>
                            <div>
                                <div class="space-y-2">
                                    <h2 class="text-xl text-gray-700">{{$index['product_name']}}</h2>
                                    <p class="text-gray-500 text-sm">₱{{$index['price']}} / kg</p>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2 bg-gray-100 rounded-full p-1 w-[70%]">
                                        <button
                                            wire:click="decreaseQty({{$index['id']}})"
                                            class="w-8 h-8 rounded-full bg-white text-gray-900 hover:bg-[#F5E6C8] flex items-center justify-center transition-colors">
                                            -
                                        </button>
                                        <span class="w-8 text-center text-gray-900">{{$index['quantity'] ?? 0}}</span>
                                        <button
                                            wire:click="increaseQty({{$index['id']}})"
                                            class="w-8 h-8 rounded-full bg-white text-gray-900 hover:bg-[#F5E6C8] flex items-center justify-center transition-colors">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <p class="text-[#2E7D32] text-right">₱{{$index['subtotal'] ?? $index['price']}}</p>
                            <x-ui.icon
                                wire:click="removeCart({{$index['id']}})"
                                name="ps:trash" class="size-5 fill-red-500"/>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        {{--Order Summary--}}
        <div class="bg-white rounded-lg p-4 col-span-2 lg:col-span-1">
            <h1 class="text-gray-900 mb-6 text-xl font-semibold">Order Summary</h1>
            <span class="space-y-3">
                    <div class="flex items-center justify-between text-gray-500">
                        <span>Subtotal</span>
                        <span>₱{{$total ?? 0 }}</span>
                    </div>
                    @php
                        $deliveryFee = 10;
                        $totalDeliveryFee = number_format(($total / $deliveryFee), 2);

                        $allTotal = $total + $totalDeliveryFee
                    @endphp
                    <div class="flex items-center justify-between text-gray-500 ">
                        <span>Delivery Fee</span>
                        <span>₱{{$totalDeliveryFee}}</span>
                    </div>
            </span>

            <div class="w-full border border-gray-100 my-5"></div>

            <div class="flex items-center justify-between text-gray-500 mb-3">
                <span>Total</span>
                <span class="text-[#2E7D32] text-xl">₱{{$allTotal}}</span>
            </div>

                <x-ui.button class="w-full bg-green-700 text-white py-3.5 rounded-xl hover:bg-[#66BB6A] transition-colors">Proceed to Checkout</x-ui.button>

        </div>
    </div>
</div>
