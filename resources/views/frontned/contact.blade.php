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
              <h4>Contact Us</h4>
              <ul class="page-breadcrumb d-flex justify-content-center align-items-center mt-4">
                  <li><i class="fa fa-house "></i><a href="{{route('index')}}">Home</a></li>
                  <li>Contact Us</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
</section>



<!-- ===========================================
          Contact  Part Start 
================================================-->

<section id="contact_us">
  <div class="container">
    <div class="row">
      <div class="title">
        <h2>Contact Us</h2>
      </div>
    </div>
      <div class="row ">
          <div class="col-lg-6 mb-md-5">
             <div class="contact_main">
                    <h2>Get in Touch</h2>
                    <h3>If You Want to Join Us</h3>
                  <div div class="left_item d-flex">
                    <div class="contact_icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="contact_text">
                    <h4>Address :</h4>
                    <p>{{$about_info->address}}</p>
                    </div>
                  </div> 
                  <div div class="left_item d-flex">
                    <div class="contact_icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contact_text">
                    <h4>Whats app :</h4>
                    <p>{{$footer_info->whatsapp}}</p>
                    </div>
                  </div> 
                  <div div class="left_item d-flex">
                    <div class="contact_icon">
                      <i class="fa-brands fa-facebook-f fa"></i>
                    </div>
                    <div class="contact_text">
                    <h4>facebook page :</h4>
                    <a style="font-size: 16px; font-weight: 500; color: #505050;" href="{{$footer_info->facebook}}">{{$footer_info->facebook}}</a>
                    </div>
                  </div> 
                  <div div class="left_item d-flex">
                    <div class="contact_icon">
                      <i class="fas fa-globe-asia"></i>
                    </div>
                    <div class="contact_text">
                    <h4>Website :</h4>
                    <p>{{$footer_info->website}}</p>
                    </div>
                  </div> 
                  <div div class="left_item d-flex">
                    <div class="contact_icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact_text">
                    <h4>E-mail :</h4>
                    <p>{{$footer_info->email}}</p>
                    </div>
                  </div> 
             </div>
          </div>
          <div class="col-lg-6">
              <div class="message">
                <div class="card">
                  <div class="card-body">
                    @if (session('mesg_succ'))
                        <div class="alert alert-success">{{session('mesg_succ')}}</div>
                    @endif
                    <form action="{{route('message.store')}}" method="POST">
                        @csrf
                      <div class="mb-3">
                        <label for="" class="form-label">Name *</label>
                        <input type="text" name="name" class="form-control" >
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" >
                        @error('email')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">Phone *</label>
                        <input type="number" name="phone" class="form-control" >
                        @error('phone')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                      </div>
                      <div class="mb-3"  style="overflow: hidden;">
                        <label for="" class="form-label"> Message *</label>
                       <textarea name="mesg" class="form-control" style="resize: none; height: 190px;" ></textarea>
                       @error('mesg')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                      </div>
                      <div class="mb-3">
                          <button type="submit" class="bt" >Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</section>



@endsection