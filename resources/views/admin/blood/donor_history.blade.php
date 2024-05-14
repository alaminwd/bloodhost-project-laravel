@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="width: 100%">Donation History<a class="float-right btn btn-success" href="{{route('donor.history.download', $donors->id)}}">Download</a></h3>
                    
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>Donor Name</th>
                            <th>Blood Group</th>
                            <th>Last Donation Date</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($donor_info as $sl=> $donor )
                        <tr>
                           <td>{{$sl+1}}</td>
                           <td>{{$donor->rel_to_donor->name}}</td>
                           <td>{{$donor->rel_to_donor->rel_to_blood->blood_group}}</td>
                           <td>{{$donor->donate_date}}</td>
                           <td>
                           
                            <a class=" btn btn-danger" href="{{route('donor.history.delete', $donor->id)}}">Delete</a>
                            <a class=" btn btn-success" href="{{route('donor.history.details', $donor->id)}}">Details</a>
                           </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="width: 100%; text-align:center">

                                        <Strong class="text-danger text-center">He Has not Donated Yet !</Strong>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection