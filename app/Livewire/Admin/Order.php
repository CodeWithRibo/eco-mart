<?php

namespace App\Livewire\Admin;

use App\Models\Delivery;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;


class Order extends Component
{
 use WithPagination;

    #[Url]
    public ?string $search = '';

    public $sort = 'created_at';
    public $sortDirection = 'ASC';
    #[Url]
    public $status_filter = 'All Status';


    public $riders;

    public function mount()
    {

        $this->riders = User::where('role', 'rider')->get();
    }


    public function sortBy($field): string
    {
        return $this->sort === $field

            ? $this->sortDirection = $this->sortDirection === 'ASC' ? 'DESC' : 'ASC'
            : $this->sort = $field;
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function assignRider($orderId, $riderId)
    {
        if (empty($riderId)) {
            return;
        }

        $order = \App\Models\Order::findOrFail($orderId);

        if ($order) {
            Delivery::updateOrCreate(
                ['order_id' => $orderId],
                [
                    'rider_id' => $riderId,
                ]
            );

        }
    }

    public function render()
    {

        $sortColumn = $this->sortDirection === 'DESC' ? "-$this->sort" : $this->sort;

        $query = QueryBuilder::for(\App\Models\Order::class)
            ->search(trim($this->search))
            ->allowedSorts(['status'])
            ->defaultSort($sortColumn)
            ->with('delivery.rider');

        if ($this->status_filter != 'All Status')
            $query->where('status', $this->status_filter);

        $orders = $query->paginate(10);


        $totalOrders = \App\Models\Order::count();

        $pendingOrders = \App\Models\Order::whereIn('status', ['Processing', 'Assigned'])->count();
        $inTransitOrders = \App\Models\Order::where('status', 'Shipped')->count();
        $deliveredOrders = \App\Models\Order::where('status', 'Delivered')->count();

        return view('livewire.admin.order', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'inTransitOrders',
            'deliveredOrders',
        ));
    }
}
