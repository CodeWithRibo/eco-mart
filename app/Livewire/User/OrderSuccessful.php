<?php

namespace App\Livewire\User;

use App\Services\OrderDetailsService;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class OrderSuccessful extends Component
{
    public $latestId;
    public $currentUser;
    public function mount(): void
    {
        $this->latestId = OrderDetailsService::latestOrderId(auth()->id());
        $this->currentUser = auth()->id();
    }

    public function downloadReceipt()
    {
        $data = [
            'deliveryAddress' => OrderDetailsService::getDeliveryAddress($this->currentUser),
            'orderItems' => OrderDetailsService::getOrderItemDetails($this->currentUser),
            'order' => OrderDetailsService::getOrderDetails($this->currentUser),
            'subtotal' => OrderDetailsService::getOrderItemSubTotal($this->currentUser)
        ];

        $pdf = Pdf::loadView('user.invoice', $data);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'invoice.pdf');
    }

    public function render()
    {

        return view('livewire.user.order-successful',
        [
            'deliveryAddress' => OrderDetailsService::getDeliveryAddress($this->currentUser),
            'orderItems' => OrderDetailsService::getOrderItemDetails($this->currentUser),
            'orders' => OrderDetailsService::getOrderDetails($this->currentUser)
         ]);
    }
}
