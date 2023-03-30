<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.category', compact('categories'));
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
        $request->validate([
            'category_name' => 'required'
        ]);

        $icon = null;
        if ($request->has('icon')) {
            $request->validate([
                'icon' => 'required | image | max:50'
            ]);
            $icon = $request->file('icon')->store('category_icon');
        }

        Category::create([
            'category_name' => $request->category_name,
            'icon' => $icon
        ]);

        Toastr::success('Category Created Successfully', 'Success');
        return back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'category_name' => 'required'
        ]);

        $icon = $category->icon;
        if ($request->has('icon')) {
            $request->validate([
                'icon' => 'required | image | max:50'
            ]);
            // Storage::delete($category->icon);
            !is_null($category->icon) && Storage::delete($category->icon);
            $icon = $request->file('icon')->store('category_icon');
        }

        $category->update([
            'category_name' => $request->category_name,
            'icon' => $icon
        ]);

        Toastr::success('Category updated Successfully', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if($category->id == 3){
            Toastr::error("Uncategorized can't be deleted!!", 'Sorry!!!');
            return back();
        }

        if(count($category->products) > 0){
            $product_array = [];
            foreach($category->products as $single_product){
                if(count($single_product->categories) > 1){
                    continue;
                }
                $product_array[] = $single_product->id;
            }
            $uncategorized = Category::find(3);
            $uncategorized->products()->syncWithoutDetaching($product_array);
        }
        !is_null($category->icon) && Storage::delete($category->icon);
        // Storage::delete($category->icon);
        $category->products()->detach();
        $category->delete();

        Toastr::success('Category Deleted!!', 'Success');
        return back();
    }
}