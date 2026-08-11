<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
</head>
<body>
    @include('templates.parts.header')

    <section class="page-section">
        <div class="container custom-container-md">
            <div class="row">
                <div class="title-section">
                    <div class="title"><h4>News & Events</h4></div>
                    <span class="small-border"></span>
                </div>
                <div class="news-section">
                    <div class="headline-news col-md-12">
                        <div class="img-news">
                            <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$main_newsandevent->img) }}" class="img-responsive">
                            </a>
                        </div>
                        @if ( $main_newsandevent->period_time == 1 )
                        <div class="date-news">{{ $main_newsandevent->start_date?->format('d F Y') }} - {{ $main_newsandevent->end_date?->format('d F Y') }}</div>
                        @else
                        <div class="date-news">{{ $main_newsandevent->created_at?->format('d F Y') }}</div>
                        @endif
                        <div class="title-news">
                            <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                <h3>{{ $main_newsandevent->title }}</h3>
                            </a>
                        </div>
                        <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}" class="btn btn-custom">Read More</a>
                    </div><!--headline-news-->

                    <div class="list-news">
                        @foreach( $newsandevents as $index => $newsandevent )
                        @if ( $index % 3 == 2 )
                        @if ( $newsandevent->period_time == 1 )
                        @if ( date('Y-m-d') >= $newsandevent->start_date && date('Y-m-d') <= $newsandevent->end_date )
                        <div class="news-content col-md-4">
                            <div class="img-news-list">
                                <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                    @if ( $newsandevent->img_2 != null )
                                    <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$newsandevent->img_2) }}" class="img-responsive">
                                    @else
                                    <img src="{{ URL::asset('resources/assets/images/none_360_255.png')}}" class="img-responsive">
                                    @endif
                                </a>
                            </div>
                            <div class="date">{{ $newsandevent->created_at?->format('d F Y') }}</div>
                            <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                <h4>{{ $newsandevent->title }}</h4>
                            </a>
                            <a href="{{ url('news-and-events/'.$newsandevent->permalink) }}" class="btn btn-custom">Read More</a>
                        </div>
                        <div class="clearfix"></div>
                        @endif
                        @else
                        <div class="news-content col-md-4">
                            <div class="img-news-list">
                                <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                    @if ( $newsandevent->img_2 != null )
                                        <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$newsandevent->img_2) }}" class="img-responsive">
                                    @else
                                        <img src="{{ URL::asset('resources/assets/images/none_360_255.png')}}" class="img-responsive">
                                    @endif
                                </a>
                            </div>
                            <div class="date">{{ $newsandevent->created_at?->format('d F Y') }}</div>
                            <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                <h4>{{ $newsandevent->title }}</h4>
                            </a>
                            <a href="{{ url('news-and-events/'.$newsandevent->permalink) }}" class="btn btn-custom">Read More</a>
                        </div>
                        <div class="clearfix"></div>
                        @endif
                        @else
                        @if ( $newsandevent->period_time == 1 )
                        @if ( date('Y-m-d') >= $newsandevent->start_date && date('Y-m-d') <= $newsandevent->end_date )
                        <div class="news-content col-md-4">
                            <div class="img-news-list">
                                <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                    @if ( $newsandevent->img_2 != null )
                                        <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$newsandevent->img_2) }}" class="img-responsive">
                                    @else
                                        <img src="{{ URL::asset('resources/assets/images/none_360_255.png')}}" class="img-responsive">
                                    @endif
                                </a>
                            </div>
                            <div class="date">{{ $newsandevent->start_date?->format('d F Y') }} - {{ $newsandevent->end_date?->format('d F Y') }}</div>
                            <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                <h4>{{ $newsandevent->title }}</h4>
                            </a>
                            <a href="{{ url('news-and-events/'.$newsandevent->permalink) }}" class="btn btn-custom">Read More</a>
                        </div>
                        @endif
                        @else
                        <div class="news-content col-md-4">
                            <div class="img-news-list">
                                <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                    @if ( $newsandevent->img_2 != null )
                                        <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$newsandevent->img_2) }}" class="img-responsive">
                                    @else
                                        <img src="{{ URL::asset('resources/assets/images/none_360_255.png')}}" class="img-responsive">
                                    @endif
                                </a>
                            </div>
                            <div class="date">{{ $newsandevent->created_at?->format('d F Y') }}</div>
                            <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}">
                                <h4>{{ $newsandevent->title }}</h4>
                            </a>
                            <a href="{{ url('news-and-events/'.$newsandevent->permalink) }}" class="btn btn-custom">Read More</a>
                        </div>
                        @endif
                        @endif
                        @endforeach
                    </div><!--list-news-->
                    <div class="clearfix"></div>
                    <div id="loadingGif">
                        <i class="fa fa-spinner fa-spin"></i>
                        <span>Loading More...</span>
                    </div>

                </div><!--news-section-->
            </div><!--row-->
        </div><!--container-->
    </section>

    @include('templates.parts.footer')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".news-content").slice(0, 6).show();
            $(window).scroll(function () {
                if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
                    $("#loadingGif").show();
                    $(".news-content:hidden").slice(0, 3).slideDown();
                };
                $loadingGif = $("#loadingGif");
                setTimeout(function () {
                    $loadingGif.hide();
                }, 2000);
            });
        });
    </script>
</body>
</html>