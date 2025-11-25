<?php

namespace App\Livewire\User;

use App\Models\Order;
use Illuminate\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalOrders;
    public $Processing;
    public $delivered;
    public $cancelled;

    public function render(): View
    {
        $this->totalOrders = Order::query()
            ->where('user_id', auth()->id())
            ->pluck('id')
            ->count();

        $this->Processing = Order::query()
            ->where('user_id', auth()->id())
            ->where('status', 'Processing')
            ->count();

        $this->delivered = Order::query()->where('user_id', auth()->id())
            ->where('status', 'Delivered')
            ->count();

        $this->cancelled = Order::query()->where('user_id', auth()->id())
            ->where('status', 'Cancelled')
            ->count();

        $recentOrders = Order::with('orderItems')
            ->orderBy('created_at', 'DESC')
            ->take(2)->get();
        return view('livewire.user.dashboard', [
            'totalOrders' => $this->totalOrders,
            'inProgress' => $this->Processing,
            'delivered' => $this->delivered,
            'recentOrders' => $recentOrders,
            'cancelOrder' => $this->cancelled,
        ]);
    }
}
