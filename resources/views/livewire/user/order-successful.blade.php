<div class="">
    <div class="p-6 space-y-3 text-center mx-auto max-w-5xl">
        <h1 class="text-4xl text-gray-900 font-semibold text-center">Order Placed Successfully</h1>
        <p class="text-gray-500 text-[15px]">Thank you for your order. We've received your order and will process it shortly.</p>
    </div>
       <fieldset class="bg-white rounded-lg shadow p-6 mx-auto max-w-xl mb-5">
           <div class="grid grid-cols-2 grid-rows-2 gap-4">
                   <div class="flex flex-col space-y-1">
                       <label for="order-number" class="text-gray-500 text-xs">Order Number</label>
                       <span class="text-gray-700 text-[13px]">{{$orders->order_number}}</span>
                   </div>
                   <div class="flex flex-col space-y-1">
                       <label for="order-amount" class="text-gray-500 text-xs">Amount</label>
                       <span class="text-green-600 text-[13px]">₱{{$orders->total_amount}}</span>
                   </div>
                   <div class="flex flex-col space-y-1">
                       <label for="order-date" class="text-gray-500 text-xs">Order Date</label>
                       <span class="text-gray-700 text-[13px]">{{\Carbon\Carbon::parse($orders->created_at)->format('F d, Y')}} </span>
                   </div>

               <div class="flex flex-col space-y-1">
                   <label for="estimated-delivery" class="text-gray-500 text-xs">Estimated Delivery</label>
                   <span class="text-gray-700 text-[13px]">{{\Carbon\Carbon::parse($orders->created_at)->addDays(3)->format('F d, Y')}} </span>
               </div>
           </div>
           <div class="border w-full border-gray-100 my-5"></div>
           <div class="space-y-2">
               <h2 class="text-gray-900 text-lg font-bold">Order Items</h2>
               @foreach($orderItems as $item)
                   <div class="flex flex-row  items-center justify-between  gap-2 ">
                       <span class="text-gray-500 text-[14.5px]">{{$item->product_name}} x{{$item->quantity}}</span>
                       <span class="text-gray-500 text-[14.5px]">₱{{$item->subtotal}}</span>
                   </div>
               @endforeach
           </div>
           <div class="border w-full border-gray-100 mt-5 mb-2"></div>
           <div class="flex flex-row  items-center justify-between gap-2 mb-5 ">
               <span class="text-gray-500 text-[14.5px]">Delivery Fee</span>
               <span class="text-gray-500 text-[14.5px]">₱40</span>
           </div>
               <div class="flex flex-col p-6 bg-[#F5E6C8] rounded-md space-y-1">
                   <span class="text-base font-semibold mb-2">Delivery Information</span>
                   {{--Full Name & P#--}}
                   <span class="text-sm text-gray-600">{{$deliveryAddress->first_name}} {{$deliveryAddress->last_name}} ({{$deliveryAddress->phone_number}}) </span>
                   {{--Street Address--}}
                   <span class="text-sm text-gray-600">{{$deliveryAddress->address}}</span>
                   <span class="text-sm text-gray-600">{{$deliveryAddress->city_name}}, {{$deliveryAddress->barangay_name}}</span> {{--City Barangay--}}
                   <span class="text-sm text-gray-600">{{$deliveryAddress->region_name}}, {{$deliveryAddress->province_name}}</span> {{--Region & Province--}}
               </div>
       </fieldset>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 grid-rows-1 items-center justify-center gap-2  mx-auto max-w-xl w-full">
            <x-ui.button wire:click="downloadReceipt" class="rounded-full cursor-pointer" size="sm" variant="outline" color="emerald" icon="arrow-down-tray">Download Receipt</x-ui.button>
            <x-ui.button class="rounded-full bg-green-700 text-white" size="sm" color="solid" icon="ps:package">
                <a href="{{route('products')}}">Continue Shopping</a>
            </x-ui.button>
        <x-ui.button class="rounded-full border bg-white " size="sm" variant="solid" color="white" icon="ps:house">
            <a href="{{route('dashboard')}}">Back to Home</a>
        </x-ui.button>

    </div>
</div>
