    <!-- Header -->
    <header class="{{ Request::route()->getName() == 'home' ? 'absolute-header' : '' }}">
        <div class="container custom-container-md">
            <div class="row">
                <div class="col-lg-1 col-md-1 col-xs-3 img-logo">
                    <a href="{{ URL::route('home') }}">
                        <img src="{{ URL::asset('resources/assets/images/'.$website_logo) }}" class="img-responsive">
                    </a>
                </div>
                <div class="col-lg-9 col-md-9 col-xs-12 no-padding">
                    <nav class="nav-header">
                        <ul class="nav-menu-list" id="nav-toggle-open">
                            <li><a id="home" href="/">HOME</a></li>
                            <li><a id="home" href="/about">ABOUT DUA SISI</a></li>
                            <li><a id="home" href="/currency">CURRENCY</a></li>
                            <li><a id="home" href="/news-and-events">NEWS</a></li>
                            <li><a id="home" href="/contact">GET IN TOUCH</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-2 menu-right" style="padding-top:15px;">
                       <div id="toggle-menu">
                        <a class="nav-toggle" href="javascript:void(0)">
                            <span></span>
                        </a>
                    </div>
                    <div class="header-social-icon">
                            <ul>
                                <li  style="width:40px;height: 40px;">
                                    <a href="https://www.instagram.com/duasisimc" target="_blank"><img src="{{ URL::asset('resources/assets/images/logo-fb.png') }}" class="img-responsive"></a>
                                </li>
                                <li style="width:40px;height: 40px;">
                                    <a href="https://www.facebook.com/duasisimc" target="_blank"><img src="{{ URL::asset('resources/assets/images/logo-ig.png') }}" class="img-responsive"></a>
                                </li>

                     </ul>
                        </div>
                </div>
            </div>
        </div>
    </header>


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