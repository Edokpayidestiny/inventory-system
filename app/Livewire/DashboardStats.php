<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardStats extends Component
{
     public $chartData = [];
    public $topProducts = [];
    public $stats = [];

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // KPI cards
        $this->stats = [
            'today_sales' => Sale::whereDate('created_at', Carbon::today())->sum('total_amount'),
            'total_products' => Product::count(),
            'total_purchases' => Purchase::count(),
        ];

        // Chart (Last 7 Days - Only Sales)
        $sales = Sale::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total_sales')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $this->chartData = [
            'labels' => $sales->pluck('date')->toArray(),
            'sales' => $sales->pluck('total_sales')->toArray(),
        ];



        // Top products
        $this->topProducts = DB::table('sale_items')
            ->join('products', 'sale_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sale_items.qty) as total_sold'), DB::raw('MAX(sale_items.price) as price'))
            ->groupBy('products.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
    }


    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
