@extends('frontned.master')

@section('content')

  <!-- ===========================================
                  banner Part Start 
  ================================================-->
  <section id="about_banner" style="background: linear-gradient(to bottom, rgba(23, 23, 59, 0.9), rgba(23, 23, 59, 0.7)), url('{{asset('frontend/images/counter.jpg')}}') no-repeat center/cover ;">
    <!-- single banner -->
      <div class="container">
        <div class="row">
          <div class="col-lg-8 m-auto">
            <div class="about_banner_content text-center">     
              <h4>All Donors</h4>
              <ul class="page-breadcrumb d-flex justify-content-center align-items-center mt-4">
                  <li><i class="fa fa-house "></i><a href="{{route('index')}}">Home</a></li>
                  <li>About</li>
              </ul>
            </div>
          </div>
        </div>
     </div>
</section>


 <!-- ===========================================
                 About  Part Start 
  ================================================-->
  <section id="about_part" class="pt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="title">
            <h2>About Us</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 text-start">
          <div class="about_content">
            <h4>{{$about->title1}}</h4>
            <p>{{$about->desp1}}</p>
          </div>
          <div class="row">
            <div class="col-lg-12">
                <div class="about_item d-flex">
                  <div class="about_item_icon">
                    <i class="fa fa-shield-alt"></i>
                  </div>
                  <div class="about_item_content">
                    <h4>{{$about->title2}}</h4>
                    <p>{{$about->desp2}}</p>
                  </div>
                </div>
                <div class="about_item d-flex">
                  <div class="about_item_icon">
                    <i class="fa-regular fa-clock"></i>
                  </div>
                  <div class="about_item_content">
                    <h4>{{$about->title3}}</h4>
                    <p>{{$about->desp3}}</p>
                  </div>
                </div>
                <div class="about_item d-flex">
                  <div class="about_item_icon">
                    <i class="fa fa-shield-alt"></i>
                  </div>
                  <div class="about_item_content">
                    <h4>{{$about->title4}}</h4>
                    <p>{{$about->desp4}}</p>
                  </div>
                </div>
            </div>
          </div>
          <div class="about_btn mt-5">
            <a href="{{route('about')}}">About Us</a>
          </div>
        </div>
        <div class="col-lg-6 col-md-10 m-auto">
          <div class="about_img">
            <img src="{{asset('upload/about')}}/{{$about->about_img}}" class=" w-100 img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===========================================
                  About Part Start 
  ================================================-->
      
 <!-- ===========================================
             Blog  Latest Donor  Part start 
  ================================================--> 

 <section id="blog-list" class="sec-blog-list bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="title">
                    <h2 class="text-center">Latest News</h2>
                </div>
            </div>
        </div>
  
        <div class="row">
          @foreach ($blogs as $blog)
            <div class="col-lg-4 col-12">
                <div class="thumbnail-blog animate">
                    <div class="thumbnail-img">
                        <a href="{{route('single.blog', $blog->id)}}"><img src="{{asset('upload/blog')}}/{{$blog->img}}" alt="blog-list" class="img-responsive"/></a>
                    </div>
                    <a href="{{route('single.blog', $blog->id)}}"><h5>{{$blog->title}}</h5></a>
                    <h6>{{$blog->created_at->format('d-M-Y')}}</h6>
                    <a href="{{route('single.blog', $blog->id)}}">Read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>  
            @endforeach      
        </div>
    </div>
  </section>
  
     <!-- ===========================================
               Blog  Latest Donor  Part End 
    ================================================-->
@endsection