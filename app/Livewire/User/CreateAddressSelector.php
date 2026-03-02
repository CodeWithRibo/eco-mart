<?php

namespace App\Livewire\User;

use App\Livewire\Concerns\HasToast;
use App\Models\Address;
use Livewire\Component;

class CreateAddressSelector extends Component
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


    protected function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required',
            'address' => 'required',
            'phone_number' => ['required', 'max:11', 'regex:/^[0-9]+$/'],
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
        ];
    }

    public function save()
    {
       $this->validate();
       $countAddress = Address::query()->count();

       if ($countAddress >= 2) {
        return $this->addAddressFailed('Failed. Maximum of 2 addresses allowed.');

       } else {
           Address::query()->create([
               'first_name'     => $this->first_name,
               'last_name'      => $this->last_name,
               'email'          => $this->email,
               'phone_number'   => $this->phone_number,
               'address'        => $this->address,
               'region'         => $this->region,
               'province'       => $this->province,
               'city'           => $this->city,
               'barangay'       => $this->barangay,
               'user_id'       => auth()->id()
           ]);
       }

        return redirect()->route('shopping-carts.checkout');
    }

    public function render()
    {
        return view('livewire.user.create-address-selector');
    }
}
