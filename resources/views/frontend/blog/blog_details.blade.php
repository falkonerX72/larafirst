@extends('frontend.frontend_dashboard')
@section('main')
<!--Page Title-->
<section class="page-title centred" style="background-image: url(assets/images/background/page-title-5.jpg);">
<div class="auto-container">
<div class="content-box clearfix">
<h1>Blog Details</h1>
<ul class="bread-crumb clearfix">
<li><a href="index.html">Home</a></li>
<li>{{ $blog->post_slug }}</li>
</ul>
</div>
</div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
<div class="auto-container">
<div class="row clearfix">
<div class="col-lg-8 col-md-12 col-sm-12 content-side">
<div class="blog-details-content">
<div class="news-block-one">
<div class="inner-box">
<div class="image-box">
<figure class="image"><img src="assets/images/news/news-21.jpg" alt="">
</figure>
<span class="category">Featured</span>
</div>
<div class="lower-content">
<h3>{{ $blog->post_title }}.</h3>
<ul class="post-info clearfix">
<li class="author-box">
<figure class="author-thumb"><img
src="{{ !empty($blog->user->photo) ? url('upload/admin_images/' . $blog->user->photo) : url('upload/no_image.jpg') }}"
alt=""></figure>
<h5>{{ $blog['user']['name'] }}</h5>
</li>
<li>{{ $blog->created_at->format('M d Y') }}</li>
</ul>
<div class="text">
<p>{!! $blog->long_descp !!} </p>

<blockquote>
<h4>“{{ $blog->short_descp }}”</h4>
</blockquote>

</div>
<div class="post-tags">
<ul class="tags-list clearfix">
<li>
<h5>Tags:</h5>
</li>
@foreach ($tags as $tag)
<li><a href="#">{{ ucwords($tag) }}</a></li>
@endforeach
</ul>
</div>
</div>
</div>
</div>
<div class="comments-area">
<div class="group-title">
<h4>{{ count($comment) }}</h4>
</div>

<div class="comment-box">
@foreach ($comment as $cm)
<div class="comment">
<figure class="thumb-box">
<img src="{{ !empty($cm->user->photo) ? url('upload/user_images/' . $cm->user->photo) : url('upload/no_image.jpg') }}"
alt="">
</figure>
<div class="comment-inner">
<div class="comment-info clearfix">
<h4>{{ $cm->subject }}</h4>
<span>{{ $cm->created_at->format('M d Y') }}</span>
</div>
<div class="text">

<p>{{ $cm->message }}</p>
<a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>
</div>
</div>
</div>
@php
$reply = App\Models\comment::where('parent_id', $cm->id)
->limit(5)
->get();
@endphp
@foreach ($reply as $re)
<div class="comment replay-comment">
<figure class="thumb-box">
<img src="{{ url('upload/admin.jpg') }}" style="width: 80px; height:80px;"
alt="">
</figure>
<div class="comment-inner">
<div class="comment-info clearfix">
<h5>{{ $re->subject }}</h5>
<span>{{ $re->created_at->format('M d Y') }}</span>
</div>
<div class="text">

<p>{{ $re->message }}</p>
<a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>
</div>
</div>
</div>
@endforeach
@endforeach
</div>

</div>
<div class="comments-form-area">
<div class="group-title">
<h4>Leave a Comment</h4>
</div>
@auth
@php
$id = Auth::user()->id;
$userData = App\Models\User::find($id);
@endphp
<form action="{{ route('store.comment') }}" method="post" class="comment-form default-form">
@csrf
<input type="hidden" name="post_id" value="{{ $blog->id }}">
<div class="row">


