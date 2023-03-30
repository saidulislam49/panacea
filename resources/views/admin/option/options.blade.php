@extends('layouts.admin_layout')

@section('page-title')
   Options
@endsection

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Update Site Options</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('options.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-around">
                            <div class="col-md-6 col-lg-5">
                                <div class="form-group">
                                    <label for="">Site Title</label>
                                    <input type="text" name="site_title" value="{{ getOptionData('site_title') }}"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Slogan</label>
                                    <input type="text" name="slogan" value="{{ getOptionData('slogan') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" value="{{ getOptionData('address') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Logo</label><br>
                                    <img src="{{ asset('storage') }}/{{ getOptionData('logo') }}" style="height:50px;" alt="">
                                    <input type="file" name="logo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Favicon</label><br>
                                    <img src="{{ asset('storage') }}/{{ getOptionData('favicon') }}" style="height:50px;" alt="">
                                    <input type="file" name="favicon" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Primary Phone Number</label>
                                    <input type="text" name="phone_1" value="{{ getOptionData('phone_1') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Secondary Phone Number</label>
                                    <input type="text" name="phone_2" value="{{ getOptionData('phone_2') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Primary Email</label>
                                    <input type="text" name="email_1" value="{{ getOptionData('email_1') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-5">
                                <div class="form-group">
                                    <label for="">Secondary Email</label>
                                    <input type="text" name="email_2" value="{{ getOptionData('email_2') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Facebook</label>
                                    <input type="text" name="fb" value="{{ getOptionData('fb') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Youtube</label>
                                    <input type="text" name="youtube" value="{{ getOptionData('youtube') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Twitter</label>
                                    <input type="text" name="twitter" value="{{ getOptionData('twitter') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Linkedin</label>
                                    <input type="text" name="linkedin" value="{{ getOptionData('linkedin') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Telegram</label>
                                    <input type="text" name="telegram" value="{{ getOptionData('telegram') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Whats App</label>
                                    <input type="text" name="whats_app" value="{{ getOptionData('whats_app') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Instagram</label>
                                    <input type="text" name="instagram" value="{{ getOptionData('instagram') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update Options</button>
                        </div>
                    </form>
                </div>

            </div>
        </div><!-- end col -->
    </div>
@endsection
