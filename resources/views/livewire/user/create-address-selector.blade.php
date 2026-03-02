<div>
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
                <form wire:submit="save" method="post">
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
                            <x-ui.button  type="primary" color="emerald" class="w-full border-0 cursor-pointer hover:opacity-80 transition-all duration-300">Submit</x-ui.button>
                        </div>
                    </x-ui.fieldset>
                </form>
            </div>
        </x-ui.modal>
    </div>
</div>
