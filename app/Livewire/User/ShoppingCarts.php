<?php

namespace App\Livewire\User;

use App\Contracts\CartServiceInterface;
use App\Livewire\Concerns\HasToast;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ShoppingCarts extends Component
{
    use HasToast;

    public $cart = [];


    protected CartServiceInterface $cartService;

    public function boot(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }


    public function mount()
    {
        return $this->cart = $this->cartService->getCart();
    }

    public function increaseQty($productId): void
    {
        $this->cart[$productId]['quantity']++;
        $this->cart[$productId]['subtotal'] = $this->cart[$productId]['price'] * $this->cart[$productId]['quantity'];
        session()->put('cart', $this->cart);
    }

    public function decreaseQty($productId): void
    {
        if ($this->cart[$productId]['quantity'] > 1 ) {
            $this->cart[$productId]['quantity']--;
            $this->cart[$productId]['subtotal'] = $this->cart[$productId]['price'] * $this->cart[$productId]['quantity'];
        }
        session()->put('cart', $this->cart);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[On('updatedCart')]
    public function refresh(): array
    {
        return $this->cart = session()->get('cart', []);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeCart($productId): void
    {
        $this->cartService->remove($productId);
        $this->successRemoveCart('Product item successfully remove');
        $this->refresh();
    }

    public function render(): View
    {
        $total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('livewire.user.shopping-carts', [
            'total' => $total,
            'cart' => $this->cart,
        ]);
    }
}
