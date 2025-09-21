<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PurchaseEdit extends Component
{
    public Purchase $purchase;
    public $supplier;
    public $purchase_date;
    public $notes;
    public $items = [];

    public function mount(Purchase $purchase)
    {
        $this->purchase = $purchase;
        $this->supplier = $purchase->supplier;
        $this->purchase_date = $purchase->purchase_date
            ? (is_string($purchase->purchase_date) ? $purchase->purchase_date : $purchase->purchase_date->format('Y-m-d'))
            : null;
        $this->notes = $purchase->notes;

        $rows = PurchaseItem::where('purchase_id', $purchase->id)->with('product')->get();

        $this->items = $rows->map(function ($it) {
            return [
                'id' => $it->id,
                'product_id' => $it->product_id,
                'product_name' => $it->product->name ?? '—',
                'current_qty' => (int) $it->qty,
                'new_qty' => (int) $it->qty,
                'adjustmentType' => '',   // increase | decrease | ''
                'adjustmentQty' => null,  // number to adjust
                'original_cost_price' => $it->cost_price !== null ? (float)$it->cost_price : null,
                'new_cost_price' => null, // only set by admin to update price
            ];
        })->toArray();
    }

    /**
     * When adjustment fields change recalculates new_qty instantly.
     */
    public function updated($name, $value)
    {
        if (! preg_match('/items\.(\d+)\.(adjustmentType|adjustmentQty)/', $name, $m)) {
            return;
        }

        $index = (int) $m[1];
        if (! isset($this->items[$index])) return;

        $item = $this->items[$index];
        $current = (int) ($item['current_qty'] ?? 0);
        $type = $item['adjustmentType'] ?? '';
        $adj = (int) ($item['adjustmentQty'] ?? 0);

        $new = $current;
        if ($type === 'increase') {
            $new = $current + max(0, $adj);
        } elseif ($type === 'decrease') {
            $new = max(0, $current - max(0, $adj));
        }

        $this->items[$index]['new_qty'] = $new;
    }

    public function update()
{
    $this->validate([
        'supplier' => 'nullable|string',
        'purchase_date' => 'nullable|date',
        'items' => 'required|array|min:1',
        'items.*.id' => 'required|integer|exists:purchase_items,id',
        'items.*.new_qty' => 'required|integer|min:0',
        'items.*.new_cost_price' => 'nullable|numeric|min:0',
        'items.*.cost_price' => 'nullable|numeric|min:0', // compatibility
    ]);

    DB::transaction(function () {
        // Update purchase header
        $this->purchase->update([
            'supplier' => $this->supplier,
            'purchase_date' => $this->purchase_date,
            'notes' => $this->notes,
        ]);

        foreach ($this->items as $row) {
            /** @var PurchaseItem|null $pi */
            $pi = PurchaseItem::find($row['id']);
            if (! $pi) continue;

            $oldQty = (int) $pi->qty;
            $newQty = (int) ($row['new_qty'] ?? $oldQty);
            $newQty = max(0, $newQty);

            // Always set qty on purchase_item
            $pi->qty = $newQty;

            // Determine if admin provided a new cost (support both keys)
            $providedCost = null;
            if (array_key_exists('new_cost_price', $row) && $row['new_cost_price'] !== null && $row['new_cost_price'] !== '') {
                $providedCost = $row['new_cost_price'];
            } elseif (array_key_exists('cost_price', $row) && $row['cost_price'] !== null && $row['cost_price'] !== '') {
                $providedCost = $row['cost_price'];
            }

            // If admin provided a new cost and it's numeric & different from original, update purchase_item cost
            if ($providedCost !== null && is_numeric($providedCost)) {
                $newCost = (float) $providedCost;
                $origCost = $pi->cost_price !== null ? (float)$pi->cost_price : null;

                if ($origCost === null || $newCost !== $origCost) {
                    $pi->cost_price = $newCost;
                }
            }

            $pi->save();

            // Update product stock and (optionally) cost/price
            $product = Product::find($pi->product_id);
            if ($product) {
                // adjust stock (delta)
                $delta = $newQty - $oldQty;
                $product->qty = max(0, (float)($product->qty ?? 0) + $delta);

                // if admin provided new cost, update product cost and selling price
                if ($providedCost !== null && is_numeric($providedCost)) {
                    $newCost = (float) $providedCost;
                    $product->cost_price = $newCost;

                    // unified markup fetch (handles markup_percent or markup_percentage)
                    $markup = (float) ($product->markup_percent ?? $product->markup_percentage ?? 0);

                    // Calculate selling price from markup
                    $product->price = round($newCost * (1 + $markup / 100), 2);
                }

                $product->save();
            }
        }

        // Recalculate purchase total_amount from persisted purchase_items
        $total = PurchaseItem::where('purchase_id', $this->purchase->id)
            ->get()
            ->sum(function ($it) {
                return ((float)$it->qty) * ((float)($it->cost_price ?? 0));
            });

        $this->purchase->total_amount = $total;
        $this->purchase->save();
    });

    session()->flash('success', 'Purchase updated successfully.');
    return redirect()->back();
}

     public function render()
    {

        return view('livewire.purchase-edit');
    }
}
