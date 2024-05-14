@extends('layouts.dashboard')

@section('content')
@can('add_blog')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Post a blog</h3>
                </div>
                @if (session('blog'))
                    <div class="alert alert-success">{{session('blog')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('blog.update')}}" method="POST" enctype="multipart/form-data">
                       @csrf
                       <div class="mb-3">
                            <label>Title</label>
                            <input type="hidden" name="blog_id" value="{{$blog_info->id}}">
                            <input type="text" name="title" class="form-control" value="{{$blog_info->title}}">
                       </div>
                       <div class="mb-3">
                            <label>Blog</label>
                            <textarea class="summernote" name="desp">{{$blog_info->desp}}</textarea>
                        </div>
                       <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="img" class="form-control">
                            <h4 class="text-dark mt-2">Image size should not be greater than 2mb</h4>
                            @error('img')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                       </div>
                       <div class="mb-3" style="width: 300px; margin-left: auto; margin-right: auto;">
                        <button class="btn bg-primary text-white form-control">Update Blog</button>
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
