<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
    <!-- for Facebook -->
    <meta property="og:title" content="{{ $product_detail->name }}" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ URL::asset('resources/assets/uploads/products/400/'.$product_detail->img) }}" />
    <meta property="og:url" content="{{ url('products/'.$product_detail->permalink) }}" />
    <meta property="og:description" content="{{ $product_detail->subtitle }}" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $product_detail->name }}" />
    <meta name="twitter:description" content="{{ $product_detail->subtitle }}" />
    <meta name="twitter:image" content="{{ URL::asset('resources/assets/uploads/products/400/'.$product_detail->img) }}" />
</head>
<body>
    @include('templates.parts.header')

    <section class="page-section">
        <div class="container custom-container-md">
            <div class="row">

                <div class="title-section">
                    <div class="title"><h4>Product Detail</h4></div>
                    <span class="small-border"></span>
                </div>

                <div class="col-md-12">
                    <div class="product-detail-content clearfix">
                        <div class="col-md-6">
                            <a href="{{ URL::route('products') }}" class="link-back">
                                <i class="fa fa-long-arrow-left"></i> Back to product page
                            </a>
                            <div class="img-product-large">
                                <img src="{{ URL::asset('resources/assets/uploads/products/400/'.$product_detail->img) }}" class="img-responsive image-zoom" data-zoom-image="{{ URL::asset('resources/assets/uploads/products/400/'.$product_detail->img) }}">
                            </div>

                            <div class="img-product-thumbnail">
                                <div class="button-carousel">
                                    <a href="javascript:void(0)" class="prev-button prev"><i class="fa fa-chevron-left"></i></a>
                                    <a href="javascript:void(0)" class="next-button next"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <ul id="img-thumb-carousel">
                                    @foreach( $product_detail_images as $pdi )
                                    <li>
                                        <a href="{{ URL::asset('resources/assets/uploads/products/400/'.$pdi->img) }}" class="img-thumb" data-zoom="{{ URL::asset('resources/assets/uploads/products/400/'.$pdi->img) }}">
                                            <img src="{{ URL::asset('resources/assets/uploads/products/400/'.$pdi->img) }}" class="img-responsive">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--col-md-5 col-md-offset-1-->

                        <div class="col-md-6 clearfix">
                            <div class="product-detail-description">
                                <div class="title">
                                    {{ $product_detail->name }}
                                </div>

                                <div class="nav nav-tabs nav-product">
                                    <ul class="nav-list">
                                        <li class="nav-menu-item active">
                                            <a data-toggle="tab" href="#tabdetail">Product Detail</a>
                                        </li>
                                        <li class="nav-menu-item">
                                            <a data-toggle="tab" href="#tabvideo">Product Video</a>
                                        </li>
                                        <li class="nav-menu-item">
                                            <a data-toggle="tab" href="#tabproject">Projects</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="nav-content-description">
                                    <div class="tab-content">
                                        <div id="tabdetail" class="tab-pane active">
                                        {!! $product_detail->description !!}
                                        </div>
                                        <div id="tabvideo" class="tab-pane">
                                            <div class="product-video">
                                                @if ( $product_detail->video != null || $product_detail->video != '' )
                                                <iframe src="https://www.youtube.com/embed/{{ $product_detail->video }}" frameborder="0" allowfullscreen></iframe>
                                                @else
                                                <p>There is no video for this product..</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div id="tabproject" class="tab-pane">
                                            @if ( $product_detail->projects != null || $product_detail->projects != ''  )
                                            <div class="project-list">
                                            {!! $product_detail->projects !!}
                                            </div>
                                            @else
                                            <p>There is no project for this product..</p>
                                            @endif
                                        </div>
                                    </div><!-- tab-content -->
                                    <hr>
                                    <div class="share-icon">
                                        <ul>
                                            <label>Share this product:</label>
                                            <li>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('products/'.$product_detail->permalink) }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/home?status={{ url('products/'.$product_detail->permalink) }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            {{--<li>--}}
                                                {{--<a href="#"><i class="fa fa-pinterest"></i></a>--}}
                                            {{--</li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div><!--col-md-6-->
                    </div>
                </div><!--col-md-12-->

            </div><!--row-->
        </div><!--container-->
    </section>

    @include('templates.parts.newsletter')
    @include('templates.parts.footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#product").addClass("active");
        });
    </script>
</body>
</html>