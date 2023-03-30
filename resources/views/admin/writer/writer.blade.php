@extends('layouts.admin_layout')

@section('page-title')
    Writers
@endsection


@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 align-items-center d-flex">
                            <h4 class="m-0">Writers List</h4>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                data-target="#signup-modal"><i class="fe-plus"></i> New Writer</button>
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
                                <h4 class="text-center m-0">Create a New Writer</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="{{ route('writer.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="name">Name</label>
                                            <input class="form-control" name="name" type="text" id="name"
                                                required="" placeholder="Writer Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="designation">Designation</label>
                                            <input class="form-control" name="designation" type="text" id="designation"
                                                required="" placeholder="Writer designation">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="description">Description</label>
                                            <input class="form-control" name="description" type="text" id="description"
                                                required="" placeholder="Writer description">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="profile">Profile Picture</label>
                                            <input class="form-control" name="profile_picture" type="file"
                                                id="profile">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label for="writerSpeech">Writer Speech</label>
                                            <textarea class="form-control" name="writers_speech" id="writerSpeech" placeholder="Writer Speech"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group account-btn text-center">
                                        <div class="col-12">
                                            <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light"
                                                type="submit">Create Writer</button>
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
                            <th>Name</th>
                            <th>Profile</th>
                            <th>Designation</th>
                            <th>description</th>
                            <th>Writer Speech</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($writers as $writer)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $writer->name }}</td>
                                <td><img width="60" src="{{ asset('storage') }}/{{ $writer->profile_picture }}"
                                        alt="">
                                </td>
                                <td>{{ $writer->designation }}</td>
                                <td>{{ $writer->description }}</td>
                                <td>{{ $writer->writers_speech }}</td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#edit{{ $writer->id }}"><i class="fa fa-edit"></i> Edit</a>

                                            <form action="{{ route('writer.destroy', $writer->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item"
                                                    onclick="return confirm('Are you sure to delete this!!')"><i
                                                        class="fa fa-trash"></i> Delete</button>
                                            </form>

                                        </div>
                                    </div>


                                    <!-- Category eidt modal content -->
                                    <div id="edit{{ $writer->id }}" class="modal fade text-left" tabindex="-1"
                                        role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header justify-content-center">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h4 class="text-center m-0">Update Writer</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal"
                                                        action="{{ route('writer.update', $writer->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="name">Name</label>
                                                                <input class="form-control" name="name"
                                                                    value="{{ $writer->name }}" type="text"
                                                                    id="name" required=""
                                                                    placeholder="Writer Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="designation">Designation</label>
                                                                <input class="form-control" name="designation"
                                                                    value="{{ $writer->designation }}" type="text"
                                                                    id="designation" required=""
                                                                    placeholder="Writer designation">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="description">Description</label>
                                                                <input class="form-control" name="description"
                                                                    value="{{ $writer->description }}" type="text"
                                                                    id="description" required=""
                                                                    placeholder="Writer description">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="slug">Slug (Clear the field if want to generate new link)</label>
                                                                <input class="form-control" name="slug" type="text"
                                                                    value="{{ $writer->slug }}" id="slug" placeholder="Writer Slug">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="profile">Profile Picture</label> <br>
                                                                <img src="{{ asset('storage') }}/{{ $writer->profile_picture }}"
                                                                   style="height:50px;" alt="">
                                                                <input class="form-control" name="profile_picture"
                                                                    type="file" id="profile">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-12">
                                                                <label for="writerSpeech">Writer Speech</label>
                                                                <textarea class="form-control" name="writers_speech" id="writerSpeech" placeholder="Writer Speech">{{ $writer->writers_speech }}</textarea>
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
