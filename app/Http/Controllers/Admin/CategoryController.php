<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Categories',
            'categories' => Category::all()
        ];

        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = ['title' => 'Add Category'];

        return view('admin.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        try {
            if($request->hasFile('image')){
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/categories'), $filename);
                $category->image = 'uploads/categories/' . $filename;
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['image' => 'Failed to upload image.']);
        }
        $category->save();
        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = [
            'title' => 'Edit Category',
            'category' => $category
        ];

        return view('admin.categories.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {

        $validated = $request->validated();
        $category->name = $validated['name'];
        $category->description = $validated['description'];

        try {
            if($request->hasFile('image')){
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/categories'), $filename);
                $category->image = 'uploads/categories/' . $filename;
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['image' => 'Failed to upload image.']);
        }

        $category->save();
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $imagePath =  public_path($category->image);
            if($category->image && file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
            $category->delete();
            return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete category.']);
        }
    }


}
