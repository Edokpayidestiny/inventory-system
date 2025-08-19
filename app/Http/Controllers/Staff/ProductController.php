<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Products',
            'products' => Product::with('category')->get(),
        ];

        return view('staff.products.index', $data);
    }
    public function show(Product $product)
    {
        $data = [
            'title' => 'Product Details',
            'product' => $product,
        ];

        return view('staff.products.show', $data);
    }


}
