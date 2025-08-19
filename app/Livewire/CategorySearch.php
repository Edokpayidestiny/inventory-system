<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategorySearch extends Component
{

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

       

    public function render()
    {
        $query = Category::query();

        // Apply search filter

        if($this->search){
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('code', 'like', '%' . $this->search . '%');
            });
        }

        $categories = $query->get();

        return view('livewire.category-search', [
                'categories' => $categories,
        ]);
    }
}
