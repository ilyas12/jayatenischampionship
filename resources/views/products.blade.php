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
                    <div class="title"><h4>ALL PRODUCTS</h4></div>
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

                <div class="product-list">
                    <input type="hidden" name="total_cur" value="{{Request::input('page')*$limit}}">

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
                                <div class="subtitle">{{ $product->subtitle }}</div>
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

                </div><!--product-list-->

            </section>
        </div>
        <div id="loadingGif">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Loading More...</span>
        </div>
    </div>

    @include('templates.parts.newsletter')
    @include('templates.parts.footer')

<!-- Script For Loadmore Function -->
<script type="text/javascript">
    $(document).ready(function() {
        a = 2;
        isPreviousEventComplete = true, isDataAvailable = true;
        $(window).scroll(function () {
            if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
                b = $.cur_url();
                if(b.indexOf('?') + 1){
                    c   = '&';
                }else{
                    c   = '?';
                }
                url = b+c+'page='+a;
                d = {{$products->total()}};
                if (isPreviousEventComplete && isDataAvailable) {
                    isPreviousEventComplete = false;
                    $('#loadingGif').show();
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (result) {
                            temp = $(result).find('.product-list').html();
                            e    = $(result).find('input[name=total_cur]').val();
                            $(".product-list").append(temp);
                            isPreviousEventComplete = true;
                            if (d <= e) 
            //When data is not available
        isDataAvailable = false;
        $('#loadingGif').hide();
    },
});
                }
            }
        });
    });
</script>
<!-- Script For Loadmore Function -->

</body>
</html>