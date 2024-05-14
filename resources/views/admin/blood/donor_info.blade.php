@extends('layouts.dashboard')

@section('content')
@can('donor_info')
    <div class="row mt-5">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Donor Information</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" readonly class="form-control" value="{{$donor_info->name}}">
                            </div>
                            <div class="col-lg-6 mb-3">
                              <label class="form-label">Email Address</label>
                              <input type="text" readonly class="form-control" value="{{$donor_info->email}}">
                           </div>
                            <div class="col-lg-12 mb-3">
                              <label class="form-label">Address</label>
                              <input type="text" readonly class="form-control" value="{{$donor_info->address}}">
                            </div>
                            <div class="col-lg-6 mb-3">
                              <label class="form-label">Phone Number</label>
                              <input type="text" readonly class="form-control" value="{{$donor_info->phone}}">
                          </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">District</label>
                                <input type="text" readonly class="form-control" value="{{$donor_info->city_id != null?$donor_info->rel_to_city->city_name:''}}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Upazila</label>
                                <input type="text" readonly class="form-control" value="{{$donor_info->city_id != null?$donor_info->rel_to_subcity->name:''}}">
                            </div>
                            <div class="col-lg-6 mb-3">
                              <label class="form-label">Blood Group</label>
                              <input type="text" readonly class="form-control" value="{{$donor_info->rel_to_blood->blood_group}}">
                          </div>
                          <div class="col-lg-6 mb-3">
                            <label class="form-label">Gender</label>
                            <input type="text" readonly class="form-control" value="{{$donor_info->gender==1?'Male':'Female'}}">
                          </div>
                          <div class="col-lg-6 mb-3">
                            <label class="form-label">Religion</label>
                            <input type="text" readonly class="form-control" value="{{$donor_info->religion}}">
                          </div>
                          <div class="col-lg-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="text" readonly class="form-control" value="{{$donor_info->birth_date}}">
                          </div>
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