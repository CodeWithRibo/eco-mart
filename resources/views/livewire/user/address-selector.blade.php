<div class="bg-white rounded-lg h-32 col-span-2 sm:mb-32">
        <div class="flex flex-col gap-5">
            @foreach ($addresses as $address)
            <div class="flex items-center justify-between shadow rounded-lg p-4" wire:key="{{$address->id}}">
                <div class="flex items-center gap-5">
                    <input type="radio" wire:model.live.debounce.300ms="selectedAddress" value="{{$address->id}}">
                    <div>
                        <span class="text-gray-500 text-[13px]" >{{$address->first_name}} {{$address->last_name}}</span> <br>
                        <strong class="text-[13px]">{{$address->phone_number}}</strong><br>
                        <span class="text-gray-500 text-[13px]">{{$address->address}}, {{$address->city_name}}</span><br>
                        <span class="text-[13px] text-gray-500">  {{$address->region_name}}, {{$address->province_name}}</span>
                    </div>
                </div>
                <div>

                    <x-ui.button variant="outline" icon="ps:pencil" color="slate" size="sm">Edit</x-ui.button>
                    <x-ui.button variant="outline"  icon="ps:trash" color="red" size="sm">Delete</x-ui.button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
