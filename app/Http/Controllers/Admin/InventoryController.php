<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\AdjustmentHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'tile' => 'Inventory',
            'category' => Category::all(),
            'product' => Product::all(),
        ];
        return view('admin.inventory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Product $product)
    {
        $data = [
            'tile' => 'Inventory Details',
            'product' => $product,
        ];
        return view('admin.inventory.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data = [
            'tile' => 'Edit Inventory',
            'product' => $product,
        ];
        return view('admin.inventory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $previousQty = $product->qty;

        $request->validate([
            'adjustment_type' => 'required|in:increase,decrease',
            'qty' => 'required|integer|min:0',
        ]);
        // Logic to update the inventory based on the adjustment type and quantity
        if ($request->adjustment_type === 'increase') {
            $product->qty += $request->qty;
        }elseif ($request->adjustment_type === 'decrease') {
            if($product->qty >= $request->qty) {
                $product->qty -= $request->qty;
            } else {
                return redirect()->back()->withErrors(['error' => 'Insufficient stock to decrease']);
            }
        }
        $product->save();

        AdjustmentHistory::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'adjustment_type' => $request->adjustment_type,
            'previous_qty' => $previousQty,
            'new_qty' => $product->qty,
            'reason' => $request->reason ?? null,
        ]);

        return redirect()->route('admin.inventory')->with('success', 'Inventory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
