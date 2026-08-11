<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
</head>
<body>
    @include('templates.parts.header')

    <div class="container custom-container-md">
        <div class="row">
            <section class="page-section clearfix">
                <div class="title-section">
                    <div class="title"><h4>Our Stores</h4></div>
                    <span class="small-border"></span>
                </div>

                <div class="col-lg-12 col-md-12 col-xs-12 main-store-section">
                    <div class="img-stores">
                        <img src="{{ URL::asset('resources/assets/uploads/stores/'.$main_store->img) }}" class="img-responsive">
                    </div>
                    <div class="content-wrapper">
                        <div class="name-store">
                            {{ $main_store->name }}
                        </div>
                        <div class="info-store">
                            {!! $main_store->description !!}
                        </div>
                        <a href="{{ $main_store->maps_url }}" target="_blank" class="btn btn-custom">See Map</a>
                    </div>
                </div>

                <div class="col-md-12 list-store-section">
                    @foreach( $stores as $index => $store )
                    @if ( $index % 3 == 2 )
                    <div class="col-md-4 store-list-content">
                        <div class="img-stores">
                            @if ( $store->img_2 != null )
                            <img src="{{ URL::asset('resources/assets/uploads/stores/'.$store->img_2) }}" class="img-responsive">
                            @else
                            <img src="{{ URL::asset('resources/assets/images/none_370_293.png')}}" class="img-responsive">
                            @endif
                        </div>
                        <div class="name-store">
                            {{ $store->name }}
                        </div>
                        <div class="info-store">
                            {!! $store->description !!}
                        </div>
                        <a href="{{ $store->maps_url }}" target="_blank" class="btn btn-custom">See Map</a>
                    </div>

                            <div class="clearfix"></div>
                    @else
                    <div class="col-md-4 store-list-content">
                        <div class="img-stores">
                            @if ( $store->img_2 != null )
                            <img src="{{ URL::asset('resources/assets/uploads/stores/'.$store->img_2) }}" class="img-responsive">
                            @else
                            <img src="{{ URL::asset('resources/assets/images/none.png')}}" class="img-responsive">
                            @endif
                        </div>
                        <div class="name-store">
                            {{ $store->name }}
                        </div>
                        <div class="info-store">
                            {!! $store->description !!}
                        </div>
                        <a href="{{ $store->maps_url }}" target="_blank" class="btn btn-custom">See Map</a>
                    </div>
                    @endif
                    @endforeach
                </div><!-- testimonial list-->
            </section>
        </div>
    </div>

    @include('templates.parts.newsletter')
    @include('templates.parts.footer')
</body>
</html>