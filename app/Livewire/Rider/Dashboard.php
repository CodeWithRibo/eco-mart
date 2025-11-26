<?php

namespace App\Livewire\Rider;

use App\Models\Delivery;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function markPickedUp($deliveryId)
    {
        $delivery = Delivery::where('id', $deliveryId)
            ->where('rider_id', Auth::id())
            ->first();

        if ($delivery) {
            $delivery->update(['status' => 'Picked Up']);
            if ($delivery->order) {
                $delivery->order->update(['status' => 'Shipped']);
            }
        }
    }

    public function markDelivered($deliveryId)
    {
        $delivery = Delivery::where('id', $deliveryId)
            ->where('rider_id', Auth::id())
            ->first();

        if ($delivery) {
            $delivery->update(['status' => 'Delivered']);
            if ($delivery->order) {
                $delivery->order->update(['status' => 'Delivered']);
            }
        }
    }

    public function render()
    {
        $riderId = Auth::id();

        $activeDeliveries = Delivery::with(['order.user', 'order.orderItems'])
            ->where('rider_id', $riderId)
            ->whereIn('status', ['Assigned', 'Picked Up'])
            ->orderBy('created_at', 'desc')
            ->get();

        $completedToday = Delivery::where('rider_id', $riderId)
            ->where('status', 'Delivered')
            ->whereDate('updated_at', today())
            ->count();

        $activeCount = $activeDeliveries->count();

        $earningsToday = Delivery::where('rider_id', $riderId)
            ->where('status', 'Delivered')
            ->whereDate('updated_at', today())
            ->get()
            ->sum(function ($delivery) {
                return $delivery->order ? $delivery->order->total_amount : 0;
            });

        return view('livewire.rider.dashboard', [
            'activeDeliveries' => $activeDeliveries,
            'completedToday'   => $completedToday,
            'activeCount'      => $activeCount,
            'earningsToday'    => $earningsToday
        ]);
    }
}
