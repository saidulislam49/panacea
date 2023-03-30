@extends('layouts.admin_layout')

@section('page-title')
    Product
@endsection

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4 class="m-0">All Posts</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('posts.create') }}" class="btn btn-primary"><i class="fe-plus"></i> Add New Post</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                            <tr>
                                <td>SL</td>
                                <td>Title</td>
                                <td>Thumbnail</td>
                                <td>Categories</td>
                                <td>Description</td>
                                <td>Action</td>
                            </tr>
                        @forelse($posts as $post)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$post->title}}</td>
                                <td><img style="height: 50px;" src="{{asset('storage')}}/{{$post->thumbnail}}" alt=""></td>
                                {{-- <td>{{$post->postCategories}}</td> --}}
                                <td>{{$post->description}}</td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btn btn-outline-primary waves-effect waves-light" href="{{ route('posts.create') }}?type=edit&id={{ $post->id }}"><i class="fe-edit"></i> Edit</a>

                                            <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to Delete This Post?')" class="dropdown-item btn btn-outline-danger"><i class="fe-trash"></i> Delete</button>
                                            </form>

                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">No Product Found!</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

        </div><!-- end col -->
    </div>
@endsection
