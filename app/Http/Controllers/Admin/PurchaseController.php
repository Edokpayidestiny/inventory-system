<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Purchase List',
            'purchases' => Purchase::with('purchaseItems.product')->get(),
        ];
        return view('admin.purchase.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Purchase'
        ];
        return view('admin.purchase.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        $data = [
            'title' => 'Purchase Details',
            'purchase' => $purchase->load('purchaseItems.product'),
        ];
        return view('admin.purchase.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $data = [
            'title' => 'Edit Purchase',
            'purchase' => $purchase,
            'products' => Product::all(),
        ];
        return view('admin.purchase.edit', $data);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        // Before deleting the purchase, adjust product stock based on purchase items
        foreach ($purchase->purchaseItems as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                // Reduce product stock by the quantity in the purchase item
                $product->qty = max(0, (float)($product->qty ?? 0) - (float)$item->qty);
                $product->save();
            }
        }

        // Now delete the purchase and its items
        $purchase->purchaseItems()->delete();
        $purchase->delete();

        return redirect()->route('admin.purchase.index')->with('success', 'Purchase deleted successfully.');
    }
}
