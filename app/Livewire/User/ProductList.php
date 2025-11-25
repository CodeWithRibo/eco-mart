<?php

namespace App\Livewire\User;

use App\Contracts\CartServiceInterface;
use App\Livewire\Concerns\HasToast;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Spatie\QueryBuilder\QueryBuilder;

class ProductList extends Component
{
    use HasToast;
    use WithPagination;

    #[Url]
    public ?string $search = '';

    public $sort = 'created_at';
    public $sortDirection = 'ASC';
    #[Url]
    public $category_filter = 'All Categories';
    #[Url]
    public $price_filter = 'All Price';

    #[Url]
    public $special_filters = 'all';

    protected CartServiceInterface $cartService;

    public function boot(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

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


    public function addToCart($productId): void
    {
        $this->cartService->add($productId);
        $this->addedCart('Added Cart Successfully');
        $this->dispatch('updatedCart');
    }

    public function render(): View
    {
        $sortColumn = $this->sortDirection === 'DESC' ? "-$this->sort" : $this->sort;

        $query = QueryBuilder::for(Product::class)
            ->search(trim($this->search))
            ->allowedSorts(['category', 'price'])
            ->defaultSort($sortColumn);

        if ($this->category_filter != 'All Categories')
            $query->where('category', $this->category_filter);

        if ($this->special_filters != 'all') {
            $query->where('label', $this->special_filters);
        }

        if ($this->price_filter != 'All Price') {
            switch ($this->price_filter) {
                case 'under_100':
                    $query->where('price', '<', 100);
                    break;

                case '100_200':
                    $query->whereBetween('price', [100, 200]);
                    break;

                case '300_500':
                    $query->whereBetween('price', [300, 500]);
                    break;
            }
        }

        $products = $query->paginate(10);

        return view('livewire.user.product-list', compact('products'));
    }
}
