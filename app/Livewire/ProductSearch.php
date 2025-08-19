<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
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
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('brand', 'like', '%' . $this->search . '%')
                  ->orWhere('price', 'like', '%' . $this->search . '%')
                  ->orWhere('qty', 'like', '%' . $this->search . '%')
                  ->orWhereHas('category', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $products = $query->get();

        return view('livewire.product-search', [
            'products' => $products,
        ]);
    }

    public function resetSearch()
    {
        $this->search = '';
    }
}
