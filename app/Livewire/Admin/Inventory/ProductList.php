<?php

namespace App\Livewire\Admin\Inventory;

use App\Models\Product;
use App\Services\InventoryService;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    #[Url]
    public ?string $search = '';

    public $sort = 'created_at';
    public $sortDirection = 'ASC';
    #[Url]
    public $category_filter = 'All Categories';


    public function sortBy($field): string
    {
        return $this->sort === $field

            ? $this->sortDirection = $this->sortDirection === 'ASC' ? 'DESC' : 'ASC'
            : $this->sort = $field;
    }

    public function updatedCategoryFilter(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function delete($id): void
    {
        $this->dispatch('product-delete', id: $id);
    }

    public function edit($id): void
    {
        $this->dispatch('product-edit', id: $id);
    }

    public function render(): View
    {

        $sortColumn = $this->sortDirection === 'DESC' ? "-$this->sort" : $this->sort;

        $products = InventoryService::getProduct($this->search, $sortColumn, $this->category_filter);

        $getProductCount = Product::select('stock')->get();
        $countProducts = $getProductCount->count();
        $countInStock = $getProductCount->where('stock', '>', 10)->count();
        $countLowStock = $getProductCount->where('stock', '>', 0)->where('stock', '<=', 10)->count();
        $countOutOfStock = $getProductCount->where('stock', '<=', '0')->count();

        return view('livewire.admin.inventory.product-list', compact(['products', 'countProducts', 'countInStock', 'countLowStock', 'countOutOfStock']));
    }
}
