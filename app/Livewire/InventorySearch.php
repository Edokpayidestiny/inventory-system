<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
class InventorySearch extends Component
{
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
         $query = Product::with('category');

        // Apply search filter

        if($this->search){
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('qty', 'like', '%' . $this->search . '%')
                  ->orWhereHas('category', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $products = $query->get();


        return view('livewire.inventory-search', [
            'product' => $products,
        ]);
    }
}
