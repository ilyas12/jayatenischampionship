<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
</head>
<body>
    @include('templates.parts.header')

    <div id="slideshow" class="slider-banner">
        @foreach( $slideshows as $slideshow )
        <a href="{{ $slideshow->url }}">
            <img src="{{ URL::asset('resources/assets/uploads/home_slideshow/'.$slideshow->img) }}" class="img-responsive">
        </a>
        @endforeach
    </div>

    @if ( $download !== '' )
    <div class="download-catalogue">
        <a href="{{ URL::route('download_catalog') }}">
            <i class="fa fa-file-pdf-o"></i>
            <div class="title">Download Catalog</div>
        </a>
    </div>
    @endif

    <div class="container custom-container-lg">
        <div class="row">
            <section class="col-md-12 page-section">
                <div class="section-banner clearfix">
                    @foreach( $banners as $banner )
                    <div class="banner-content col-md-3 no-padding">
                        <a href="{{ $banner->url }}">
                            <div class="img-banner">
                                <img src="{{ URL::asset('resources/assets/uploads/home_banner/'.$banner->img) }}" class="img-responsive">
                            </div>
                            <div class="banner-description">
                                <div class="banner-title">{!! $banner->title !!}</div>
                                <div class="banner-subtitle">{!! $banner->subtitle !!}</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>

            <section class="col-md-12 page-section">
                <div class="col-md-7 col-md-offset-1">
                    <div class="video-wrapper">
                        <iframe src="{{ 'https://www.youtube.com/embed/'.$video }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="video-description col-md-4">
                        <a href="{{ $check_our_video }}" class="btn btn-custom" target="_blank">Check Our Video</a>
                        <div class="video-title">
                            <h3>{!! $video_title !!}</h3>
                        </div>
                        <span class="small-border"></span>
                        <div class="video-subtitle">{!! $video_description !!}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="testimonial-content">
                        <div class="title"><h2>Client Say</h2></div>
                        <span class="small-border"></span>
                        <div class="subtitle">What our client say about us</div>
                        <div id="testimonial-carousel">
                            @foreach( $testimonials as $testimonial )
                            <div class="testimonial-fill">
                                <div class="description">
                                    {!! $testimonial->description !!}
                                </div>
                                <span>{!! $testimonial->name !!}, {!! $testimonial->location !!}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="col-md-12 page-section">
                <div class="col-md-9 instagram-content">
                    {!! $instagram_feed !!}
                </div>

                <div class="col-md-3 instagram-account">
                    <a href="https://www.instagram.com/{{ $instagram_userid }}" target="_blank" class="btn btn-custom">Our Instagram</a>
                    <div class="account-name">#{!! $instagram_hastag !!}</div>
                    <div class="subtitle">
                        {!! $instagram_message !!}
                    </div>
                </div>
            </section>

            <section class="col-md-12 page-section">
                <div class="title-section">
                    <div class="title"><h4>Our Brands</h4></div>
                    <span class="small-border"></span>
                </div>
                <div class="brand-content">
                    <ul id="brand-carousel">
                        @foreach( $brands as $brand )
                        <li class="img-thumb-brand">
                            <a href="{{ $brand->custom_url }}">
                            <img src="{{ URL::asset('resources/assets/uploads/home_brand/'.$brand->img) }}">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div><!--row-->
    </div><!--container-->

    @include('templates.parts.newsletter')
    @include('templates.parts.footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#home").addClass("active");
        });
    </script>
</body>
</html>