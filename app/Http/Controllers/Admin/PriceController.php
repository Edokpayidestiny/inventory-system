<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPricing;
use App\Http\Requests\ProductPricingRequest;

class PriceController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Adjust Pricing',
            'products' => Product::all(),
        ];

        return view('admin.pricing.index', $data);
    }


    public function update(ProductPricingRequest $request, Product $product)
    {
        $request->validated();
        $old_selling_price = $product->price;
        // update cost price in product pricings table
        $product->cost_price = $request->input('price');
        // recalculate selling price based on markup percent
        $product->price = $request->input('price') * (1 + $product->markup_percent / 100);
        $product->save();

        // Save historical pricing
        ProductPricing::create([
            'old_selling_price' => $old_selling_price,
            'new_selling_price' => $product->price,
            'product_id' => $product->id,
        ]);
        return back()->with('success', 'Price updated successfully.');
    }

    public function show(Product $product)
    {
        $data = [
            'title' => 'Pricing History Details',
            'product' => $product,
            'productPricing' => ProductPricing::with('product')->where('product_id', $product->id)->get(),
        ];

        return view('admin.pricing.show', $data);
    }

    public function history()
    {
        $data = [
            'title' => 'Pricing History',
            'productPricing' => ProductPricing::with('product')->get(),
        ];

        return view('admin.pricing.history', $data);
    }
}
