@extends('layouts.admin_layout')

@section('page-title')
    Book Shop
@endsection


@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 align-items-center d-flex">
                            <h4 class="m-0">Shop List</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                data-target="#signup-modal"><i class="fe-plus"></i> New Shop</button>
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
                                <h4 class="text-center m-0">Create a New Shop</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="{{ route('book_shop.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="shop_name">Shop Name</label>
                                            <input class="form-control" name="shop_name" type="text" id="shop_name"
                                                required="" placeholder="Shop Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="phone_number">Shop Phone Number</label>
                                            <input class="form-control" name="phone_number" type="text" id="phone_number"
                                                required="" placeholder="Shop Phone Number">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="address">Shop address</label>
                                            <input class="form-control" name="address" type="text" id="address"
                                                required="" placeholder="Shop address">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="logo">Logo (100x100px)</label>
                                            <input class="form-control" name="logo" type="file" id="logo">
                                        </div>
                                    </div>

                                    <div class="form-group account-btn text-center">
                                        <div class="col-12">
                                            <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light"
                                                type="submit">Create Shop</button>
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
                            <th>Shop Name</th>
                            <th>Shop Logo</th>
                            <th>Shop Phone Number</th>
                            <th>Shop Address</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($book_shops as $book_shop)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $book_shop->shop_name }}</td>
                                <td><img width="60" src="{{ asset('storage') }}/{{ $book_shop->logo }}" alt="">
                                </td>
                                <td>{{ $book_shop->phone_number }}</td>
                                <td>{{ $book_shop->address }}</td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit{{ $book_shop->id }}"><i class="fa fa-edit"></i> Edit</a>

                                            <form action="{{ route('book_shop.destroy', $book_shop->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item"
                                                    onclick="return confirm('Are you sure to delete this!!')"><i
                                                        class="fa fa-trash"></i> Delete</button>
                                            </form>

                                        </div>
                                    </div>


                                    <!-- Category eidt modal content -->
                                    <div id="edit{{ $book_shop->id }}" class="modal fade text-left" tabindex="-1"
                                        role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header justify-content-center">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h4 class="text-center m-0">Update Book Shop</h4>
                                                </div>

                                                <div class="modal-body">
                                                    <form class="form-horizontal"
                                                        action="{{ route('book_shop.update', $book_shop->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="shop_name">Shop Name</label>
                                                                <input class="form-control" name="shop_name"
                                                                    value="{{ $book_shop->shop_name }}" type="text"
                                                                    id="shop_name" required=""
                                                                    placeholder="Shop Name">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="phone_number">Shop Phone Number</label>
                                                                <input class="form-control" name="phone_number"
                                                                    value="{{ $book_shop->phone_number }}" type="text"
                                                                    id="phone_number" required=""
                                                                    placeholder="Shop Phone Number">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="address">Shop address</label>
                                                                <input class="form-control" name="address"
                                                                    value="{{ $book_shop->address }}" type="text"
                                                                    id="address" required=""
                                                                    placeholder="Shop address">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="logo">Logo (100x100px)</label>
                                                                <br>
                                                                <img src="{{ asset('storage') }}/{{ $book_shop->logo }}"
                                                                    alt="" style="height: 50px;">
                                                                <input class="form-control" name="logo" type="file"
                                                                    id="logo">
                                                            </div>
                                                        </div>

                                                        <div class="form-group account-btn text-center">
                                                            <div class="col-12">
                                                                <button
                                                                    class="btn width-lg btn-rounded btn-primary waves-effect waves-light"
                                                                    type="submit">Update Shop</button>
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
