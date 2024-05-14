@extends('layouts.dashboard')

@section('content')
@can('all_donor_list')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header w-100">
                    <h3 class="w-100">Donor List <span class="float-right"><a href="{{route('donor.download')}}" class="btn btn-danger">Download All Donors</a></span></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Blood Group</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($donors as $sl=>$donor)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$donor->name}}</td>
                                <td>{{$donor->email}}</td>
                                <td>
                                    <div class="badge badge-success">{{$donor->rel_to_blood->blood_group}}</div>
                                </td>
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
                                            <a class="dropdown-item" href="{{route('donor.history', $donor->id)}}">History</a>
                                            <a class="dropdown-item" href="{{route('donor.view', $donor->id)}}">View</a>
                                            <a class="dropdown-item" href="{{route('donor.delete', $donor->id)}}">Delete</a>
                                        
                                        </div>
                                    </div>
                                    
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
<div class="container">
    <div class="row">
        <div class="col-lg">
            <div class="mb-3">
                {{$donors->links()}}
            </div>
        </div>
    </div>
</div>
@endsection