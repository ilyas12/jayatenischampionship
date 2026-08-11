    <!-- Header -->
    <header class="black-header{{ Request::route()->getName() == ' home' ? 'absolute-header' : '' }}">
        <div class="container custom-container-md">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xs-4 img-logov2">
                    <a href="/">
                        <img src="{{ URL::asset('resources/assets/imagesv2/'.$website_logo) }}" class="img-responsive"  style="width:100%">
                    </a>
                </div>
                <div class="col-lg-9 col-md-9 col-xs-8 no-padding">
                    <nav class="nav-header">
                        <button class="nav-toggle-btn" onclick="document.getElementById('nav-toggle-open').classList.toggle('open');">☰</button>
                        <ul class="nav-menu-listv2" id="nav-toggle-open">
                            <button class="close-btn" onclick="document.getElementById('nav-toggle-open').classList.toggle('open');">✕</button>
                            <li><a href="/">HOME</a></li>
                            <li><a href="/#about">ABOUT DUA SISI</a></li>
                            <li><a href="/rates">RATES</a></li>
                            <li><a href="/branches">BRANCHES</a></li>
                            <li><a href="/news-and-events">NEWS</a></li>
                            <li><a href="/underlying">UNDERLYING</a></li>
                            <li><a href="/contact">Customer Services</a></li>
                        </ul>
                    </nav>
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