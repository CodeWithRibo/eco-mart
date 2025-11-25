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
            // Update parent order status to reflect movement
            if ($delivery->order) {
                $delivery->order->update(['status' => 'Shipped']); // or 'Out for Delivery'
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
            // Update parent order status to completed
            if ($delivery->order) {
                $delivery->order->update(['status' => 'Delivered']);
            }
        }
    }

    public function render()
    {
        $riderId = Auth::id();

        // 1. Get Active Deliveries (Assigned or In Progress)
        $activeDeliveries = Delivery::with(['order.user', 'order.orderItems'])
            ->where('rider_id', $riderId)
            ->whereIn('status', ['Assigned', 'Picked Up'])
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Calculate Stats for Today
        $completedToday = Delivery::where('rider_id', $riderId)
            ->where('status', 'Delivered')
            ->whereDate('updated_at', today())
            ->count();

        $activeCount = $activeDeliveries->count();

        // 3. Earnings Logic (Assuming sum of order totals delivered today, or replace with commission logic)
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
