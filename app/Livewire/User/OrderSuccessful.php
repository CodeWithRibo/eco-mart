<?php

namespace App\Livewire\User;

use App\Models\Delivery;
use Livewire\Component;

class OrderSuccessful extends Component
{
    public function render()
    {
        /*Temporary fetch data*/
        $addresses = Delivery::query()->select('region', 'province', 'city', 'barangay')->get();
        return view('livewire.user.order-successful', compact('addresses'));
    }
}
