<?php

namespace App\Services;

use App\Contracts\CartServiceInterface;
use App\Models\Order;
use App\Models\OrderItem;

class DatabaseCartService implements CartServiceInterface
{

    public function add(int $productId): void
    {
        $order = Order::firstOrCreate(['user_id' => auth()->id()]);
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => 1,
        ]);
    }

    public function getCart(): array
    {
        $order = Order::where('user_id', auth()->id())->latest()->first();
        return $order ? $order->items->toArray() : [];
    }

    public function remove(int $productId): void
    {
        throw new \RuntimeException("Remove not allowed in the Cart.");
    }
}
