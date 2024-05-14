@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Terms of Use</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('term.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Terms of Use</label>
                            <input type="hidden" name="term_id" value="{{$term_info->id}}">
                            <textarea name="term" class="summernote">{{$term_info->term}}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update Terms</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection