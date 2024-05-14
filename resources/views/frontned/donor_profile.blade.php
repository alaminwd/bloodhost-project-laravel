@extends('frontned.master')

@section('content')
<!-- ===========================================
                  banner Part Start 
  ================================================-->
<section id="about_banner"
    style="background: linear-gradient(to bottom, rgba(23, 23, 59, 0.9), rgba(23, 23, 59, 0.7)), url('{{asset('frontend/images/counter.jpg')}}') no-repeat center/cover ;">
    <!-- single banner -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="about_banner_content text-center">
                    <h4>Profile</h4>
                    <ul class="page-breadcrumb d-flex justify-content-center align-items-center mt-4">
                        <li><i class="fa fa-house "></i><a href="{{route('index')}}">Home</a></li>
                        <li>donor-profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- ===================================
                Donor Profile Info
  =========================================-->
<section id="donor-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="user_info">
                    <div class="card">
                        <div class="card-header">
                            <h3>Profile</h3>
                        </div>
                        <div class="card-body">
                            <div class="user_img">
                                @if (Auth::guard('donorlogin')->user()->donor_img == null)
                                <img src="{{asset('frontend/images/donor-img-null .jpg')}}" width="100"
                                    class="d-block img-fluid" alt="">
                                @else
                                <img src="{{asset('upload/donor')}}/{{Auth::guard('donorlogin')->user()->donor_img}}"
                                    width="100" class="d-block img-fluid" alt="">
                                @endif

                            </div>
                            <div class="user_content">
                                <h5>{{Auth::guard('donorlogin')->user()->name}}</h5>
                            </div>
                            <div class="user_details">
                                <p><span class="profile_span">Email</span><span
                                        class="profile_span2">{{Auth::guard('donorlogin')->user()->email}}</span></p>
                                <p><span class="profile_span">Address</span><span
                                        class="profile_span2">{{Auth::guard('donorlogin')->user()->address!=null?Auth::guard('donorlogin')->user()->address:'Not Assigned'}}</span>
                                </p>
                                <p><span class="profile_span">Number</span><span
                                        class="profile_span2">{{Auth::guard('donorlogin')->user()->phone}}</span></p>
                                <p><span class="profile_span">District</span><span
                                        class="profile_span2">{{Auth::guard('donorlogin')->user()->city_id!=null?Auth::guard('donorlogin')->user()->rel_to_city->city_name:'Not Assigned'}}</span>
                                </p>
                                <p><span class="profile_span">Upazila</span><span
                                        class="profile_span2">{{Auth::guard('donorlogin')->user()->subcity_id!=null?Auth::guard('donorlogin')->user()->rel_to_subcity->name:'Not Assigned'}}</span>
                                </p>
                                <p><span class="profile_span">Bl-Group</span><span
                                        class="profile_span2">{{Auth::guard('donorlogin')->user()->rel_to_blood->blood_group}}</span>
                                </p>
                                @if (Auth::guard('donorlogin')->user()->gender)
                                <p><span class="profile_span">Gender</span><span
                                        class="profile_span2">{{Auth::guard('donorlogin')->user()->gender==1?'Male':'Female'}}</span>
                                </p>
                                @endif
                                <p><span class="profile_span">Religion</span><span
                                        class="profile_span2">{{Auth::guard('donorlogin')->user()->religion!=null?Auth::guard('donorlogin')->user()->religion:'Not Assigned'}}</span>
                                </p>
                                <p><span class="profile_span">Brith Date</span><span
                                        class="profile_span2">{{Auth::guard('donorlogin')->user()->birth_date!=null?Auth::guard('donorlogin')->user()->birth_date:'Not Assigned'}}</span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 mt-5 mt-md-0">
              <div class="row">
                <div class="col-lg-8">
                  <div class="card mb-5" style="border: 1px solid #ddd;">
                    <div class="card-header p-4">
                        <h4>Donotion List <a class="float-end btn btn-success"
                                href="{{route('donor.history.download', Auth::guard('donorlogin')->user()->id)}}">Download</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Sl</th>
                                <th>Blood Group</th>
                                <th>Last Donation Date</th>
                            </tr>
                            @forelse ($donors as $sl=> $donor )
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$donor->rel_to_donor->rel_to_blood->blood_group}}</td>
                                <td>{{$donor->donate_date}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="width: 100%; text-align:center">
                  
                                    <Strong class="text-danger text-center">He Has not Donated Yet !</Strong>
                                  </td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                    @if($donors->count())
                    <div class="value" style="text-align: center; width: 100%; padding-top: 15px;">
                        <p><a href="{{route('contact')}}" class="text-danger mb-4">If you need more information contact Admin</a></p>
                    </div>
                    @endif
                  
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="card mb-5" style="border: 1px solid #ddd;">
                    <div class="card-header">
                        <h4> Add Donate Date</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('donor.history.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <label class="form-label">Receiver Name</label>
                                <input type="hidden" class="form-control" name="donor_id"
                                    value="{{Auth::guard('donorlogin')->user()->id}}">
                                <input type="text" class="form-control" name="reciever_name">
                                @error('reciever_name')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Receiver Number</label>
                                <input type="number" class="form-control" name="reciever_number">
                                @error('reciever_number')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Hospital Name</label>
                                <input type="text" class="form-control" name="hospital_name">
                                @error('hospital_name')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Hospital Address</label>
                                <input type="text" class="form-control" name="hospital_address">
                                @error('hospital_address')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Donate Date</label>
                                <input type="date" class="form-control" name="donate_date">
                                @error('donate_date')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Donation Image</label>
                                <input type="file" multiple class="form-control" name="donation_img[]">
                            </div>
                            <div class="mt-3 mb-3">
                                <button type="submit" class="btn btn-primary">Add last Date</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>






<!-- ===================================
                Donor donation Historry
  =========================================-->




@endsection

