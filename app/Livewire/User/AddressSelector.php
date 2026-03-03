<?php

namespace App\Livewire\User;

use App\Models\Address;
use App\Services\OrderDetailsService;
use Livewire\Component;

class AddressSelector extends Component
{
    public $selectedAddress;

    public function updatedSelectedAddress(): void
    {
        $this->dispatch('selected-address', id: $this->selectedAddress);
    }

    public function getEditId($id): void
    {
        $this->dispatch('edit-address', id : $id);
    }

    public function getDeleteId($id): void
    {
        $this->dispatch('delete-address', id: $id);
    }

    public function render()
    {
        $addresses = Address::query()
            ->where('user_id', auth()->id())
            ->select(['id', 'first_name', 'last_name', 'phone_number', 'address', 'region', 'province', 'city', 'barangay'])
            ->limit(2)
            ->get();

        return view('livewire.user.address-selector', compact('addresses'));
    }
}
