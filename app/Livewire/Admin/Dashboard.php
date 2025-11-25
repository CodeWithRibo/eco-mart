<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $salesLabels = [];
    public $salesData = [];

    public $ordersLabels = [];
    public $ordersData = [];

    public function mount()
    {
        $this->loadSalesData();
        $this->loadOrdersData();
    }

    private function loadSalesData()
    {
        $orders = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(CAST(total_amount AS DECIMAL(10,2))) as total')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->where('status', '!=', 'Cancelled')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $found = $orders->firstWhere('date', $date);

            $this->salesLabels[] = Carbon::parse($date)->format('M d');
            $this->salesData[] = $found ? $found->total : 0;
        }
    }

    private function loadOrdersData()
    {

        $monthlyOrders = Order::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->where('status', '!=', 'Cancelled')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();


        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');

            $found = $monthlyOrders->firstWhere('month', $monthKey);

            $this->ordersLabels[] = $date->format('M Y');
            $this->ordersData[] = $found ? $found->count : 0;
        }
    }

    public function render()
    {
        $orders = Order::pluck('total_amount');

        $totalRevenue = $orders->sum();
        $totalOrders = $orders->count();
        $totalCustomer = DB::table('orders')->distinct('user_id')->count('user_id');

        $recentOrders = Order::with('orderItems')->orderBy('created_at', 'DESC')->take(5)->get();
        return view('livewire.admin.dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalCustomer' => $totalCustomer,
            'recentOrders' => $recentOrders,
        ]);
    }
}
