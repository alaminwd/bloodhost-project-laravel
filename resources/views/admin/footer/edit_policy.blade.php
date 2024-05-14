@extends('layouts.dashboard')

@section('content')
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Privacy Policy</h3>
            </div>
            <div class="card-body">
                <form action="{{route('policy.update')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Privacy Policy</label>
                        <input type="hidden" name="policy_id" value="{{$policy_info->id}}">
                        <textarea name="desp" class="summernote">{{$policy_info->desp}}</textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update Policy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection