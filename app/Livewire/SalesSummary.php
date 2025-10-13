<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalesSummary extends Component
{
    public $chartData = [];
    public $range = 'daily';
    public $topProducts = [];
    public $totalSalesAmount = 0;
    public $totalItemsSold = 0;
    public $salesTransactions = 0;
    public $averageSaleValue = 0;
    public $totalProfit = 0;
    public $totalLoss = 0;

    public function mount()
    {
        $this->loadData();
    }

    public function updatedRange()
    {
        $this->loadData();
    }

    public function loadData()
    {
        // CHART DATA
        if ($this->range === 'daily') {
            $sales = Sale::selectRaw("strftime('%d', created_at) as day, SUM(total_amount) as total")
                ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                ->groupBy('day')
                ->get()
                ->keyBy('day');

            $daysInMonth = Carbon::now()->daysInMonth;

            $this->chartData = [
                'labels' => collect(range(1, $daysInMonth))
                    ->map(fn($d) => str_pad($d, 2, '0', STR_PAD_LEFT))
                    ->toArray(),
                'data'   => collect(range(1, $daysInMonth))
                    ->map(fn($d) => $sales->get(str_pad($d, 2, '0', STR_PAD_LEFT))->total ?? 0)
                    ->toArray(),
            ];
        } elseif ($this->range === 'monthly') {
            $sales = Sale::selectRaw("strftime('%m', created_at) as month, SUM(total_amount) as total")
                ->whereRaw("strftime('%Y', created_at) = ?", [now()->year])
                ->groupBy('month')
                ->get()
                ->keyBy('month');

            $this->chartData = [
                'labels' => collect(range(1, 12))->map(fn($m) => date("M", mktime(0, 0, 0, $m, 1)))->toArray(),
                'data'   => collect(range(1, 12))->map(fn($m) => $sales->get(str_pad($m, 2, '0', STR_PAD_LEFT))->total ?? 0)->toArray(),
            ];
        }

        //  DATE RANGE
        [$start, $end] = match ($this->range) {
            'daily'   => [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()],
            'weekly'  => [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()],
            'monthly' => [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()],
            'yearly'  => [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()],
            default   => [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()],
        };

        //  TOP PRODUCTS
        $this->topProducts = DB::table('sale_items as si')
            ->join('sales as s', 's.id', '=', 'si.sale_id')
            ->join('products as p', 'p.id', '=', 'si.product_id')
            ->whereBetween('s.created_at', [$start, $end])
            ->select(
                'p.id',
                'p.name',
                DB::raw('SUM(si.qty) as qty_sold'),
                DB::raw('SUM(si.total_amount) as total_sales')
            )
            ->groupBy('p.id', 'p.name')
            ->orderByDesc('qty_sold')
            ->limit(5)
            ->get()
            ->toArray();

        //  SUMMARY STATS
        $salesQuery = Sale::whereBetween('created_at', [$start, $end]);
        $this->totalSalesAmount = $salesQuery->sum('total_amount');
        $saleIds = $salesQuery->pluck('id');

        $this->totalItemsSold = DB::table('sale_items')
            ->whereIn('sale_id', $saleIds)
            ->sum('qty');

        $this->salesTransactions = $salesQuery->count();
        $this->averageSaleValue = $this->salesTransactions > 0
            ? $this->totalSalesAmount / $this->salesTransactions
            : 0;

        //   PROFIT & LOSS CALCULATION
        $profitData = DB::table('sale_items as si')
            ->join('sales as s', 's.id', '=', 'si.sale_id')
            ->join('products as p', 'p.id', '=', 'si.product_id')
            ->whereBetween('s.created_at', [$start, $end])
            ->selectRaw('
                SUM((p.price - p.cost_price) * si.qty) as total_profit,
                SUM(
                    CASE WHEN p.price < p.cost_price
                        THEN (p.cost_price - p.price) * si.qty
                        ELSE 0
                    END
                ) as total_loss
            ')
            ->first();

        $this->totalProfit = $profitData->total_profit ?? 0;
        $this->totalLoss = $profitData->total_loss ?? 0;

        //  CHART REFRESH
        $this->dispatch('refreshChart', $this->chartData);
    }

    public function render()
    {
        return view('livewire.sales-summary');
    }
}
