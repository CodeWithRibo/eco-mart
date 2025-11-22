<?php

namespace App\Livewire\User;

use App\Livewire\Concerns\HasToast;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductList extends Component
{
    use HasToast;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addToCart($productId): void
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $cart[$productId]['quantity'];

            $this->existingAddedCart('Item already in cart. Quantity updated');

        } else {
            $product = Product::findOrFail($productId);
            $cart[$productId] = [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'product_image' => $product->product_image,
                'price' => $product->price,
                'quantity' => 1,
            ];
            $this->addedCart('Added to cart!');
        }

        session()->put('cart', $cart);
        $this->dispatch('updatedCart');
    }

    public function render(): View
    {
        $products = Product::all();
        return view('livewire.user.product-list', compact('products'));
    }
}
