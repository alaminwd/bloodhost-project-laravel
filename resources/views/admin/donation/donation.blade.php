@extends('layouts.dashboard')

@section('content')
@can('donation_list')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Donation List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($donations as $sl=>$donate)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$donate->name}}</td>
                                <td>{{$donate->email}}</td>
                                <td>{{$donate->phone}}</td>
                                <td>&#2547;{{$donate->amount}}</td>
                                <td>
                                    <a href="{{route('donation.delete', $donate->id)}}" class="btn btn-danger">Delete</a>
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