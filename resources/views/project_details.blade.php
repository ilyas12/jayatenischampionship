<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
    <!-- for Facebook -->
    <meta property="og:title" content="{{ $project_detail->name }}" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ URL::asset('resources/assets/uploads/projects/400/'.$project_detail->img) }}" />
    <meta property="og:url" content="{{ url('projects/'.$project_detail->permalink) }}" />
    <meta property="og:description" content="{{ $project_detail->description }}" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $project_detail->name }}" />
    <meta name="twitter:description" content="{{ $project_detail->description }}" />
    <meta name="twitter:image" content="{{ URL::asset('resources/assets/uploads/projects/400/'.$project_detail->img) }}" />
</head>
<body>
    @include('templates.parts.header')

    <div class="container custom-container-sm">
        <div class="row">
            <section class="page-section col-md-12 clearfix">
                <div class="col-md-3 no-padding">
                    <div class="detail-project red-box-title">
                        <div class="small-breadcrumb">
                            Portfolio /<br>Residences /<span>Velvet Residences</span>
                        </div>
                        <div class="link-wrapper">
                            <a href="{{ URL::route('projects') }}">
                                <i class="fa fa-long-arrow-left"></i>
                                <span>Back to project page</span>
                            </a>
                        </div>
                    </div>

                    <div class="project-detail-paginate">
                        @if( $project_detail_main_image != null )
                        <span class="number-paginate">01/{{ sprintf("%02d", $project_detail_total_images) }}</span>
                        <ul>
                            <a href="#"><li class="button-prev"></li></a>
                            <a href="#"><li class="button-next"></li></a>
                        </ul>
                        @endif
                    </div>
                </div>

                <div class="col-md-9 no-padding">
                    <div class="img-project-detail">
                        @if( $project_detail_main_image != null )
                        <img src="{{ URL::asset('resources/assets/uploads/projects/400/'.$project_detail_main_image->img) }}" class="img-responsive">
                        @else
                        <img src="{{ URL::asset('resources/assets/images/none_1280_768.png') }}" class="img-responsive">
                        @endif
                    </div>

                    <div class="project-detail-content">
                        <div class="pagedetail-date">{{ date('d F Y', strtotime($project_detail->created_at)) }}</div>
                        <div class="pagedetail-title">
                            <div class="title">{{ $project_detail->name }}</div>
                            <span class="pagedetail-title-bordered"></span>
                        </div>

                        <div class="pagedetail-description">
                        {!! $project_detail->description !!}
                        </div>
                        <hr>
                        <div class="share-icon">
                            <ul>
                                <label>Share this product:</label>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('projects/'.$project_detail->permalink) }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/home?status={{ url('projects/'.$project_detail->permalink) }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                </li>
                                {{--<li>--}}
                                {{--<a href="#"><i class="fa fa-pinterest"></i></a>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                    </div><!--project-detail-content-->
                </div>
            </section>
        </div>
    </div>

    @include('templates.parts.newsletter')
    @include('templates.parts.footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#project").addClass("active");
        });
    </script>
</body>
</html>