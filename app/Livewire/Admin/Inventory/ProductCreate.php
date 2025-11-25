<?php

namespace App\Livewire\Admin\Inventory;

use App\Services\InventoryService;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;


class ProductCreate extends Component
{
    use WithFileUploads;

    public $product_name;
    public $product_image;
    public $category;
    public $price;
    public $stock;
    public $unit;
    public $label;

    protected function rules(): array
    {
        return [
            'product_name' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4000',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'unit' => 'required',
            'label' => 'required'
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function save(): void
    {
        $validated = $this->validate();

        $imageName = time() . '.' . $this->product_image->getClientOriginalExtension();
        $uploadPath = $this->product_image->storeAs('photos', $imageName, 'public');

        unset($validated['product_image']);

        InventoryService::setProduct($validated,$uploadPath);
    }

    public function render(): View
    {
        return view('livewire.admin.inventory.product-create');
    }
}
