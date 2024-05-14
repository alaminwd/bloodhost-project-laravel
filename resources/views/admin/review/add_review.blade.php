@extends('layouts.dashboard')

@section('content')
@can('add_review')
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Review List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{$review->name}}</td>
                                <td>{{$review->address}}</td>
                                <td>
                                    <a href="{{route('review.view', $review->id)}}" class="btn btn-primary">View</a>
                                    <a href="{{route('review.delete', $review->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Add Review</h3>
                </div>
                @if (session('review'))
                    <div class="alert alert-success">{{session('review')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('review.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                            @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>City</label>
                            <input type="text" class="form-control" name="address">
                            @error('address')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="desp" class="form-control"></textarea>
                            @error('desp')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Picture</label>
                            <input type="file" class="form-control" name="picture">
                            <h4 class="text-dark mt-2">Image size should not be greater than 2mb</h4>
                            @error('picture')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                                <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add review</button>
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