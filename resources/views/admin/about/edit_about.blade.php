@extends('layouts.dashboard')

@section('content')
@can('edit_about')
    <div class="row mt-5">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Edit About Info</h3>
                </div>
                @if (session('ab_succ'))
                    <div class="alert alert-success">{{session('ab_succ')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('about.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Title 1</label>
                            <input type="hidden" name="about_id" value="{{$about_info->id}}">
                            <input type="text" class="form-control" name="title1" value="{{$about_info->title1}}">
                        </div>
                        <div class="mb-3">
                            <label>Description 1</label>
                            <textarea class="form-control" name="desp1">{{$about_info->desp1}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Title 2</label>
                            <input type="text" class="form-control" name="title2" value="{{$about_info->title2}}">
                        </div>
                        <div class="mb-3">
                            <label>Description 2</label>
                            <textarea class="form-control" name="desp2">{{$about_info->desp2}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Title 3</label>
                            <input type="text" class="form-control" name="title3" value="{{$about_info->title3}}">
                        </div>
                        <div class="mb-3">
                            <label>Description 3</label>
                            <textarea class="form-control" name="desp3">{{$about_info->desp3}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Title 4</label>
                            <input type="text" class="form-control" name="title4" value="{{$about_info->title4}}">
                        </div>
                        <div class="mb-3">
                            <label>Description 4</label>
                            <textarea class="form-control" name="desp4">{{$about_info->desp4}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" value="{{$about_info->address}}">
                        </div>
                        <div class="mb-3">
                            <label>About Image</label>
                            <input type="file" class="form-control" name="about_img">
                            <h4 class="text-dark mt-2">Image size should not be greater than 2mb</h4>
                            @error('about_img')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                                <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
<h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
@endcan
@endsection