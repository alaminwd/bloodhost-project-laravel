@extends('layouts.dashboard')

@section('content')
@can('edit_footer_icon')
    <div class="row mt-5">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Icon</h4>
                </div>
                <div class="card-body">
                    @php
                        $fonts = array(
                        'fa-brands fa-facebook-f',
                        'fa-brands fa-twitter',
                        'fa-brands fa-linkedin',
                        'fa-brands fa-instagram',
                        'fa-brands fa-pinterest-p',
                        'fa-brands fa-youtube',
                        );       
                    @endphp
                    <form action="{{route('footer.icon.update')}}" method="POST">
                        @csrf
                        @if (session('sersucc'))
                                <div class="alert alert-success">{{session('sersucc')}}</div>
                        @endif
                        <div class="mb-3">
                            @foreach ($fonts as $font)
                                <i style="font-size: 24px; margin-right: 10px; color: red; cursor: pointer;" class="{{$font}} fa"></i>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label>Select Icon</label>
                            <input type="hidden" value="{{$icon_info->id}}" name="icon_id">
                            <input type="text" class="form-control" name="icon" id="icon" value="{{$icon_info->icon}}">
                            @error('icon')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Icon Link</label>
                            <input type="text" name="icon_link" class="form-control" value="{{$icon_info->icon_link}}">
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

@section('footer_script')
<script>
    $('.fa').click(function(){
        var icon = $(this).attr('class');
        $('#icon').attr('value', icon);
    });
    </script>
@endsection