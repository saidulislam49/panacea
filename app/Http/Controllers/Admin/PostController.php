<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.post_list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->type == 'edit') {
            $data['post'] = Post::where('id', $request->id)->with('categories')->firstOrFail();
        }

        $data['request'] = $request;
        $data['categories'] = PostCategory::all();
        return view('admin.posts.create_and_update', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => 'Post Title required'
        ]);
        $thumbnail = null;
        if ($request->has('thumbnail')) {
            $request->validate([
                'thumbnail' => 'image'
            ]);
            $thumbnail = $request->file('thumbnail')->store('post_thumbnail');
        }
        $banner = null;
        if ($request->has('banner')) {
            $request->validate([
                'banner' => 'image'
            ]);
            $banner = $request->file('banner')->store('post_banner');
        }

        $post = Post::create([
            'title' => $request->title,
            'thumbnail' => $thumbnail,
            'banner' => $banner,
            'description' => $request->description,
        ]);

        if ($request->post_categories) {
            $post->postCategories()->syncWithoutDetaching($request->categories);
        } else {
            $post->postCategories()->syncWithoutDetaching([3]);
        }

        Toastr::success('Post Created Successfully', 'Success');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}