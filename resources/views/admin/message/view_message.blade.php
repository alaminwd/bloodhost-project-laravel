@extends('layouts.dashboard')

@section('content')
@can('message_view')
    <div class="row mt-5">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Messages</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$messege_info->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$messege_info->email}}</td>
                        </tr>
                        <tr>
                            <th>Number</th>
                            <td>{{$messege_info->phone}}</td>
                        </tr>
                        <tr>
                            <th>Messages</th>
                            <td style="line-height: 24px;">{{$messege_info->mesg}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
<h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
@endcan
@endsection