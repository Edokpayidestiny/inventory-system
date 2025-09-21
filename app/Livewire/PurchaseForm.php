<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\PurchaseItem;
use Carbon\Carbon;
class PurchaseForm extends Component
{   public $supplier, $purchase_date, $notes;
    public $products = []; // array of items: [['product_id'=>1,'qty'=>2,'price'=>500]]

    public function mount()
    {
        $this->purchase_date = Carbon::now()->format('Y-m-d');
        $this->products = [
            ['product_id' => '', 'qty' => 1, 'price' => 0, 'subtotal' => 0]
        ];
    }

    public function addProductRow()
    {
        $this->products[] = ['product_id' => '', 'qty' => 1, 'price' => 0, 'subtotal' => 0];
    }

    public function removeProductRow($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    public function updatedProducts()
    {
        foreach ($this->products as $index => $row) {
            $qty = (int) ($row['qty'] ?? 0);
            $price = (float) ($row['price'] ?? 0);
            $this->products[$index]['subtotal'] = $qty * $price;
        }
    }

    public function getGrandTotalProperty()
    {
        return collect($this->products)->sum('subtotal');
    }

    public function save()
    {
        $this->validate([
            'supplier' => 'required|string',
            'purchase_date' => 'required|date',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
            'products.*.price' => 'nullable|numeric|min:0',
        ]);

        $purchase = Purchase::create([
            'supplier' => $this->supplier,
            'purchase_date' => $this->purchase_date,
            'total_amount' => $this->grandTotal,
            'notes' => $this->notes,
        ]);

        foreach ($this->products as $row) {
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $row['product_id'],
                'qty' => $row['qty'],
                'cost_price' => $row['price'],
            ]);

            $product = Product::find($row['product_id']);

            // update product stock
            $product->qty += $row['qty'];

            // only update cost & selling price if price is provided
            if(!empty($row['price']) && $row['price'] > 0) {
                $product->cost_price = $row['price'];
                $product->price = $row['price'] + ($row['price'] * $product->markup_percent / 100);
            }

            $product->save();
        }

        session()->flash('success', 'Purchase recorded successfully!');
        return redirect()->route('admin.purchase.index');
    }
    public function render()
    {
        return view('livewire.purchase-form', [
            'allProducts' => Product::all(),
        ]);
    }
}
