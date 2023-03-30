@extends('layouts.admin_layout')

@section('page-title')
    Category
@endsection


@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 align-items-center d-flex">
                            <h4 class="m-0">Category List</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                data-target="#signup-modal"><i class="fe-plus"></i> New Category</button>
                        </div>
                    </div>
                </div>
                <!-- Signup modal content -->
                <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="text-center m-0">Create a New Category</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="{{ route('category.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="name">Category Name</label>
                                            <input class="form-control" name="category_name" type="text" id="name"
                                                required="" placeholder="Category Title">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="icon">Icon (100x100px)</label>
                                            <input class="form-control" name="icon" type="file" id="icon">
                                        </div>
                                    </div>

                                    <div class="form-group account-btn text-center">
                                        <div class="col-12">
                                            <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light"
                                                type="submit">Create Category</button>
                                        </div>
                                    </div>

                                </form>


                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Icon</th>
                            <th>Total Product</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td><img width="60" src="{{ asset('storage') }}/{{ $category->icon }}" alt="">
                                </td>
                                <td>0</td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit{{ $category->id }}"><i class="fa fa-edit"></i> Edit</a>

                                            @if ($category->id != 3)
                                                <form action="{{ route('category.destroy', $category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item"
                                                        onclick="return confirm('Are you sure to delete this!!')"><i
                                                            class="fa fa-trash"></i> Delete</button>
                                                </form>
                                            @endif

                                        </div>
                                    </div>


                                    <!-- Category eidt modal content -->
                                    <div id="edit{{ $category->id }}" class="modal fade text-left" tabindex="-1"
                                        role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header justify-content-center">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h4 class="text-center m-0">Update Category</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal"
                                                        action="{{ route('category.update', $category->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="name">Category Name</label>
                                                                <input class="form-control"
                                                                    value="{{ $category->category_name }}"
                                                                    name="category_name" type="text" id="name"
                                                                    required="" placeholder="Category Title">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="icon">Icon (100x100px)</label>
                                                                <br>
                                                                <img src="{{ asset('storage') }}/{{ $category->icon }}"
                                                                    alt="" style="height: 50px;">
                                                                <input class="form-control" name="icon" type="file"
                                                                    id="icon">
                                                            </div>
                                                        </div>

                                                        <div class="form-group account-btn text-center">
                                                            <div class="col-12">
                                                                <button
                                                                    class="btn width-lg btn-rounded btn-primary waves-effect waves-light"
                                                                    type="submit">Update Category</button>
                                                            </div>
                                                        </div>

                                                    </form>


                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">No Data Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

            </div>
        </div><!-- end col -->
    </div>
@endsection
