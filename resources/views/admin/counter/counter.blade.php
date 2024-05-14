@extends('layouts.dashboard')

@section('content')
@can('add_achivement')
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Achivement list</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Icon</th>
                            <th>Number</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($counters as $counter)
                            <tr>
                                <td><i class="{{$counter->icon}}" style="font-family: fontawesome;"></i></td>
                                <td>{{$counter->number}}</td>
                                <td>{{$counter->title}}</td>
                                <td>
                                    <a href="{{route('counter.edit', $counter->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('counter.delete', $counter->id)}}" class="btn btn-danger">Delete</a>
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
                    <h4>Add Achivement</h4>
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
                    <form action="{{route('counter.store')}}" method="POST">
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
                            <input type="text" class="form-control" name="icon" id="icon">
                            @error('icon')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Number</label>
                            <input type="number" name="number" class="form-control">
                            @error('number')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                            @error('title')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
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