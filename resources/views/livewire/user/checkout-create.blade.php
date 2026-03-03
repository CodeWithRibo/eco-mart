<div>
    <form wire:submit.prevent="save()" action="" method="POST">
      {{--Adddress Selector--}}
        @livewire('user.create-address-selector')
        <div class="p-5">
            <!-- Invalid state -->
            <x-ui.field>
                <x-ui.label>Payment Method</x-ui.label>
                <x-ui.select
                    placeholder="Select a payment method"
                    icon="exclamation-circle"
                    wire:model="payment_method">
                    <x-ui.select.option value="Cash on Delivery">Cash On Delivery</x-ui.select.option>
                    <x-ui.select.option value="Bank">Bank</x-ui.select.option>
                    <x-ui.select.option value="Wallet">Wallet</x-ui.select.option>
                </x-ui.select>
                <x-ui.error name="payment_method"/>
            </x-ui.field>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-5">
         {{--Version 1.0--}}
         {{--Add Address--}}
            @livewire('user.address-selector')
            {{--Order Summary--}}
            <div class="col-span-2 lg:col-span-1 sm:mt-20 lg:mt-0">
                <div class="bg-white rounded-lg p-4 col-span-2 lg:col-span-1">
                    <h1 class="text-gray-900 mb-6 text-xl font-semibold">Order Summary</h1>
                    <span class="space-y-3">
                        @php
                            $cart = session('cart', []);
                            $grantTotal = collect($cart)->sum('subtotal');
                            $total = 0;
                        @endphp
                        @foreach($cart as $item)
                            <div class="flex items-center justify-between text-gray-500">
                        <span>{{$item['product_name']}} x{{$item['quantity']}}</span>
                        <span>₱{{$item['subtotal']}}</span>
                    </div>
                            @php
                                $total = number_format($grantTotal + $deliveryFee, 2);
                            @endphp
                        @endforeach
                            <div class="w-full border border-gray-100 my-5"></div>
                            <div class="flex items-center justify-between text-gray-500 ">
                                   <span>Subtotal</span>
                                 <span>₱{{number_format($grantTotal, 2)}}</span>
                         </div>

                    <div class="flex items-center justify-between text-gray-500 ">
                        <span>Delivery Fee</span>
                        <span>₱{{$deliveryFee}}</span>
                    </div>
            </span>

                    <div class="w-full border border-gray-100 my-5"></div>

                    <div class="flex items-center justify-between text-gray-500 mb-3">
                        <span>Total</span>
                        <span class="text-[#2E7D32] text-xl">₱{{$total}}</span>
                    </div>

                    <x-ui.button
                        type="primary"
                        icon="ps:check"
                        class="w-full  bg-green-700 text-white py-3.5 rounded-xl hover:bg-[#66BB6A] transition-colors cursor-pointer">
                        Place Order
                    </x-ui.button>

                </div>
            </div>
        </div>
    </form>


</div>
