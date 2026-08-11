<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.headv2')
    <!-- for Facebook -->
    <meta property="og:title" content="{{ $newsandevent_detail->title }}" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ URL::asset('resources/assets/uploads/news_and_events/'.$newsandevent_detail->img) }}" />
    <meta property="og:url" content="{{ url('news-and-events/'.$newsandevent_detail->permalink) }}" />
    <meta property="og:description" content="{{ $newsandevent_detail->description }}" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $newsandevent_detail->title }}" />
    <meta name="twitter:description" content="{{ $newsandevent_detail->description }}" />
    <meta name="twitter:image" content="{{ URL::asset('resources/assets/uploads/news_and_events/'.$newsandevent_detail->img) }}" />
</head>
<body>
    @include('templates.parts.headerv2')

    <section class="page-section" style="background: #e5dede;">
        <div class="container custom-container-md">
            <div class="row">
                <div class="title-section">
                    <div class="title"><h4>News & Events Detail</h4></div>
                    <span class="small-border"></span>
                </div>
                <div class="news-section">
                    <div class="news-detail-content col-md-12">
                        <div class="img-news">
                            <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$newsandevent_detail->img) }}" class="img-responsive">
                        </div>
                        @if ( $newsandevent_detail->period_time == 1 )
                        <div class="date-news">{{ date('d F Y', strtotime($newsandevent_detail->start_date)) }} - {{ date('d F Y', strtotime($newsandevent_detail->end_date)) }}</div>
                        @else
                        <div class="date-news">{{ date('d F Y', strtotime($newsandevent_detail->created_at)) }}</div>
                        @endif
                        <div class="title-news">
                            <h3>{{ $newsandevent_detail->title }}</h3>
                            <span class="title-news-bordered"></span>
                        </div>
                        <div class="news-detail-description">
                            {!! $newsandevent_detail->description !!}
                        </div>
                        <hr>
                        {{--<div class="share-icon">
                            <ul>
                                <label>Share this product:</label>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('news-and-events/'.$newsandevent_detail->permalink) }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/home?status={{ url('news-and-events/'.$newsandevent_detail->permalink) }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>--}}
                                {{--<a href="#"><i class="fa fa-pinterest"></i></a>--}}
                                {{--</li>
                            </ul>
                        </div>--}}
                    </div><!--news-detail-content-->
                </div><!--news-section-->

            </div>
        </div><!--row-->
        </div><!--container-->
    </section>

    @include('templates.parts.footerv2')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#news").addClass("active");
        });
    </script>
</body>
</html>