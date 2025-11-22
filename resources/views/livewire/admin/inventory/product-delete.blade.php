<div>
    <form wire:submit.prevent="delete()" method="post">
        <p class="pb-2">Are you sure want to delete this product?</p>
        <div class="flex items-center justify-end space-x-3">
            <x-ui.button color="slate"
                         class="hover:opacity-75 transition-all duration-300"
                         x-on:click="$modal.close('delete-product')">
                No
            </x-ui.button>
            <x-ui.button color="red" type="submit" class="hover:opacity-75 transition-all duration-300" >Yes, Delete it!</x-ui.button>
        </div>
    </form>
</div>
