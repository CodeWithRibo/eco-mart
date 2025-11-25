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
                    <x-ui.select.option value="Bakery">Bakery</x-ui.select.option>
                    <x-ui.select.option value="Beverage">Beverage</x-ui.select.option>
                    <x-ui.select.option value="Dairy & Eggs">Dairy & Eggs</x-ui.select.option>

                </x-ui.select>
                <x-ui.error name="category" />
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Unit</x-ui.label>
                <x-ui.select
                    wire:model.live.debounce.300ms="unit"
                    placeholder="Choose option..."
                    icon="exclamation-circle">
                    <x-ui.select.option value="kg">Kilogram</x-ui.select.option>
                    <x-ui.select.option value="cup">Cup</x-ui.select.option>
                    <x-ui.select.option value="Pack">Pack</x-ui.select.option>
                </x-ui.select>
                <x-ui.error name="unit" />
            </x-ui.field>

            <x-ui.field required>
                <x-ui.label>Label</x-ui.label>
                <x-ui.select
                    wire:model.live.debounce.300ms="label"
                    placeholder="Choose option..."
                    icon="exclamation-circle">
                    <x-ui.select.option value="organic">Organic</x-ui.select.option>
                    <x-ui.select.option value="natural">Natural</x-ui.select.option>
                    <x-ui.select.option value="eco-friendly">Eco Friendly</x-ui.select.option>
                </x-ui.select>
                <x-ui.error name="label" />
            </x-ui.field>


            <x-ui.field required>
                <x-ui.label>Product Image</x-ui.label>
                <input type="file" wire:model="product_image" class="file-input file-input-sm" />
                @error('product_image') <span class="error">{{ $message }}</span> @enderror
            </x-ui.field>

            <x-primary-button>Submit</x-primary-button>
        </x-ui.fieldset>
    </form>
</div>
