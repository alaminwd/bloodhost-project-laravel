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
                  <li> Register</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
</section>




<!-- ===========================================
            Login Form  Part 
================================================-->
  <section id="simple-form">
      <div class="container">
          <div class="row">
            
              <div class="col-lg-6 col-md-6 m-auto">
                <div class="user_form">
                   <div class="card-header">
                        <h3>Registation Form</h3>
                   </div>
                   @if (session('verify'))
                       <div class="alert alert-success">{{session('verify')}}</div>
                   @endif
                   <div class="card-body">
                        <form action="{{route('donor.store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name *</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control">
                                @error('email')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="number" name="phone" class="form-control">
                                @error('phone')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Blood Group *</label>
                                <select name="blood_id" class="form-select">
                                   <option value="">--select any--</option>
                                    @foreach ($bloods as $blood)
                                    <option value="{{$blood->id}}">{{$blood->blood_group}}</option>
                                    @endforeach
                                </select>
                                @error('blood_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password *</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">SingUp</button>
                            </div>
                            <strong class="text-center d-block mt-4">Have an account <a href="{{route('donor.login.page')}}">Login</a></strong>
                        </form>
                   </div>
                </div>
            </div>
          </div>
      </div>
  </section>
@endsection