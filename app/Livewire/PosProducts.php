<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PosProducts extends Component
{

    public $categories;
    public $products = [];
    public $selectedCategoryId;
    public $cart = [];
    public $paymentMethod =  null;




    public function mount()
    {
        $this->categories = Category::all(); // Load all categories
    }

    public function selectCategory($id)
    {
        $this->selectedCategoryId = $id;
        $this->products = Product::where('category_id', $id)->get();
    }
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['qty']++;
        } else {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'image' => $product->image,
            ];
        }
    }

    public function increment($id)
    {
        $this->cart[$id]['qty']++;
    }

    public function decrement($id)
    {
        if ($this->cart[$id]['qty'] > 1) {
            $this->cart[$id]['qty']--;
        }
    }

    public function removeItem($id)
    {
        unset($this->cart[$id]);
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }

    public function getTotalItems()
    {
        $totalItems = 0;

        foreach ($this->cart as $item) {
            $totalItems += $item['qty'];
        }

        return $totalItems;
    }
    public function clearCart()
    {
        $this->cart = [];
    }


    public function selectPaymentMethod($method)
    {
        $this->paymentMethod = $method;
    }

    public function checkout()
    {
        DB::beginTransaction();

        try {
            foreach ($this->cart as $items) {
                $product = Product::find($items['id']);
                if (!$product) {
                    session()->flash('error', 'Product not found.');
                    DB::rollBack();
                    return;
                }
                if ($items['qty'] > $product->qty) {

                    $this->dispatch('sale-error', [
                        'message' => 'Insufficient stock for ' . $product->name . '. Available: ' . $product->qty,
                        'productName' => $product->name,
                    ]);
                    session()->flash('error', 'Insufficient stock for ' . $product->name . '. Available: ' . $product->qty);
                    DB::rollBack();
                    return;
                }
            }
            // Create Sale
            $sale = Sale::create([
                'user_id' => Auth::id(),
                'total_amount' => $this->getTotal(),
                'reference' => 'SALE' . strtoupper(Str::random(10)),
                'payment_status' => 'paid',
                'status' => 'completed',
                'payment_method' => $this->paymentMethod,
            ]);

            // create sale items and update product quantities

            foreach ($this->cart as $item) {
                $product = Product::find($item['id']);

                // reduce stock
                $product->qty = max(0, $product->qty - $item['qty']);
                $product->save();

                // Save sales item

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'total_amount' => $item['price'] * $item['qty'],
                ]);

                DB::commit();

                $this->cart = [];
                $this->paymentMethod = null;

                $this->dispatch('sale-success', [
                    'message' => 'Sale completed successfully.',
                ]);


                session()->flash('success', 'Sale completed successfully.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while processing the sale: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.pos-products');
    }
}
