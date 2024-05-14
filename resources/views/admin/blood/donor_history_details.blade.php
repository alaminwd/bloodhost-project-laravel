@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Donation History Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Donor Name</th>
                        </tr>
                        <tr>
                            <td>{{$history_info->rel_to_donor->name}}</td>
                        </tr>
                        <tr>
                            <th>Reciver Name</th>
                        </tr>
                        <tr>
                            <td>{{$history_info->reciever_name}}</td>
                        </tr>
                        <tr>
                            <th>Reciver Number</th>
                        </tr>
                        <tr>
                            <td>{{$history_info->reciever_number}}</td>
                        </tr>
                        <tr>
                            <th>Hospital Name</th>
                        </tr>
                        <tr>
                            <td>{{$history_info->hospital_name}}</td>
                        </tr>
                        <tr>
                            <th>Hospital Address</th>
                        </tr>
                        <tr>
                            <td>{{$history_info->hospital_address}}</td>
                        </tr>
                        <tr>
                            <th>Donation Images</th>
                        </tr>
                        <tr>
                            <td>
                                @foreach ($images as $image)
                                    <img width="150" src="{{asset('upload/history')}}/{{$image->donation_img}}" alt="">
                                    <a href="{{asset('upload/history')}}/{{$image->donation_img}}" class="btn btn-success" download="{{$image->id}}">Download</a>
                                    <a href="{{route('donation.img.delete', $image->id)}}" class="btn btn-danger">Delete</a>
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


