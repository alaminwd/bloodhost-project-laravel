@extends('frontned.master')
@section('links')
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9864771405393849" crossorigin="anonymous"></script>
@endsection
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
                    <h4>Blog Details</h4>
                    <ul class="page-breadcrumb d-flex justify-content-center align-items-center mt-4">
                        <li><i class="fa fa-house "></i><a href="{{route('index')}}">Home</a></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>


<!-- ===========================================
           Blog  Details Part End 
================================================-->
<section class="blog-default section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="blog-details">
                    <div class="details-poster">
                        <img src="{{asset('upload/blog')}}/{{$blog_info->img}}" class="d-block img-fluid" alt="Blog">
                    </div>
                    <div class="blog-post-date">
                        <p><i class="fa-solid fa-clock"></i>{{$blog_info->created_at->format('d-M-Y')}}</p>
                    </div>
                    <h2>{{$blog_info->title}}</h2>
                    <p class="descender">{!!$blog_info->desp!!}</p>

                    <div class="follow_links ">
                        <h4>Follow Us</h4>
                        <div class="social">
                            @foreach ($icons as $icon)
                            <a href="{{$icon->icon_link}}">
                                <i class="{{$icon->icon}}"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

