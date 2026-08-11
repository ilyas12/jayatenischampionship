    <!-- Header -->
    <header class="{{ Request::route()->getName() == 'home' ? 'absolute-header' : '' }}">
        <div class="container custom-container-md">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-xs-3 img-logo">
                    <a href="{{ URL::route('home') }}">
                        <img src="{{ URL::asset('resources/assets/images/'.$website_logo) }}" class="img-responsive">
                    </a>
                </div>
                <div class="col-md-8 col-xs-12 no-padding">
                    <nav class="nav-header">
                        <ul class="nav-menu-list" id="nav-toggle-open">
              
                            <?php
                            //dd($custom_menu);
                            ?>

                            @foreach ( $custom_menu as $index => $cm )
                            @if ( $cm->permalink == 'products' )
                            <li class="dropdown">
                                <a id="{{ $cm->permalink }}" href="{{ URL::route($cm->permalink) }}" {!! Route::currentRouteName() == 'product_category' ? 'class="active"' : '' !!}>{!! $cm->custom_name !!}</a>
                                <div class="nav-open-icon">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                                <ul class="dropdown-content">
                                    @foreach( $categories as $category )
                                    <li>
                                    <a href="{{ url('products/category/'.$category->permalink) }}">{{ $category->name }}
                                    <i class="fa fa-long-arrow-right"></i>
                                    </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @elseif ( $cm->permalink == 'brands' )
                                <li class="dropdown">
                                    <a id="{{ $cm->permalink }}" href="{{ URL::route($cm->permalink) }}" {!! Route::currentRouteName() == 'product_brand' ? 'class="active"' : '' !!}>{!! $cm->custom_name !!}</a>
                                    <div class="nav-open-icon">
                                        <i class="fa fa-angle-right"></i>
                                    </div>
                                    <ul class="dropdown-content">
                                        @foreach( $brands as $brand )
                                        <li>
                                            <a href="{{ url('products/brand/'.$brand->url) }}">{{ $brand->title }}
                                                <i class="fa fa-long-arrow-right"></i>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                @if($cm->permalink !== '')
                                <li><a id="{{ $cm->permalink }}" href="{{ URL::route($cm->permalink) }}">{!! $cm->custom_name !!}</a></li>
                                @endif
                            @endif
                            @endforeach

                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2 col-md-2 menu-right">
                    <div id="toggle-menu">
                        <a class="nav-toggle" href="javascript:void(0)">
                            <span></span>
                        </a>
                    </div>

                    <form action="#" method="GET" class="form-search">
                        <input type="" name="keyword" class="search-input">
                        <a href="javascript:void(0)" class="open-search">
                            <i class="fa fa-search"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <form id="{{ Request::route()->getName() == 'home' ? 'form-search-head-absolute' : 'form-search' }}" method="get" action="{{url('search')}}" style="z-index:0">
        <div class="container">
            <div class="col-md-12">
                <i class="fa fa-search"></i>
                <input type="text" class="form-control" name="q" placeholder="Search Input">
            </div>
        </div>
    </form>	<!-- Header -->

    <script type="text/javascript">
        $(document).ready(function() {
            if ($(window).width() < 991 ) {
            $(".open-search").click(function () {
                $("#{{ Request::route()->getName() == 'home' ? 'form-search-head-absolute' : 'form-search' }}").stop().slideToggle(200);
                $("#{{ Request::route()->getName() == 'home' ? 'form-search-head-absolute' : 'form-search' }}").css('z-index','999');
                $("i", this).toggleClass("fa-search fa-times");
            });
            }
        });
    </script>