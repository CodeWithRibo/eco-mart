<?php

namespace App\Services;

use App\Contracts\CartServiceInterface;
use App\Models\Product;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartService implements CartServiceInterface
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function add(int $productId): void
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $cart[$productId]['quantity'];
        } else {
            $product = Product::findOrFail($productId);
            $cart[$productId] = [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'product_image' => $product->product_image,
                'price' => $product->price,
                'delivery_fee' => 40,
                'quantity' => 1,
                'subtotal' => $product->price,
            ];
        }

        session()->put('cart', $cart);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function remove(int $productId): void
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getCart(): array
    {
        return session()->get('cart', []);
    }
}
