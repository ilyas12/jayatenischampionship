<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
</head>
<body>
    @include('templates.parts.header')

    <div class="container custom-container-lg">
    <div class="row">
        <section class="page-section clearfix">
            <div class="title-section">
                <div class="title"><h4>Our Project</h4></div>
                <span class="small-border"></span>
            </div>

            <div class="nav nav-tabs nav-project col-md-12">
                <div class="listproject-button-carousel">
                    <a href="javascript:void(0)" class="listproject-prev-button prev"><i class="fa fa-chevron-left"></i></a>
                    <a href="javascript:void(0)" class="listproject-next-button next"><i class="fa fa-chevron-right"></i></a>
                </div>

                <ul class="nav-list" id="projectlist-carousel">
                    <li class="nav-menu-item active">
                        <a href="#">All Project</a>
                    </li>
                    @foreach( $categories as $category )
                    <li class="nav-menu-item">
                        <a href="#{{ $category->permalink }}">{{ $category->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            @foreach( $categories as $category )
            <div class="col-md-3 no-padding">
                <div class="category-project-title">
                    <div class="small-breadcrumb">
                        Portfolio /<span>{{ $category->name }}</span>
                    </div>
                    <div class="big-title">
                        {{ $category->name }}
                    </div>
                </div>
            </div>

            @foreach( $projects as $index => $project )
            @if ( $category->id == $project->category_id )
            @if( $index >= 0 && $index <=2  )
            <div class="col-md-3 no-padding">
                <div class="project-content">
                    <div class="img-project">
                        <a href="{{ url('projects/'.$project->permalink) }}">
                            @if( $project->img != null )
                            <img src="{{ URL::asset('resources/assets/uploads/projects/400/'.$project->img) }}" class="img-responsive">
                            @else
                            <img src="{{ URL::asset('resources/assets/images/none_292.png') }}" class="img-responsive">
                            @endif
                        </a>
                    </div>
                    <div class="overlay">
                        <a href="{{ url('projects/'.$project->permalink) }}">
                            <h2>{{ $project->name }}</h2>
                        </a>
                        <p class="icon-links">
                            <a href="{{ url('projects/'.$project->permalink) }}">
                                <span class="fa fa-long-arrow-right"></span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            @else
                <div class="col-md-3 no-padding">
                    <div class="project-content">
                        <div class="img-project">
                            <a href="{{ url('projects/'.$project->permalink) }}">
                                @if( $project->img != null )
                                    <img src="{{ URL::asset('resources/assets/uploads/projects/400/'.$project->img) }}" class="img-responsive">
                                @else
                                    <img src="{{ URL::asset('resources/assets/images/none_292.png') }}" class="img-responsive">
                                @endif
                            </a>
                        </div>
                        <div class="overlay">
                            <a href="{{ url('projects/'.$project->permalink) }}">
                                <h2>{{ $project->name }}</h2>
                            </a>
                            <p class="icon-links">
                                <a href="{{ url('projects/'.$project->permalink) }}">
                                    <span class="fa fa-long-arrow-right"></span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @endif
            @endforeach
            <div class="clearfix project-barrier"></div>
            @endforeach

        </section>
    </div>

    <div id="loadingGif">
        <i class="fa fa-spinner fa-spin"></i>
        <span>Loading More...</span>
    </div>
    </div>

    @include('templates.parts.newsletter')
    @include('templates.parts.footer')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".project-content").slice(0, 7).show();
            $(window).scroll(function () {
                if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
                    $("#loadingGif").show();
                    $(".project-content:hidden").slice(0, 4).slideDown();
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