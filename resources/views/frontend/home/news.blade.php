<section class="news-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>News & Article</h5>
            <h2>Stay Update With Realshed</h2>

        </div>
        <div class="row clearfix">


            @foreach ($blog_posts as $blog)
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="blog-details.html"><img
                                            src="{{ asset($blog->post_image) }}" alt=""></a></figure>
                                <span class="category">New</span>
                            </div>
                            <div class="lower-content">
                                <h4><a href="blog-details.html">{{ $blog->post_title }}</a></h4>
                                <ul class="post-info clearfix">
                                    <li class="author-box">
                                        <figure class="author-thumb"><img
                                                src="{{ !empty($blog->user->photo) ? url('upload/admin_images/' . $blog->user->photo) : url('upload/no_image.jpg') }}"
                                                alt=""></figure>
                                        <h5><a href=" ">{{ $blog['user']['name'] }}</a></h5>
                                    </li>
                                    <li>{{ $blog->created_at->format('M d Y') }}</li>
                                </ul>
                                <div class="text">
                                    <p> {{ $blog->short_descp }}</p>
                                </div>
                                <div class="btn-box"><a href="{{ url('blog/details/' . $blog->post_slug) }}"
                                        class="theme-btn btn-two">See Details</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    </div>
</section>
