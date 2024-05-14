@extends('layouts.dashboard')

@section('content')
@can('edit_footer')
    <div class="row mt-5">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Edit footer Info</h3>
                </div>
                @if (session('footer'))
                    <div class="alert alert-success">{{session('footer')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('footer.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Number</label>
                                    <input type="hidden" name="footer_id" value="{{$footer_info->id}}">
                                    <input type="number" class="form-control" name="number" value="{{$footer_info->number}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Whatsapp</label>
                                    <input type="number" class="form-control" name="whatsapp" value="{{$footer_info->whatsapp}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Facebook page link</label>
                                    <input type="text" class="form-control" name="facebook" value="{{$footer_info->facebook}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$footer_info->email}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Website</label>
                                    <input type="text" class="form-control" name="website" value="{{$footer_info->website}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="footer_logo">
                                    @error('footer_logo')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    @if (session('photo_error'))
                                        <strong class="text-danger">{{session('photo_error')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="desp" class="form-control">
                                        {{$footer_info->desp}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-lg-4 m-auto">
                                <div class="mb-3">
                                    <button class="btn bg-primary text-white form-control">Update</button>
                                </div>
                            </div>
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