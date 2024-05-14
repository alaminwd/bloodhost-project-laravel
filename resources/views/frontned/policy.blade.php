@extends('frontned.master')

@section('content')
             <!-- ===========================================
                  banner Part Start 
  ================================================-->
  <section id="about_banner" style="background: linear-gradient(to bottom, rgba(23, 23, 59, 0.9), rgba(23, 23, 59, 0.7)), url('{{asset('/frontend/images/counter.jpg')}}') no-repeat center/cover ;">

   
    <!-- single banner -->
      <div class="container">
        <div class="row">
          <div class="col-lg-8 m-auto">
            <div class="about_banner_content text-center">     
              <h4>Privacy Policy</h4>
              <ul class="page-breadcrumb d-flex justify-content-center align-items-center mt-4">
                  <li><i class="fa fa-house "></i><a href="{{route('index')}}">Home</a></li>
                  <li>Privacy Policy</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
</section>

  <!-- ===========================================
                  policy Part Start 
  ================================================-->
  <section class="blog-default section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                    <div class="blog-details">
                        <p class="descender">{!!$policy_info->desp!!}</p>
                    </div>
            </div>
        </div>
    </div>
  </section>
@endsection