<?php

namespace App\Livewire\User;

use App\Livewire\Concerns\HasToast;
use App\Models\Address;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteAddressSelector extends Component
{

    use HasToast;
    public $addressSelector;

    #[On('delete-address')]
    public function loadDeleteAddressSelector($id): void
    {
        $this->addressSelector = Address::query()
                        ->where('user_id', auth()->id())
                        ->findOrFail($id);
    }

    public function delete()
    {
        if (!empty($this->addressSelector)) {
            $this->addressSelector->delete();
            $this->success('Address Deleted Successfully');
        } else {
            $this->error('Failed to delete');
        }

        return redirect()->route('shopping-carts.checkout');
    }

    public function render()
    {
        return view('livewire.user.delete-address-selector');
    }
}
