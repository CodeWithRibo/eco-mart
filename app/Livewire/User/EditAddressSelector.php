<?php

namespace App\Livewire\User;

use App\Livewire\Concerns\HasToast;
use App\Models\Address;
use Livewire\Attributes\On;
use Livewire\Component;

class EditAddressSelector extends Component
{
    use HasToast;

    /*Address Information*/
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $address;
    public $region;
    public $province;
    public $city;
    public $barangay;
    public $addressSelector;

    protected function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => ['required', 'max:11', 'regex:/^[0-9]+$/'],
            'address' => 'required',
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
        ];
    }

    #[On('edit-address')]
    public function loadEditAddressSelector($id): void
    {
        $this->addressSelector = Address::query()->findOrFail($id);

        $this->fill($this->addressSelector->only([
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'address',
            'region',
            'province',
            'city',
            'barangay'
        ]));
    }

    public function updateAddressSelector()
    {
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'region' => $this->region,
            'province' => $this->province,
            'city' => $this->city,
            'barangay' => $this->barangay,
        ];

        $this->addressSelector->fill($data);

        if ($this->addressSelector->isDirty()) {
            $this->addressSelector->save($this->validate());
            $this->success('Address Updated Successfully');
        } else {
            $this->info('No change Detected');
        }
        return redirect()->route('shopping-carts.checkout');
    }

    public function render()
    {
        return view('livewire.user.edit-address-selector');
    }
}
