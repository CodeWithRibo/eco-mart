<?php

namespace App\Livewire\Admin\Inventory;

use App\Services\InventoryService;
use App\Services\NotificationService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{

    use WithFileUploads;

    public $product_name;
    public $product_image;
    public $category;
    public $price;
    public $stock;
    public $productId;

    #[On('product-edit')]
    public function loadProduct($id): void
    {
        $this->productId = InventoryService::editProduct($id);

        $this->fill($this->productId->only([
            'product_name',
            'product_image',
            'category',
            'price',
            'stock',
        ]));

//        $this->authorize('update', $this->category);
    }


    public function save()
    {
        $rules = [
            'product_name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ];

        if ($this->product_image instanceof  TemporaryUploadedFile) {
            $rules['product_image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validated = $this->validate($rules);

        if ($this->product_image instanceof TemporaryUploadedFile) {
            $imageName = time() . '.' . $this->product_image->getClientOriginalExtension();
            $uploadPath = $this->product_image->storeAs('photos', $imageName, 'public');

            unset($validated['product_image']);
            $validated['product_image'] = $uploadPath;
        } else {
            $validated['product_image'] = $this->productId->product_image;
        }

        $this->productId->fill($validated);

        if ($this->productId->isDirty()) {
            $editProduct = $this->productId->save();
            if ($editProduct) NotificationService::notifEditSuccessProduct();

        } else {
            NotificationService::notifNoChangeDetected();
        }

        return redirect()->route('admin.inventories');
    }

    public function render()
    {
        return view('livewire.admin.inventory.product-edit');
    }
}
