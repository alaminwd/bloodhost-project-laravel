@extends('layouts.dashboard')

@section('content')
@can('add_blood')
    <div class="row mt-5">
        <div class="col-lg-6 offset-1">
            <div class="card">
                <div class="card-header">
                    <h3>Blood Group List</h3>
                </div>
                @if (session('blood_del'))
                    <div class="alert alert-success">{{session('blood_del')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Blood Group</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($bloods as $sl=>$blood)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>
                                <div class="badge badge-success">{{$blood->blood_group}}</div>
                                </td>
                                <td>
                                    <a href="{{route('blood.delete', $blood->id)}}" class="btn btn-danger">Delete</a>
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
                    <h3>Add Blood group</h3>
                </div>
                @if (session('blood_succ'))
                    <div class="alert alert-success">{{session('blood_succ')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('group.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Add Blood group</label>
                            <input type="text" name="blood_group" class="form-control">
                            @error('blood_group')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add group</button>
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