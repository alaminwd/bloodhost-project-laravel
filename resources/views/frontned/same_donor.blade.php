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
                <h4>All Donors</h4>
                <ul class="page-breadcrumb d-flex justify-content-center align-items-center mt-4">
                    <li><i class="fa fa-house "></i><a href="{{route('index')}}">Home</a></li>
                    <li>All Donors</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>

<!-- ===============================
Donors Deatilsa Part 
====================================-->
<section id="donors_info">
<div class="container">
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="row mt-5">
                @forelse ($blood_info as $donor)
                <div class="col-lg-6 col-md-6">
                    <div class="card mb-3">
                            <div class="card-body d-flex">
                                @if ($donor->donor_img == null)
                                <img src="{{asset('frontend/images/donor-img-null .jpg')}}" class="img-fluid rounded-start" alt="...">
                                @else
                                <img src="{{asset('upload/donor')}}/{{$donor->donor_img}}" class="img-fluid rounded-start" alt="...">
                                @endif
                                <div class="donors_content">
                                    <h4 class="card-title">{{$donor->name}}</h4>
                                    <ul>
                                        <li><i class="fas fa-map-marker-alt" style="color: #575555;"></i>District : {{$donor->city_id != null?$donor->rel_to_city->city_name:'NA' }}</li>
                                        <li><i class="fas fa-tint" style="color: #FF0000;"></i>Blood Group : <span
                                                class="">({{$donor->rel_to_blood->blood_group}})</span></li>
                                        <li><a href="{{route('donor.info', $donor->id)}}">view profile</a><i class="fas fa-arrow-right next"></i></li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-10 m-auto">
                    <h3 class="text-center" style="color: #00194c; font-size: 40px; font-weight:600;">Ops! No results found</h3>
                    <p class="text-center" style="color: #334770; margin-top: 20px; font-size: 18px; font-weight: 500;">We couldn’t find what you searched for. Try searching again or <a href="{{route('donor')}}">Back Here</a></p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</section>
<div class="container">
<div class="row">
    <div class="col-lg">
        <div class="mb-3">
            {{$blood_info->links()}}
        </div>
    </div>
</div>
</div>
@endsection