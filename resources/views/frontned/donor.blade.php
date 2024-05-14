@extends('frontned.master')

@section('content')
<!-- ===========================================
                  banner Part Start 
  ================================================-->
<section id="about_banner" class="donor_banner" style="background: linear-gradient(to bottom, rgba(23, 23, 59, 0.9), rgba(23, 23, 59, 0.7)), url('{{asset('frontend/images/counter.jpg')}}') no-repeat center/cover ;">
    <!-- single banner -->
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
        <div class="col-lg-12">
            
                <div class="search">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                           <div class="search_item">
                            <label class="form-label">Blood gruop</label>
                            <select class="form-control" class="blood_id" id="blood_id">
                                <option value="">--select blood group--</option>
                                @foreach ($blood_info as $blood)
                                <option value="{{$blood->id}}">{{$blood->blood_group}}</option>
                                @endforeach
                            </select>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div class="search_item">
                            <label class="form-label">District</label>
                            <select class="custom-select form-control city_id" id="city_id">
                                <option value="">--select blood district--</option>
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                                @endforeach
                            </select>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div class="search_item">
                            <label class="form-label">Upazila</label>
                            <select class=" custom-select form-control subcity_id" id="subcity_id">
                                <option value="">--select upazila--</option>
                                
                            </select>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <button style="margin-top: 32px;" id="search_btn" class="btn btn-danger form-control">Search</button>
                        </div>
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
                    @forelse ($donors as $donor)
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
                            <h3 class="text-center" style="color: #00194c; font-size: 40px; font-weight:600; line-hieght:45px">Ops! No results found</h3>
                            <p class="text-center" style="color: #334770; margin-top: 20px; font-size: 18px; font-weight: 500; line-hieght:30px">We couldn’t find what you searched for. Try searching again or <a href="{{route('donor')}}">Back Here</a></p>
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
                {{$donors->links()}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <script>
      // Select 2
  $(document).ready(function() {
      $('.city_id').select2();
      $('.subcity_id').select2();
  });
  </script>

  <script>

    $('#search_btn').click(function(){
        var blood_id = $('#blood_id').val();
        var city_id = $('#city_id').val();
        var subcity_id = $('#subcity_id').val();
        var link = '{{route('donor')}}'+'?blood_id='+blood_id+'&city_id='+city_id+'&subcity_id='+subcity_id;
        window.location.href = link;
    });

  </script>
  <script>
    $('#city_id').change(function(){
        city_id = $(this).val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getSubcities',
            data:{'city_id': city_id},
            success:function(data){
                $('.subcity_id').html(data);
           }
        });

    });
  </script>

@endsection
