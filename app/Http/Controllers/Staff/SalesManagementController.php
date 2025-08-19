<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class SalesManagementController extends Controller
{
    public function index()
    {
        $data = [
            'tile' => 'Sale Management',
            'products' => Product::with('category')->get(),
            'categories' => Category::all(),
        ];

        return view('staff.sales.index', $data);
    }
}
