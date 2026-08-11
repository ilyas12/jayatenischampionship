<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.headv2')
    <!-- for Facebook -->
    <meta property="og:title" content="{{ $title.' - '.$subtitle }}" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ URL::asset('resources/assets/uploads/news_and_events/'.$slideshow->img) }}" />
    <meta property="og:url" content="{{ url('rates') }}" />
    <meta property="og:description" content="{{ $rates_info['information'] }}" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $title.' - '.$subtitle }}" />
    <meta name="twitter:description" content="{{ $rates_info['information'] }}" />
    <meta name="twitter:image" content="{{ URL::asset('resources/assets/uploads/news_and_events/'.$slideshow->img) }}" />
</head>
<body>
    @include('templates.parts.headerv2')

    <section class="page-section" style="background: #e5dede;">
        <div class="container custom-container-md">
            <div class="row">
<section
    class="rates-banner"
    style="background-image: url('{{ URL::asset(
        'resources/assets/uploads/home_slideshow/'.$slideshow->img
    ) }}');"
>
    <div class="rates-banner__overlay"></div>

    <div class="rates-banner__container">
        <div class="rates-banner__content">
            <h1 class="rates-banner__title">
                Exchange Rates
            </h1>

            <p class="rates-banner__description">
                View our latest foreign currency exchange rates
                for Jakarta and Surabaya.
            </p>
        </div>
    </div>
</section>

<section class="rates-page">
    <div class="rates-page__container">
        <div class="rates-page__heading">
            <span class="rates-page__eyebrow">
                Dua Sisi Money Changer
            </span>

            <h2 class="rates-page__title">
                Exchange Rates
            </h2>

            @if(isset($rates_info['update_at']) && $rates_info['update_at'] != '')
                <p class="rates-page__updated">
                    Last updated on {{ $rates_info['update_at'] }}
                </p>
            @endif
        </div>

        <div class="rates-table">
            <div class="rates-table__header">
                <div>Currency</div>
                <div>Jakarta</div>
                <div>Surabaya</div>
            </div>

            <div class="rates-table__body">
                @foreach($rates as $code => $rate)
                    <div class="rates-table__row">
                        <div class="rates-table__currency">
                            <span class="currency-flag">
                                {{ $rate['flag'] }}
                            </span>

                            <div class="rates-table__currency-info">
                                <strong>{{ $code }}</strong>
                            </div>
                        </div>

                        <div class="rates-table__value">
                            {{ $rate['jakarta'] }}
                        </div>

                        <div class="rates-table__value">
                            {{ $rate['surabaya'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(isset($rates_info['information']) && $rates_info['information'] != '')
            <div class="rates-page__information">
                <p><?php echo $rates_info['information'];?>
            </div>
        @endif

        <div class="rates-page__actions">
            <a href="/branches" class="rates-page__button">
                Find Our Branches
            </a>
        </div>
    </div>
</section>
            </div><!--row-->
        </div><!--container-->
    </section>
    
    @include('templates.parts.footerv2')
</body>
</html>