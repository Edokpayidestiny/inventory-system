<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Products',
            'products' => Product::with('category')->get(),
        ];

        return view('admin.products.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Product',
            'category' => Category::all(),
        ];

        return view('admin.products.create', $data);
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = new Product();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->category_id = $validated['category_id'];
        $product->price = $validated['price'];
        $product->qty = $validated['qty'];
        $product->unit = $validated['unit'];
        $product->brand = $validated['brand'];
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products'), $filename);
                $product->image = 'uploads/products/' . $filename;
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to upload image.']);
        }
        $product->save();
        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $data = [
            'title' => 'Product Details',
            'product' => $product->load('category'),
        ];

        return view('admin.products.show', $data);
    }
    public function edit(Product $product)
    {
        $data = [
            'title' => 'Edit Product',
            'product' => $product,
            'category' => Category::all(),
        ];

        return view('admin.products.edit', $data);
    }

    public function update(StoreProductRequest $request, Product $product)
    {

        $validated = $request->validated();

        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->category_id = $validated['category_id'];
        $product->price = $validated['price'];
        $product->qty = $validated['qty'];
        $product->unit = $validated['unit'];
        $product->brand = $validated['brand'];
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products'), $filename);
                $product->image = 'uploads/products/' . $filename;
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to upload image.']);
        }
        $product->save();
        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}
