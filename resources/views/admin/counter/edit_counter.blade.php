@extends('layouts.dashboard')

@section('content')
@can('edit_achivement')
    <div class="row mt-5">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Update Achivement</h4>
                </div>
                <div class="card-body">
                    @php
                        $fonts = array(
                        'fa-solid fa-heart',
                        'fa-solid fa-stethoscope',
                        'fa-solid fa-users',
                        'fa-solid fa-building',
                        );       
                    @endphp
                    <form action="{{route('counter.update')}}" method="POST">
                        @csrf
                        @if (session('counter'))
                                <div class="alert alert-success">{{session('counter')}}</div>
                        @endif
                        <div class="mb-3">
                            @foreach ($fonts as $font)
                                <i style="font-size: 24px; margin-right: 10px; color: red; cursor: pointer;" class="{{$font}} fa"></i>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label>Select Icon</label>
                            <input type="hidden"  name="counter_id" value="{{$counter_info->id}}">
                            <input type="text" class="form-control" name="icon" id="icon" value="{{$counter_info->icon}}">
                            @error('icon')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Number</label>
                            <input type="number" name="number" class="form-control" value="{{$counter_info->number}}">
                            @error('number')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{$counter_info->title}}">
                            @error('title')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
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