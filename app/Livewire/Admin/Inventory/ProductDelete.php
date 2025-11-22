<?php

namespace App\Livewire\Admin\Inventory;

use App\Models\Product;
use App\Services\InventoryService;
use App\Services\NotificationService;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductDelete extends Component
{
    public $product;
    public $productId;

    #[On('product-delete')]
    public function loadProduct($id): void
    {
        $this->productId = $id;
        $this->product = InventoryService::deleteProduct($this->productId);

//        $this->authorize('delete', $this->expense);
//        $this->resetPage();
    }

    public function delete()
    {
        $this->loadProduct($this->productId);
        $isDeleted = $this->product->delete();

        if ($isDeleted)
        {
            NotificationService::notifDeleteProduct();
        }

        return redirect()->route('admin.inventories');
    }

    public function render()
    {
        return view('livewire.admin.inventory.product-delete');
    }
}
