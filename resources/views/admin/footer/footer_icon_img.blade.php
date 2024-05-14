@extends('layouts.dashboard')

@section('content')
@can('add_footer_icon')
<div class="row mt-5">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Footer Icon List</h4>
            </div>
            @if (session('serdel'))
                <div class="alert alert-success">{{session('serdel')}}</div>
            @endif
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Icon</th>
                        <th>Icon Link</th>
                        <th>Action</th>

                        @foreach ($icons as $sl=>$icon)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>
                                    <i style="font-size: 24px; margin-right: 10px; color: red;" class="{{$icon->icon}}"></i>
                                </td>
                                <td>{{$icon->icon_link}}</td>
                                <td>
                                    <div class="dropdown mb-3">
                                        <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                            <svg width="6" height="26" viewBox="0 0 6 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 3C6 4.65685 4.65685 6 3 6C1.34315 6 0 4.65685 0 3C0 1.34315 1.34315 0 3 0C4.65685 0 6 1.34315 6 3Z" fill="#585858"></path>
                                                <path d="M6 13C6 14.6569 4.65685 16 3 16C1.34315 16 0 14.6569 0 13C0 11.3431 1.34315 10 3 10C4.65685 10 6 11.3431 6 13Z" fill="#585858"></path>
                                                <path d="M6 23C6 24.6569 4.65685 26 3 26C1.34315 26 0 24.6569 0 23C0 21.3431 1.34315 20 3 20C4.65685 20 6 21.3431 6 23Z" fill="#585858"></path>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('footer.icon.edit', $icon->id)}}" class="dropdown-item">Edit</a>
                                            <a href="{{route('footer.icon.delete', $icon->id)}}" class="dropdown-item">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Add Footer Icon</h4>
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
                <form action="{{route('footer.icon.store')}}" method="POST">
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
                        <input type="text" class="form-control" name="icon" id="icon">
                        @error('icon')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Icon Link</label>
                        <input type="text" name="icon_link" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ========= footer image ======== --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Footer Images List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Image</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($foot_imgs as $key=>$img)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img  width="60" src="{{asset('upload/footer')}}/{{$img->foot_img}}" alt="">
                            </td>
                            <td>{{$img->foot_img_link}}</td>
                            <td>
                                <a href="{{route('foot.img.delete', $img->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add footer image</h3>
            </div>
            <div class="card-body">
                <form action="{{route('footer.img.store')}}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="mb-3">
                    <label>Image</label>
                    <input type="file" class="fomr-control" name="foot_img">
                    <strong >Image should be 558X430</strong>
                    <br>
                    @error('foot_img')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                    @if (session('photo_error'))
                        <strong class="text-danger">{{session('photo_error')}}</strong>
                    @endif
                 </div>
                 <div class="mb-3">
                    <label>Link</label>
                    <input type="text" class="form-control" name="foot_img_link">
                    @error('foot_img_link')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                 </div>
                 <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Add Image</button>
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