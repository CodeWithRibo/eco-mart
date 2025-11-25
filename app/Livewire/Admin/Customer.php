<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Customer extends Component
{
    use WithPagination;

    #[Url]
    public ?string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $totalCustomer = User::where('role', 'customer')->count();
        $totalRevenue = Order::sum('total_amount');
        $averageTotal = Order::avg('total_amount');

        $customers = User::where('role', 'customer')->with(['orders.delivery'])
            ->orderBy('created_at', 'DESC')
            ->search(trim($this->search))
            ->paginate(10);

        return view('livewire.admin.customer', [
            'totalCustomers' =>  $totalCustomer,
            'totalRevenue' => $totalRevenue,
            'averageTotal' => $averageTotal,
            'customers' => $customers,
        ]);
    }
}
