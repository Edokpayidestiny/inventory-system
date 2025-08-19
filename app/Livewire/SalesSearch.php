<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;

class SalesSearch extends Component
{
     public $search = '';
    public $date_from = '';
    public $date_to = '';

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function mount($date_from = null, $date_to = null)
    {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    public function render()
    {
        $query = Sale::with(['user', 'saleItems']);

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('payment_method', 'like', '%' . $this->search . '%')
                ->orWhere('total_amount', 'like', '%' . $this->search . '%')
                ->orWhere('status', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('saleItems', function ($q) {
                      $q->whereHas('product', function ($q) {
                          $q->where('product_name', 'like', '%' . $this->search . '%');
                      });
                  });
            });
        }

        // Apply date range filter if provided
        if ($this->date_from && $this->date_to) {
            $dateFrom = Carbon::createFromFormat('Y-m-d', $this->date_from)->startOfDay();
            $dateTo = Carbon::createFromFormat('Y-m-d', $this->date_to)->endOfDay();
            $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        }

        $sales = $query->get();

        return view('livewire.sales-search', [
            'sales' => $sales,
        ]);
    }

    public function resetSearch()
    {
        $this->search = '';
    }

   
}

