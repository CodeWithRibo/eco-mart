<?php

namespace App\Livewire\User;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Container\BindingResolutionException;
use Livewire\Component;

class OrderSuccessful extends Component
{

    /**
     * @throws BindingResolutionException
     */
    public function downloadReceipt()
    {
        /*TEMPORARY DATA*/
        $data = ['message' => 'testing'];
        $pdf = Pdf::loadView('user.invoice', $data);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'invoice.pdf');
    }

    public function render()
    {

        $latestOrderId = OrderItem::query()->where('user_id', auth()->id())
            ->latest()
            ->value('order_id');

        $deliveryAddress = Delivery::query()
            ->select([
            'first_name',
            'last_name',
            'phone_number',
            'address',
            'region',
            'province',
            'city',
            'barangay',
        ])
            ->where('user_id', auth()->id())
            ->where('order_id', $latestOrderId)
            ->get();

        $orders = Order::query()->select([
            'total_amount',
            'created_at',
            'order_number'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->first();

        $orderItems = OrderItem::query()->select([
            'product_name',
            'unit_price',
            'quantity',
            'subtotal',
        ])
            ->where('user_id', auth()->id())
            ->where('order_id', $latestOrderId)
            ->get();


        return view('livewire.user.order-successful', compact([
            'deliveryAddress',
            'orderItems',
            'orders'
        ]));
    }
}
