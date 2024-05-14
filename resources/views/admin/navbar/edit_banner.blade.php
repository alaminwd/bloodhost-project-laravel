@extends('layouts.dashboard')

@section('content')
@can('edit_banner')
    <div class="row mt-5">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Banner Info</h3>
                </div>
                @if (session('ban_succ'))
                    <div class="alert alert-success">{{session('ban_succ')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('banner.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="hidden" value="{{$ban->id}}" name="banner_id">
                            <input type="text" class="form-control" name="title" value="{{$ban->title}}">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <input type="text" class="form-control" name="desp" value="{{$ban->desp}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Update Banner</button>
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