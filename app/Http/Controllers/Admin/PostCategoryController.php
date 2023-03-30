<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postCategories = PostCategory::all();
        return view('admin.post_category.post-category', compact('postCategories'));
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
            'title' => 'required'
        ]);

        $icon = null;
        if ($request->has('icon')) {
            $request->validate([
                'icon' => 'required | image | max:50'
            ]);
            $icon = $request->file('icon')->store('post_category_icon');
        }

        PostCategory::create([
            'title' => $request->title,
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
     * Update the specified resource in storage.postCategory
     */
    public function update(Request $request, string $id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $request->validate([
            'title' => 'required'
        ]);

        $icon = $postCategory->icon;
        if ($request->has('icon')) {
            $request->validate([
                'icon' => 'required | image | max:50'
            ]);
            // Storage::delete($postCategory->icon);
            !is_null($postCategory->icon) && Storage::delete($postCategory->icon);
            $icon = $request->file('icon')->store('post_category_icon');
        }

        $postCategory->update([
            'title' => $request->title,
            'icon' => $icon
        ]);

        Toastr::success('Post Category updated Successfully', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postCategory = PostCategory::findOrFail($id);

        if ($postCategory->id == 1) {
            Toastr::error("Uncategorized can't be deleted!!", 'Sorry!!!');
            return back();
        }

        if (count($postCategory->posts) > 0) {
            $post_array = [];
            foreach ($postCategory->posts as $single_post) {
                if (count($single_post->postCategories) > 1) {
                    continue;
                }
                $post_array[] = $single_post->id;
            }
            $uncategorized = PostCategory::find(1);
            $uncategorized->posts()->syncWithoutDetaching($post_array);
        }
        !is_null($postCategory->icon) && Storage::delete($postCategory->icon);
        // Storage::delete($postCategory->icon);
        $postCategory->posts()->detach();
        $postCategory->delete();

        Toastr::success('Category Deleted!!', 'Success');
        return back();
    }
}
