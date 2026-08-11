<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.headv2')
    <style>
        .floating-box {
            position: absolute;
            top: 45%;
            left: 13%;
            transform: translateY(-50%);
            background: rgba(34, 139, 34, 0.9);
            color: white;
            padding: 20px;
            width: 25%;
            height: auto !important;
           /* max-height: 40%; */
        }
        .floating-box h2, .floating-box p {
            margin: 0 0 10px;
        }
        .floating-box .btn {
            background: black;
            color: #008001;
            /*position: absolute;*/
            border: 0px;
            font-size: 20px;
            border-radius: 0px;
            bottom: 5%;
            padding: 10px 20px;
        }
        
    </style>
</head>
<body> 
    @include('templates.parts.headerv2')

    <div class="slider-banner">
        <section class="exchange-hero" style="background-image: url({{ URL::asset('resources/assets/uploads/home_slideshow/'.$slideshow->img) }}">
          <div class="exchange-hero__overlay"></div>
          <div class="exchange-hero__container">
            <div class="exchange-hero__content">
              <div class="exchange-hero__intro">
                <h1 class="exchange-hero__title">
                  Changing Currency.<br />
                  Connecting Journeys.
                </h1>
        
                <p class="exchange-hero__description">
               
                  View Our others Exchange Rates  <a href="/rates">click here</a> | Find a Branch Near You <a href="/branches">click here</a>
                  <!--<a href="/branches">location</a>-->
                  <!--or give us a-->
                  <!--<a href="#contact">call</a>-->
                  <!--for our services.-->
                </p>
              </div>
        
              <div class="exchange-rates">
                <div class="exchange-rates__table">
                   
                    <h2 style="text-align:center">WE SELL</h2>
       
                  <div class="exchange-rates__row exchange-rates__header">
                    <div class="exchange-rates__currency">CURRENCY</div>
                    <div>JAKARTA</div>
                    <div>SURABAYA</div>
                  </div>
                @foreach($rates as $code => $rate)
                  <div class="exchange-rates__row">
                    <div class="exchange-rates__currency">
                      <span class="currency-flag">{{ $rate['flag'] }}</span>
                      <span>{{ $code }}</span>
                    </div>
                    <div>{{ $rate['jakarta'] }}</div>
                    <div>{{ $rate['surabaya'] }}</div>
                  </div>
                @endforeach
        
                <p class="exchange-rates__updated">
                  Last updated on {{ $rates_info['update_at'] }}
                </p>
        
                <p class="exchange-rates__footer">
                   <?php echo $rates_info['information'];?>
                </p>
              </div>
            </div>
          </div>
        </section>
    </div>

    <div class="container custom-container-md"> 
        <div class="row">
            <div class="social-media-list">
                <ul>
                    <li>
                        <a href="https://www.facebook.com/duasisimc" target="_blank"><img src="{{ URL::asset('resources/assets/imagesv2/logo-fb.png') }}" class="img-responsive"></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/duasisimc" target="_blank"><img src="{{ URL::asset('resources/assets/imagesv2/logo-ig.png') }}" class="img-responsive"></a>
                    </li>
                    <li>
                        <a href="https://www.threads.com/@duasisimc" target="_blank"><img src="{{ URL::asset('resources/assets/imagesv2/logo-thr.png') }}" class="img-responsive"></a>
                    </li>
                    <li>
                        <a href="https://wa.me/+628561670686" target="_blank"><img src="{{ URL::asset('resources/assets/imagesv2/logo-wa.png') }}" class="img-responsive"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- About Us Section -->
        <div class="row" style="background:#e6dfdf" id="about">
            <div class="container custom-container-md">
                <div class="col-md-6 about-us">
                    <h2 class="section-title">About Us</h2>
                    <div class="content">
                       {!! $about_description !!}
                    </div>
                </div>
                <div class="col-md-6 text-center branches">
                    <h2 class="section-title">Branches</h2>
                    <div class="branch-section">
                      <img id="branch-image" src="{{ URL::asset('resources/assets/uploads/stores/'.$main_stores->img) }}" alt="Branch" class="branch-imageimg-responsive" style="display: block;margin-left: auto;margin-right: auto;width: 50%;">
                      <div class="chevrons">
                        <button id="prev-branch">&lt;</button>
                        <button id="next-branch">&gt;</button>
                      </div>
                      <div id="branch-title" class="branch-title">{!! $main_stores->name !!}</div>
                      <div class="branch-links row">
                        <div class="col-xs-6">
                            <a id="whatsapp-link" href="https://wa.me/{!! $main_stores->whatsapp_number !!}" target="_blank" class="link-btn" style="text-color:white">Whatsapp</a>
                        </div>
                        <div class="col-xs-6">
                            <a id="direction-link" href="{!! $main_stores->maps_url !!}" target="_blank" class="link-btn" style="text-color:white">Direction</a>
                        </div>
                        <div class="col-xs-6">
                            <a id="call1-link" href="tel:{!! $main_stores->call_number_one !!}" class="link-btn" style="text-color:white">Call 1</a>
                        </div>
                        <div class="col-xs-6">
                            <a id="call2-link" href="tel:{!! $main_stores->call_number_two !!}" class="link-btn" style="text-color:white">Call 2</a>
                        </div>
                      </div>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Get in Touch Section -->
        <div class="row" style="background:#b7b0b0" id="contact">
            <div class="container custom-container-md">
                <div class="col-md-6 get-in-touch">
                    <h2 class="section-title">Get in Touch</h2>
                    <div class="content">
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <label for="whatsapp">Whatsapp No</label>
                                <input type="text" class="form-control" id="whatsapp" placeholder="Your Whatsapp Number">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="3" placeholder="Your Message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark">Send</button>
                        </form>
                    </div>
                </div>

                <!-- Highlights News Section -->

                <div class="col-md-6 highlight-news">
                    <h2 class="section-title">Highlights News</h2>
                    @foreach( $newsandevents as $index => $newsandevent )
                    <div class="col-md-12">
                        <div class="row">
                            <div class="container-fluid" style="padding:0px;margin-bottom:10px;">
                                <div class="col-md-4 col-xs-4" style="padding:0px;margin-bottom: 10px;">
                                <a href="{{ url('news-and-events/'.$newsandevent->permalink) }}">
                                    @if ( $newsandevent->img_2 != null )
                                        <img src="{{ URL::asset('resources/assets/uploads/news_and_events/'.$newsandevent->img_2) }}" class="img-responsive">
                                    @else
                                        <img src="{{ URL::asset('resources/assets/images/none_360_255.png')}}" class="img-responsive">
                                    @endif
                                </a>
                                </div>
                                <div class="col-md-8 col-xs-8">
                                    <h5 style="margin-top:0px">{{ $newsandevent->title }}</h5>
                                    <div>
                                    {!! $newsandevent->short_description !!} 
                                    </div>
                                    <a href="{{ url('news-and-events/'.$newsandevent->permalink) }}">Read More >>></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
 let branches = {!! $branches !!};

  let currentBranchIndex = 0;

  function updateBranch() {
    const branch = branches[currentBranchIndex];
    $("#branch-image").attr("src", branch.image);
    $("#branch-title").text(branch.title);
    $("#whatsapp-link").attr("href", branch.whatsapp);
    $("#direction-link").attr("href", branch.direction);
    $("#call1-link").attr("href", branch.call1);
    $("#call2-link").attr("href", branch.call2);
  }

  $("#prev-branch").click(() => {
    currentBranchIndex = (currentBranchIndex - 1 + branches.length) % branches.length;
    updateBranch();
  });

  $("#next-branch").click(() => {
    currentBranchIndex = (currentBranchIndex + 1) % branches.length;
    updateBranch();
  });

  // Initial branch load
  updateBranch();
  function matchHeight() {
    let content = document.querySelector('.content');
    let branchSection = document.querySelector('.branch-section');

    // Reset heights to auto to get natural height first
    content.style.height = 'auto';
    branchSection.style.height = 'auto';

    // Get the taller height
    let maxHeight = Math.max(content.offsetHeight, branchSection.offsetHeight);

    // Apply the taller height to both elements
    content.style.height = maxHeight + 'px';
    branchSection.style.height = maxHeight + 'px';
}

// Run on page load
window.addEventListener('load', matchHeight);

// Run on window resize to adjust dynamically
window.addEventListener('resize', matchHeight);
</script>
@include('templates.parts.footerv2')
</body>
</html>