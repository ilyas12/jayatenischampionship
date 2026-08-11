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
                    <div class="title"><h4>{{ $brand }}</h4></div>
                    <span class="small-border"></span>
                </div>

                <div class="col-xs-12 filter-product">
                    <div class="filter-collapse-parent">
                        <div class="first-collapse">
                            <div class="filter-title">
                                Filter
                            </div>
                            <div class="filter-open-icon">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </div>

                        <ul class="filter-parent-list-menu">
                            <li class="filter-collapse-child">
                                <a href="#">By Product</a>
                                <div class="filter-child-open-icon">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                                <ul class="filter-child-list-menu">
                                    <li><a href="#">All Brand</a></li>
                                </ul>
                            </li>
                            <li class="filter-collapse-child">
                                <a href="#">By Brand</a>
                                <div class="filter-child-open-icon">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                                <ul class="filter-child-list-menu">
                                    <li><a href="#" class="active">All Brand</a></li>
                                    <li><a href="#">Armani Casa</a></li>
                                    <li><a href="#">Martha Stewart Living</a></li>
                                    <li><a href="#">Williams Sonoma</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                @if ( count($products) !== 0 )
                    @foreach( $products as $index => $product )
                        @if( $index % 4 == 3 )
                        <div class="product-content col-md-3 col-xs-6">
                            <a href="{{ url('products/'.$product->permalink) }}">
                                <div class="img-product">
                                    <img src="{{ URL::asset('resources/assets/uploads/products/400/'.$product->img) }}" class="img-responsive">
                                </div>
                                <div class="product-description">
                                    <div class="product-title">{{ $product->name }}</div>
                                    <span class="small-border"></span>
                                    <div class="subtitle">Distribution of fluids at temperatures of 130C and above.</div>
                                </div>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        @else
                        <div class="product-content col-md-3 col-xs-6">
                            <a href="{{ url('products/'.$product->permalink) }}">
                                <div class="img-product">
                                    <img src="{{ URL::asset('resources/assets/uploads/products/400/'.$product->img) }}" class="img-responsive">
                                </div>
                                <div class="product-description">
                                    <div class="product-title">{{ $product->name }}</div>
                                    <span class="small-border"></span>
                                    <div class="subtitle">Distribution of fluids at temperatures of 130C and above.</div>
                                </div>
                            </a>
                        </div>
                        @endif
                    @endforeach
                @else
                    <p>There is no product for this brand..</p>
                @endif
            </section>
        </div>
        @if ( count($products) !== 0 )
        <div id="loadingGif">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Loading More...</span>
        </div>
        @endif
    </div>

    @include('templates.parts.newsletter')
    @include('templates.parts.footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#product").addClass("active");
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".product-content").slice(0, 8).show();
            $(window).scroll(function () {
                if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
                    $("#loadingGif").show();
                    $(".product-content:hidden").slice(0, 4).slideDown();
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