<div class="col-lg-12 col-md-12 col-sm-12 form-group">
<input type="text" name="subject" placeholder="Subject" required=""
value="">
</div>
<div class="col-lg-12 col-md-12 col-sm-12 form-group">
<textarea name="message" placeholder="Your message" value=""></textarea>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
<button type="submit" class="theme-btn btn-one">Submit Now</button>
</div>
</div>
</form>
@else
<p><b>U need to <a href="{{ route('login') }}">Login</a> first to leave comment!</b>
</p>
@endauth
</div>
</div>
</div>
<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
<div class="blog-sidebar">
<div class="sidebar-widget search-widget">
<div class="widget-title">
<h4>Search</h4>
</div>
<div class="search-inner">
<form action="blog-1.html" method="post">
<div class="form-group">
<input type="search" name="search_field" placeholder="Search" required="">
<button type="submit"><i class="fas fa-search"></i></button>
</div>
</form>
</div>
</div>
<div class="sidebar-widget social-widget">
<div class="widget-title">
<h4>Follow Us On</h4>
</div>
<ul class="social-links clearfix">
<li><a href="blog-1.html"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="blog-1.html"><i class="fab fa-google-plus-g"></i></a></li>
<li><a href="blog-1.html"><i class="fab fa-twitter"></i></a></li>
<li><a href="blog-1.html"><i class="fab fa-linkedin-in"></i></a></li>
<li><a href="blog-1.html"><i class="fab fa-instagram"></i></a></li>
</ul>
</div>
<div class="sidebar-widget category-widget">
<div class="widget-title">
<h4>Category</h4>
</div>
<div class="widget-content">
<ul class="category-list clearfix">
@foreach ($category as $categories)
@php
$post = App\Models\BlogPost::where('blogcat_id', $categories->id)->get();
@endphp
<li>
<a href="{{ url('blog/cat/list/' . $categories->id) }}">{{ $categories->category_name }}
<span>({{ count($post) }})</span></a>
</li>
@endforeach

</ul>
</div>
</div>
<div class="sidebar-widget post-widget">
<div class="widget-title">
<h4>Recent Posts</h4>
</div>
<div class="post-inner">
@foreach ($dpost as $posts)
<div class="post">
<figure class="post-thumb"><a href="blog-details.html"><img
src="{{ asset($posts->post_image) }}" alt=""></a></figure>
<h5><a href="blog-details.html">{{ $posts->post_title }}.</a></h5>
<span class="post-date">{{ $posts->created_at->format('M d Y') }}</span>
</div>
@endforeach

</div>
<div class="sidebar-widget category-widget">
<div class="widget-title">
<h4>Archives</h4>
</div>
<div class="widget-content">
<ul class="category-list clearfix">
<li><a href="blog-details.html">November 2016<span>(9)</span></a></li>
<li><a href="blog-details.html">November 2017<span>(5)</span></a></li>
<li><a href="blog-details.html">November 2018<span>(2)</span></a></li>
<li><a href="blog-details.html">November 2019<span>(7)</span></a></li>
<li><a href="blog-details.html">November 2020<span>(3)</span></a></li>
</ul>
</div>
</div>
<div class="sidebar-widget tags-widget">
<div class="widget-title">
<h4>Popular Tags</h4>
</div>
<div class="widget-content">
<ul class="tags-list clearfix">
<li><a href="blog-details.html">Real Estate</a></li>
<li><a href="blog-details.html">HouseHunting</a></li>
<li><a href="blog-details.html">Architecture</a></li>
<li><a href="blog-details.html">Interior</a></li>
<li><a href="blog-details.html">Sale</a></li>
<li><a href="blog-details.html">Rent Home</a></li>
<li><a href="blog-details.html">Listing</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- sidebar-page-container -->

<!-- subscribe-section -->
<section class="subscribe-section bg-color-3">
<div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
<div class="auto-container">
<div class="row clearfix">
<div class="col-lg-6 col-md-6 col-sm-12 text-column">
<div class="text">
<span>Subscribe</span>
<h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 form-column">
<div class="form-inner">
<form action="contact.html" method="post" class="subscribe-form">
<div class="form-group">
<input type="email" name="email" placeholder="Enter your email" required="">
<button type="submit">Subscribe Now</button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<!-- subscribe-section end -->
@endsection
