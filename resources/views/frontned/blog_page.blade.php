@extends('frontned.master')
@section('links')
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9864771405393849" crossorigin="anonymous"></script>
@endsection

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
              <h4>Blog</h4>
              <ul class="page-breadcrumb d-flex justify-content-center align-items-center mt-4">
                  <li><i class="fa fa-house "></i><a href="{{route('index')}}">Home</a></li>
                  <li>Blog</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
</section>

<!-- ===========================================
             Blog  Latest Donor  Part start 
  ================================================-->

  <section id="blog-list" class="sec-blog-list bg-white pt-5" >
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
                        <a href="{{route('single.blog', $blog->id)}}"><img src="{{asset('upload/blog')}}/{{$blog->img}}" alt="blog-list" class="img-responsive" /></a>
                    </div>
                    <a href="{{route('single.blog', $blog->id)}}">
                        <h5>{{$blog->title}}</h5>
                    </a>
                    <h6>{{$blog->created_at->format('d-M-Y')}}</h6>
                    <a href="{{route('single.blog', $blog->id)}}">Read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="container">
  <div class="row">
      <div class="col-lg">
          <div class="mb-3">
              {{$blogs->links()}}
          </div>
      </div>
  </div>
</div>
@endsection