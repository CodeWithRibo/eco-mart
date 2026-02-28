<div>
    <form wire:submit.prevent="save()" action="" method="POST">
        <div class="">
            <x-ui.modal.trigger id="add-address-modal">
                <x-ui.button icon="ps:plus"  color="emerald" class="border-0 cursor-pointer hover:opacity-80 transition-all duration-300">Add a new address</x-ui.button>
            </x-ui.modal.trigger>
            <x-ui.modal
                id="add-address-modal"
                heading="Address Information"
                width="3xl"
            >
                <div class="bg-white shadow rounded-lg p-5 col-span-2">
                    <x-ui.fieldset label="" class="space-y-2">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-ui.field required>
                                <x-ui.label>First Name</x-ui.label>
                                <x-ui.input wire:model="first_name" placeholder="Juan"/>
                                <x-ui.error name="first_name"/>
                            </x-ui.field>

                            <x-ui.field required>
                                <x-ui.label>Last Name</x-ui.label>
                                <x-ui.input wire:model="last_name" placeholder="Dela Cruz"/>
                                <x-ui.error name="last_name"/>
                            </x-ui.field>
                        </div>

                        <x-ui.field>
                            <x-ui.label>Email</x-ui.label>
                            <x-ui.input wire:model="email" type="email" placeholder="juan@example.com"/>
                            <x-ui.error name="email"/>
                        </x-ui.field>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-ui.field>
                                <x-ui.label>Phone</x-ui.label>
                                <x-ui.input wire:model="phone_number" type="tel"
                                            placeholder="09933404219"/>
                                <x-ui.error name="phone_number"/>
                            </x-ui.field>

                            <x-ui.field>
                                <x-ui.label>Address</x-ui.label>
                                <x-ui.input wire:model="address"
                                            placeholder="Blk5 Lot10 Bagong Sibol St."/>
                                <x-ui.error name="address"/>
                            </x-ui.field>
                        </div>

                        <div class="grid grid-cols-2 gap-5">
                            <x-ui.field class="w-full">
                                <x-ui.label>Region</x-ui.label>
                                <select wire:model="region" id="region" class="w-full rounded-lg py-[6.7px] border-1 border-gray-200">
                                    <option selected disabled  value="Select Region">Select Region</option>
                                </select>
                                <input type="hidden" name="region_text" id="region-text" required>
                                <x-ui.error name="region"/>
                            </x-ui.field>

                            <x-ui.field>
                                <x-ui.label>Province</x-ui.label>
                                <select wire:model="province"  id="province" class="w-full rounded-lg py-[6.7px] border-1 border-gray-200">
                                    <option selected disabled  value="Select Province">Select Province</option>
                                </select>
                                <input type="hidden" name="province_text" id="province-text" required>
                                <x-ui.error name="province"/>
                            </x-ui.field>

                            <x-ui.field>
                                <x-ui.label>City</x-ui.label>
                                <select wire:model="city" id="city" class="w-full rounded-lg py-[6.7px] border-1 border-gray-200">
                                    <option selected disabled  value="Select City">Select City</option>
                                </select>
                                <input type="hidden" name="city_text" id="city-text" required>
                                <x-ui.error name="city"/>
                            </x-ui.field>

                            <x-ui.field>
                                <x-ui.label>Barangay</x-ui.label>
                                <select wire:model="barangay" id="barangay" class="w-full rounded-lg py-[6.7px] border-1 border-gray-200">
                                    <option selected disabled  value="Select Barangay">Select Barangay</option>
                                </select>
                                <input type="hidden" name="barangay_text" id="barangay-text" required>
                                <x-ui.error name="barangay"/>
                            </x-ui.field>
                        </div>
                      <div class="flex justify-center mt-5">
                          <x-ui.button  color="emerald" class="w-full border-0 cursor-pointer hover:opacity-80 transition-all duration-300">Submit</x-ui.button>
                      </div>
                    </x-ui.fieldset>
                </div>
            </x-ui.modal>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-5">
         {{--Version 1.0--}}
         {{--Add Address--}}
            <div class="bg-white rounded-lg h-32 col-span-2 sm:mb-32">
                  <div class="flex flex-col gap-5">
                      <div class="flex items-center justify-between shadow rounded-lg p-4">
                              <div class="flex items-center gap-5">
                                  <input type="radio" name="" id="">
                                <div>
                                    <span class="text-gray-500 text-[13px]" >Carl John Sto Tomas</span> <br>
                                    <strong class="text-[13px]">09933404417</strong><br>
                                    <span class="text-gray-500 text-[13px]">Blk5 Lot1 Bagong Sibol St City Of Malabon,</span><br>
                                    <span class="text-[13px] text-gray-500"> Catmon National Capital Region (NCR), Ncr,Third District</span>
                                </div>
                              </div>
                          <div>
                              <x-ui.button variant="outline" icon="ps:pencil" color="slate" size="sm">Edit</x-ui.button>
                              <x-ui.button variant="outline"  icon="ps:trash" color="red" size="sm">Delete</x-ui.button>
                          </div>
                      </div>
                      <div class="flex items-center justify-between shadow rounded-lg p-4">
                              <div class="flex items-center gap-5">
                                  <input type="radio" name="" id="">
                                <div>
                                    <span class="text-gray-500 text-[13px]" >Carl John Sto Tomas</span> <br>
                                    <strong class="text-[13px]">09933404417</strong><br>
                                    <span class="text-gray-500 text-[13px]">Blk5 Lot1 Bagong Sibol St City Of Malabon,</span><br>
                                    <span class="text-[13px] text-gray-500"> Catmon National Capital Region (NCR), Ncr,Third District</span>
                                </div>
                              </div>
                          <div>
                              <x-ui.button variant="outline" icon="ps:pencil" color="slate" size="sm">Edit</x-ui.button>
                              <x-ui.button variant="outline"  icon="ps:trash" color="red" size="sm">Delete</x-ui.button>
                          </div>
                      </div>
                  </div>
            </div>

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
