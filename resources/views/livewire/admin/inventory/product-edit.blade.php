<div>
    <form wire:submit="save()" method="POST" enctype="multipart/form-data">
        <x-ui.fieldset label="Personal Information">
            <x-ui.field required>
                <x-ui.label>Product Name</x-ui.label>
                <x-ui.input wire:model.live.debounce.300ms="product_name" />
                <x-ui.error name="product_name" />
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Price</x-ui.label>
                <x-ui.input type="number" wire:model.live.debounce.300ms="price" required />
                <x-ui.error name="price" />
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Stock</x-ui.label>
                <x-ui.input type="number" wire:model.live.debounce.300ms="stock" required />
                <x-ui.error name="stock" />
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Category</x-ui.label>
                <x-ui.select
                    wire:model.live.debounce.300ms="category"
                    placeholder="Choose option..."
                    icon="exclamation-circle">
                    <x-ui.select.option value="Vegetables">Vegetables</x-ui.select.option>
                    <x-ui.select.option value="Fruits">Fruits</x-ui.select.option>
                    <x-ui.select.option value="Dairy">Dairy</x-ui.select.option>
                    <x-ui.select.option value="Bakery">Bakery</x-ui.select.option>
                    <x-ui.select.option value="Beverage">Beverage</x-ui.select.option>
                </x-ui.select>
                <x-ui.error name="category" />
            </x-ui.field>


            <x-ui.field>
                <x-ui.label>Product Image</x-ui.label>
                <input type="file" wire:model="product_image" class="file-input file-input-sm" />
                @error('product_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </x-ui.field>

            <x-primary-button>Submit</x-primary-button>
        </x-ui.fieldset>
    </form>
</div>
