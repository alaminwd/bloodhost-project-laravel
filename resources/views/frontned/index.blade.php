@extends('frontned.master')

@section('content')
<!-- ===========================================
                  banner Part Start 
  ================================================-->
<section id="banner">
    <div class="banner_main">

        <!-- single banner -->
        <div class="banner_slider">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="banner_content text-center">
                            <h1>{{$banner->title}}</h1>
                            <h3>{{$banner->desp}}
                            </h3>
                            @auth('donorlogin')
                            <a href="#">Contact Now</a>
                            @else
                            <a href="{{route('donor.register')}}">Donate Now</a>
                            <a href="{{route('contact')}}">Contact Now</a>
                            @endauth

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single banner -->
        <div class="banner_slider banner2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="banner_content text-center">
                            <h1>{{$banner->title}}</h1>
                            <h3>{{$banner->desp}}
                            </h3>
                            @auth('donorlogin')
                            <a href="#">Contact Now</a>
                            @else
                            <a href="{{route('donor.register')}}">Donate Now</a>
                            <a href="#">Contact Now</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ===========================================
                  banner Part end 
  ================================================-->

<!-- ===========================================
                 Blood Donor Part Start 
  ================================================-->

<section id="blood_doners">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="title">
                    <h2>Avaiable Blood Donors</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ">
            <!-- single item -->
            @foreach ($bloods as $blood)
            <div class="col-lg-3 col-md-3 col-3 g-md-4 g-2">
                    <a href="{{route('same.donor', $blood->id)}}">
                        <div class="blood_main"
                        style="background: linear-gradient(to bottom, rgba(23, 23, 59, 0.9), rgba(23, 23, 59, 0.8)), url('{{asset('frontend/images/about-bg.png')}}') no-repeat center/cover ;">
                        <div class="blood_item">
                            <img src="{{asset('frontend/images/blood-drop.png')}}" width="30" alt="">
                            <h5 class="blood_single_name">{{$blood->blood_group}}</h5>
                        </div>
                        @php
                        $blood_donors = App\Models\Donor::where('blood_id', $blood->id)->count();
                        @endphp
                        <span class="blood_amount">({{$blood_donors}})</span>
                    </div>
                    </a>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- ===========================================
                 Blood Donor Part End
  ================================================-->


<!-- ===========================================
                 About  Part Start 
  ================================================-->
<section id="about_part">
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
                 Donors Part Start 
 ================================================-->

<section id="our_donor">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="title">
                    <h2>Our Blood Donors</h2>
                </div>
            </div>
        </div>

        <div class="donors_slider">
            @foreach ($donors as $donor)
            <div class="donor_item">
                <a href="{{route('donor.info', $donor->id)}}">
                    <div class="donor_img">
                        @if ($donor->donor_img ==null)
                        <img src="{{asset('frontend/images/donor-img-null .jpg')}}" class="img_fulid w-100" alt="">
                        @else
                        <img src="{{asset('upload/donor')}}/{{$donor->donor_img}}" class="img_fulid w-100" alt="">
                        @endif
                    </div>
                    <div class="donor_text">
                        <div class="donor_text_boody">
                            <h4>{{$donor->name}}</h4>
                            <p>Blood Group : ({{$donor->rel_to_blood->blood_group}})</p>
                        </div>
                        <div class="donor_text_btn">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===========================================
                Counter Part Start 
  ================================================-->

<section id="counter_part"
    style="background: linear-gradient(to bottom, rgba(23, 23, 59, 0.9), rgba(23, 23, 59, 0.7)), url('{{asset('frontend/images/counter.jpg')}}') no-repeat center/cover ;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="title">
                    <h2 class="text-white">Our Achievements</h2>
                </div>
            </div>
        </div>
        <div class="counter_gap">
            <div class="row">
                @foreach ($counters as $counter)
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="counter_item text-center">
                        <i class="{{$counter->icon}} d-block"></i>
                        <span class="counter mt-3">{{$counter->number}}</span>
                        <h4 class="text-capitalize mt-3">{{$counter->title}}</h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ===========================================
              Blood Donation Process Part Start 
  ================================================-->
<section id="donation_process">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto">
                <div class="title smallfon">
                    <h2 class="text-center">The Blood Donation Process</h2>
                </div>
            </div>
        </div>
        <div class="blood_donation_process pb-5">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6 ">
                    <div class="process_info">
                        <div class="process_icon">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <h4>Refreshment</h4>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
                    <div class="process_info">
                        <div class="process_icon">
                            <i class="fa-solid fa-stethoscope"></i>
                        </div>
                        <h4>Blood Donation</h4>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
                    <div class="process_info">
                        <div class="process_icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h4>Health History</h4>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
                    <div class="process_info">
                        <div class="process_icon">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h4>Registation</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
<!-- ===========================================
              Blood Donation Process Part End 
  ================================================-->

<!-- ===========================================
                Donor Review Part Start 
  ================================================-->
<section id="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="title">
                    <h2 class="text-center">Donor Review</h2>
                </div>
            </div>
        </div>
        <div class="test_main">
            <div class="row test_row ">

                @foreach ($reviews as $review)
                <div class="col-lg-4">
                    <div class="test_col">
                        <div class="test_item">
                            <div class="test_shape_top"></div>
                            <div class="test_shape_bottom"></div>
                            <div class="test_content">
                                <h3>{{$review->name}}</h3>
                                <h4>From {{$review->address}}</h4>
                            </div>
                            <p>{{$review->desp}}</p>
                            <div class="test_img">
                                <img src="{{asset('upload/review')}}/{{$review->picture}}" class="w-100 img-fluid"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- ===========================================
               Donor Review  Part End 
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

        <div class="row blog_row">
            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-12">
                <div class="thumbnail-blog animate">
                    <div class="thumbnail-img">
                        <a href="{{route('single.blog', $blog->id)}}"><img src="{{asset('upload/blog')}}/{{$blog->img}}"
                                alt="blog-list" class="img-responsive" /></a>
                    </div>
                    <a href="{{route('single.blog', $blog->id)}}">
                        <h5>{{$blog->title}}</h5>
                    </a>
                    <h6>{{$blog->created_at->format('d-M-Y')}}</h6>
                    <a href="{{route('single.blog', $blog->id)}}">Read more <i class="fa fa-long-arrow-right"
                            aria-hidden="true"></i></a>
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
