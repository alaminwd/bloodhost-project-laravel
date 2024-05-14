@extends('layouts.dashboard')

@section('content')
@can('view_review')
    <div class="row mt-5">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Add Review</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <div class="bg-success m-auto text-center" style="width: 200px;">
                                <img width="100" src="{{asset('upload/review')}}/{{$review_info->picture}}" alt="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" readonly value="{{$review_info->name}}">
                        </div>
                        <div class="mb-3">
                            <label>City</label>
                            <input type="text" class="form-control" readonly value="{{$review_info->address}}">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea class="form-control">
                                {{$review_info->desp}}
                            </textarea>
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
