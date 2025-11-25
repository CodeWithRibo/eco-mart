<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class OrderHistory extends Component
{

    public function cancelOrder($id)
    {
        $orderItem = OrderItem::with('order')->findOrFail($id);
        $order = $orderItem->order();

        $order->update([
            'status' => 'Cancelled',
        ]);

        return redirect()->route('order-history');
    }

    public function render()
    {
        $orders = Order::with(['orderItems', 'delivery'])->orderBy('created_at', 'DESC')->get();
        return view('livewire.user.order-history', compact('orders'));
    }
}
