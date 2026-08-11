<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
</head>
<body>
    @include('templates.parts.header')

    <div class="col-md-12 col-xs-12 img-head-about">
        <img src="{{ URL::asset('resources/assets/images/'.$about_image) }}" class="img-responsive">
    </div>
    <div class="clearfix"></div>

    <div class="container custom-container-sm">
        <div class="row">
            <section class="page-section">
                <div class="title-section">
                    <div class="title"><h4>{{ $about_title }}</h4></div>
                    <span class="small-border"></span>
                </div>
                <div class="col-xs-12 about-content">
                    {!! $about_description !!}
                </div>
            </section>
        </div>
    </div>

    @include('templates.parts.footer')
</body>
</html>