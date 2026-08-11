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
    <div class="container customer-container-sm"> 
        <div class="row">
            <section class="col-md-12 page-section">
                 <div class="news-detail-content col-md-6">
                    <div class="img-news">
                        <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$main_newsandevent->img) }}" class="img-responsive">
                    </div>
                </div>
                <div class="news-detail-content col-md-6">
                   <div class="title-news">
                        <h3>{{ $main_newsandevent->title }}</h3>
                        <span class="title-news-bordered"></span>
                    </div>
                    <div class="news-short-description">
                        {!! $main_newsandevent->description !!}
                    </div>
                </div>
            </section>
        </div><!--row-->
    </div><!--container-->
    
      <div class="container">
        <div class="row">
          <section class="col-md-12 page-section">
                <div class="section-banner clearfix">
                    @foreach( $stores as $store )
                    <div class="banner-content col-md-3 no-padding">
                        <a href="{{ $store->maps_url }}" target="_new">
                            <div class="img-banner">
                                <img src="{{ URL::asset('resources/assets/uploads/stores/'.$store->img_2) }}" class="img-responsive">
                            </div>
                            <div class="banner-description">
                                <div class="banner-title">{!! $store->name !!}</div>
                                <div class="banner-subtitle">{!! $store->description !!}</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
   
    <?php /* 
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

        </div><!--row-->
    </div><!--container-->
     */ ?>
   
    @include('templates.parts.footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#home").addClass("active");
        });
    </script>
</body>
</html>