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
              <h4>Login or Register</h4>
              <ul class="page-breadcrumb d-flex justify-content-center align-items-center mt-4">
                  <li><i class="fa fa-house "></i><a href="{{route('index')}}">Home</a></li>
                  <li>Login</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
</section>


    <section id="simple-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 m-auto">
                    <div class="user_form">
                       <div class="card-header">
                            <h3>Login Form</h3>
                       </div>
                      
                       @if (session('register_now'))
                           <div class="alert alert-danger">{{session('register_now')}}</div>
                       @endif 
                       @if (session('verify'))
                           <div class="alert alert-danger">{{session('verify')}}</div>
                       @endif 
                       <div class="card-body">
                            <form action="{{route('email.verify.req.sent')}}" method="POST">
                              @csrf
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('donor_email')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Send Request</button>
                                </div>
                            </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection