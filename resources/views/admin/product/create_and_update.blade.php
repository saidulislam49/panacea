@extends('layouts.admin_layout')

@section('page-title')
    @if ($request->type == 'edit')
        Update Product
    @else
        Add New Product
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
                                    Update Product
                                @else
                                    Create Product
                                @endif
                            </h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('product.index') }}" class="btn btn-primary"><i class="fe-plus"></i> View All
                                Product</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($request->type == 'edit')
                         <form class="form-horizontal" action="{{ route('product.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                    @else
                         <form class="form-horizontal" action="{{ route('product.store') }}" method="post"
                        enctype="multipart/form-data">
                    @endif
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input class="form-control" type="text" name="title"
                                        value="{{ $request->type == 'edit' ? $product->title : '' }}" id="title"
                                        placeholder="Product Title">
                                </div>
                                <div class="form-group">
                                    <label for="cover_page">Cover Page</label>
                                    <input class="form-control" name="cover_page" type="file" id="cover_page">
                                </div>
                                <div class="form-group">
                                    <label for="writer_id">Select Writer</label>
                                    <select name="writer_id" id="writer_id" class="form-control">
                                        <option selected>Select a writer</option>
                                        @foreach ($writers as $writer)
                                            <option
                                                {{ $request->type == 'edit' ? ($product->writer_id == $writer->id ? 'selected' : '') : '' }}
                                                value="{{ $writer->id }}">{{ $writer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input class="form-control" type="number" value="{{ $request->type == 'edit' ? $product->price : '' }}" name="price" id="price"
                                        placeholder="Price">
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">Discount Price</label>
                                    <input class="form-control" type="number" value="{{ $request->type == 'edit' ? $product->discount_price : '' }}" name="discount_price" id="discount_price"
                                        placeholder="Discount Price">
                                </div>
                                <div class="form-group">
                                    <label for="publishing_year">Publishing Year</label>
                                    <input class="form-control" type="number" value="{{ $request->type == 'edit' ? $product->publishing_year : '' }}" name="publishing_year" id="publishing_year"
                                        placeholder="Publishing Year">
                                </div>
                                <div class="form-group">
                                    <label for="edition">Edition</label>
                                    <input class="form-control" type="text" value="{{ $request->type == 'edit' ? $product->edition : '' }}" name="edition" id="edition"
                                        placeholder="Edition">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="snow-editor">Product category</label><br>
                                    <div
                                        style="height: 200px; overflow-y: scroll; border:1px solid #ced4da; padding: 10px;">
                                        @foreach ($categories as $cat)
                                            <input type="checkbox"
                                                {{ $request->type == 'edit' ? (count($product->categories->where('id', $cat->id)) > 0 ? 'checked' : '') : '' }}
                                                value="{{ $cat->id }}" name="categories[]"
                                                id="cat_{{ $cat->id }}"> <label
                                                for="cat_{{ $cat->id }}">{{ $cat->category_name }}</label> <br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="snow-editor">Product Details</label>
                                    <textarea name="details" id="snow-editor" style="height: 300px;" placeholder="Product Details" class="form-control">{{ $request->type == 'edit' ? $product->details : '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group account-btn text-center">
                            <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">
                                @if ($request->type == 'edit')
                                    Update Product
                                @else
                                    Create Product
                                @endif
                            </button>
                        </div>

                    </form>
                </div>
            </div><!-- end col -->
        </div>
    @endsection
