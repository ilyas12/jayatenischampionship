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
                    <div class="title"><h4>Testimonial</h4></div>
                    <span class="small-border"></span>
                </div>

                <div class="col-md-12 testimonial-large no-padding">
                    @if ( $main_testimonial->image != null )
                    <div class="col-md-6 img-testimonial">
                        <img src="{{ URL::asset('resources/assets/uploads/testimonials/'.$main_testimonial->image) }}" class="img-responsive">
                    </div>
                    <div class="col-md-6 testimonial-detail">
                        <div class="description">
                            {!! $main_testimonial->description !!}
                        </div>
                        <span>{{ $main_testimonial->name }}, {{ $main_testimonial->location }}</span>
                    </div>
                    @else
                    <div class="col-md-12 testimonial-detail">
                        <div class="description">
                            {!! $main_testimonial->description !!}
                        </div>
                        <span>{{ $main_testimonial->name }}, {{ $main_testimonial->location }}</span>
                    </div>
                    @endif
                </div>

                <div class="col-md-12 testimonial-list">
                    <input type="hidden" name="total_cur" value="{{Request::input('page')*$limit}}">
                    @foreach( $testimonials as $testimonial )
                    <div class="col-md-4 testimonial-list-content">
                        <div class="description">
                            {!! $testimonial->description !!}
                        </div>
                        <span>{{ $testimonial->name }}, {{ $testimonial->location }}</span>
                    </div>
                    @endforeach
                </div><!-- testimonial list-->
            </section>
            <div id="loadingGif">
                <i class="fa fa-spinner fa-spin"></i>
                <span>Loading More...</span>
            </div>
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
                d = {{$testimonials->total()}};
                if (isPreviousEventComplete && isDataAvailable) {
                    isPreviousEventComplete = false;
                    $('#loadingGif').show();
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (result) {
                            temp = $(result).find('.testimonial-list-content').html();
                            e    = $(result).find('input[name=total_cur]').val();
                            $(".testimonial-list-content").append(temp);
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