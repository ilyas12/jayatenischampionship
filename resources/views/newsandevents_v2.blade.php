<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('templates.parts.headv2')
        <style>
 body {
            background: #bdbdbd;
        }
        .news-container {
            padding: 20px;
        }
        .main-news {
            position: relative;
        }
        .main-news img {
            width: 100%;
            height: auto;
            display: block;
        }
        .news-title {
            position: absolute;
            bottom: -5%;
            left: 10%;
            width: 80%;
            background: green;
            color: white;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
        }
        .top-news {
            background: #228B22;
            color: white;
            padding: 15px;
        }
        .top-news h4 {
            margin-bottom: 15px;
            border-bottom: 2px solid white;
            padding-bottom: 5px;
        }
        .top-news-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .top-news-item img {
            width: 80px;
            height: 60px;
            margin-right: 10px;
            border: 2px solid white;
        }
        .top-news-item a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .news-item {
            padding: 15px 0px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }
        
    </style>
</head>
<body> 
    @include('templates.parts.headerv2')

    <section class="page-section" style="background:#e6dfdf">
            <div class="container">
        <div class="news-section">
            <h2 class="news-header">NEWS</h2>
            <div class="row">
                <div class="container news-container">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <div class="main-news">
                                @if ( $main_newsandevent->img_2 != null )
                                    <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$main_newsandevent->img_2) }}" alt="Top News" class="img-responsive">
                                @else
                                    <img src="https://via.placeholder.com/800x400" alt="News Image">
                                @endif
                                <a href="{{ url('news-and-events/'.$main_newsandevent->permalink) }}" class="news-title">{{ $main_newsandevent->title }}</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="top-news">
                                <h4>TOP NEWS</h4>
                                @foreach( $top_newsandevents as $index => $topnews )
                                <div class="top-news-item">
                                     @if ( $topnews->img_2 != null )
                                        <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$topnews->img_2) }}" alt="Top News" class="img-responsive">
                                    @else
                                        <img src="https://via.placeholder.com/80x60" class="img-responsive" alt="Top News">
                                    @endif
                                    <a href="{{ url('news-and-events/'.$topnews->permalink) }}">{{ $topnews->title }}</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container news-container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>More News</h3>
                    </div>
                </div>
                @foreach( $newsandevents as $index => $newsandevent )
                <div class="row news-item">
                    <div class="col-md-6 col-lg-3 col-xs-4">
                        <a href="{{ url('news-and-events/'.$newsandevent->permalink) }}">
                            @if ( $newsandevent->img_2 != null )
                                <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$newsandevent->img_2) }}" class="img-responsive">
                            @else
                                <img src="https://via.placeholder.com/400x200" alt="News Image" class="img-responsive">
                            @endif
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-9 col-xs-8">
                        <h3>{{ $newsandevent->title }}</h3>
                        {!! $newsandevent->short_description !!} 
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>
    </section>

    @include('templates.parts.footerv2')

</body>
</html>