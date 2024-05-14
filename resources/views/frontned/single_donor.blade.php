@extends('frontned.master')

@section('content')
     <!-- ===========================================
                  banner Part Start 
  ================================================-->
  <section id="about_banner" style="background: linear-gradient(to bottom, rgba(23, 23, 59, 0.9), rgba(23, 23, 59, 0.7)), url('{{asset('frontend/images/counter.jpg')}}') no-repeat center/cover ;">
    <!-- single banner -->
      <div class="container">
        <div class="row">
          <div class="col-lg-6 m-auto ">
            <div class="donor_img d-flex align-items-center justify-content-center ">   
              @if ($donor_info->donor_img == '')
              <img src="{{asset('frontend/images/donor-img-null .jpg')}}" class=" d-block img-fluid" width="130" height="130" alt="">
              @else
              <img src="{{asset('upload/donor')}}/{{$donor_info->donor_img}}" class=" d-block img-fluid" width="130" height="130" alt="">
              @endif
            </div>
            <div class="donor_profile_content">
              <h4>{{$donor_info->name}}</h4>
              <p><i class="fa-solid fa-location-dot"></i> Location: <span>{{$donor_info->address}}</span></p>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>


<!-- =============================
      Donor Details part 
=================================-->

<section id="donor_details">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="card">
                  <div class="card-header p-4">
                      <h4>Donor Details</h4>
                  </div>
                  <div class="card-body">
                      <div class="donor_item  d-flex">
                          <div class="caption">
                              <p>Name</p>
                         </div>
                         <div class="value">
                              <p>{{$donor_info->name}}</p>
                         </div>
                      </div>
                      <div class="donor_item  d-flex">
                          <div class="caption">
                              <p>Gander</p>
                         </div>
                         <div class="value">
                              <p>{{$donor_info->gender == 1?'Male':'Female'}}</p>
                         </div>
                      </div>
                      <div class="donor_item  d-flex">
                          <div class="caption">
                              <p>Blood Group</p>
                         </div>
                         <div class="value">
                              <p>{{$donor_info->rel_to_blood->blood_group}}</p>
                         </div>
                      </div>
                      <div class="donor_item  d-flex">
                          <div class="caption">
                              <p>Religion</p>
                         </div>
                         <div class="value">
                              <p>{{$donor_info->religion?$donor_info->religion:'Not Assigned'}}</p>
                         </div>
                      </div>
                      <div class="donor_item  d-flex">
                          <div class="caption">
                              <p>Email</p>
                         </div>
                         <div class="value">
                              <p>{{$donor_info->email}}</p>
                         </div>
                      </div>
                      <div class="donor_item  d-flex">
                          <div class="caption">
                              <p>Phone</p>
                         </div>
                         <div class="value">
                              <p><a style="color: red" href="{{route('contact')}}">Contact Admin to get the number</a></p>
                         </div>
                      </div>
                      <div class="donor_item  d-flex">
                        <div class="caption">
                            <p>District</p>
                       </div>
                       <div class="value">
                            <p>{{$donor_info->city_id?$donor_info->rel_to_city->city_name:'Not Assigned'}}</p>
                       </div>
                      </div>
                      <div class="donor_item  d-flex">
                        <div class="caption">
                            <p>Upazila</p>
                       </div>
                       <div class="value">
                            <p>{{$donor_info->subcity_id?$donor_info->rel_to_subcity->name:'Not Assigned'}}</p>
                       </div>
                      </div>
                      <div class="donor_item  d-flex">
                          <div class="caption">
                              <p>Address</p>
                         </div>
                         <div class="value">
                              <p>{{$donor_info->address?$donor_info->address:'Not Assigned'}}</p>
                         </div>
                      </div>
                      <div class="donor_item  d-flex">
                          <div class="caption">
                              <p>Last Donated</p>
                         </div>
                         <div class="value">
                              <p>{{$donor_info->last_donate?$donor_info->last_donate:'Not Assigned'}}</p>
                         </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 mt-lg-0 mt-4">
              <div class="card">
                  <div class="card-header p-4">
                      <h4>Donotion List <a class="float-end btn btn-success" href="{{route('donor.history.download', $donor_info->id)}}">Download</a></h4>
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
                              </div>
                          </td>
                      </tr>
                      @endforelse
                    </table>
                    
                    @if($donors->count())
                    <div class="value" style="text-align: center; width: 100%; padding-top: 15px;">
                      <p><a href="{{route('contact')}}" class="text-danger">If you need more information contact Admin</a></p>
                   </div>
                    @endif

                  </div>
              </div>
          </div>
      </div>
  </div>
</section>


@endsection