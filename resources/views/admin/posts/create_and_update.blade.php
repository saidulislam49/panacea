@extends('layouts.admin_layout')

@section('page-title')
    @if ($request->type == 'edit')
        Update Post
    @else
        Add New Post
    @endif
@endsection

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('admin') }}/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('admin') }}/libs/quill/quill.min.js"></script>
    <!-- Init js-->
    <script src="{{ asset('admin') }}/js/pages/form-quilljs.init.js"></script>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="m-0">
                                @if ($request->type == 'edit')
                                    Update Post
                                @else
                                    Create Post
                                @endif
                            </h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('posts.index') }}" class="btn btn-primary"><i class="fe-plus"></i> View All Posts</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($request->type == 'edit')
                        <form class="form-horizontal" action="{{ route('posts.update', $post->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form class="form-horizontal" action="{{ route('posts.store') }}" method="post"
                                enctype="multipart/form-data">
                    @endif
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" name="title"
                                    value="{{ $request->type == 'edit' ? $post->title : '' }}" id="title"
                                    placeholder="Post Title">
                            </div>
                            <div class="form-group">
                                <label for="thumbnail">Post Thumbnail</label>
                                <input class="form-control" name="thumbnail" type="file" id="thumbnail">
                            </div>
                            <div class="form-group">
                                <label for="banner">Post Banner Image</label>
                                <input class="form-control" name="banner" type="file" id="banner">
                            </div>
                            <div class="form-group">
                                <label for="snow-editor">Post category</label><br>
                                <div style="height: 200px; overflow-y: scroll; border:1px solid #ced4da; padding: 10px;">
                                    @foreach ($categories as $cat)
                                        <input type="checkbox"
                                            {{ $request->type == 'edit' ? (count($post->categories->where('id', $cat->id)) > 0 ? 'checked' : '') : '' }}
                                            value="{{ $cat->id }}" name="post_categories[]" id="cat_{{ $cat->id }}">
                                        <label for="cat_{{ $cat->id }}">{{ $cat->title }}</label> <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="snow-editor">Product Details</label>
                                <textarea name="description" id="snow-editor" style="height: 300px;" placeholder="Product Details" class="form-control">{{ $request->type == 'edit' ? $post->description : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group account-btn text-center">
                        <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">
                            @if ($request->type == 'edit')
                                Update Post
                            @else
                                Create Post
                            @endif
                        </button>
                    </div>

                    </form>
                </div>
            </div><!-- end col -->
        </div>
    @endsection
