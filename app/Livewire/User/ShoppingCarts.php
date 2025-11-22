<?php

namespace App\Livewire\User;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ShoppingCarts extends Component
{
    public $cart = [];


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount(): array
    {
        return $this->cart = session()->get('cart', []);
    }

    public function increaseQty($productId): void
    {
        $this->cart[$productId]['quantity']++;
        session()->put('cart', $this->cart);
    }

    public function decreaseQty($productId): void
    {
        if ($this->cart[$productId]['quantity'] > 1 ) {
            $this->cart[$productId]['quantity']--;
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
        $cart = session()->get('cart', []);

        unset($cart[$productId]);
        session()->put('cart', $cart);
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
