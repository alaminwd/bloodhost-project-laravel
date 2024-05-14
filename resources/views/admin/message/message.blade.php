@extends('layouts.dashboard')

@section('content')
@can('message_list')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Messages List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($mesges as $sl=>$message)
                            <tr class="{{$message->status == 0?'bg-light':''}}">
                                <td>{{$sl+1}}</td>
                                <td>{{substr($message->name, 0, 10)}}</td>
                                <td>{{substr($message->email, 0, 15)}}</td>
                                <td>{{substr($message->mesg, 0,20)}}..more</td>
                                <td>
                                    <a href="{{route('mesg.delete', $message->id)}}" class="btn btn-danger">Delete</a>
                                    <a href="{{route('message.view', $message->id)}}" class="btn btn-primary">View</a>
                                    <a href="{{route('message.solve', $message->id)}}" class="btn btn-{{$message->solve == 1?'success':'secondary'}}">{{$message->solve == 1?'Solved':'Unsolved'}}</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
<h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
@endcan
@endsection