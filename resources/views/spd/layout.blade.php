{{--
    Shared chrome for the Swarnadwipa theme, sliced from "WEB YAYASAN SPD.psd".

    Built on Bootstrap 5.3.3, vendored locally under
    resources/assets/vendor/bootstrap rather than pulled from a CDN, so the
    site has no third-party runtime dependency. Bootstrap supplies the grid,
    container and breakpoints; resources/assets/spd/css/spd.css supplies the
    palette and component skins taken from the PSD.

    Unlike the older public views — standalone files that @include partials —
    this theme uses real layout inheritance, so the header and footer exist
    once. Nothing outside resources/views/spd/ is affected.

    All copy is static, taken verbatim from the PSD's text layers.

    Links use route() rather than hardcoded paths so they follow the routes
    wherever they are mounted. The theme was first served under a /home-new
    prefix and later moved to the site root; hardcoded url('home-new/...')
    calls turned every nav and footer link into a 404 the moment it moved.
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | Yayasan Swarnadwipa Peduli Bangsa</title>
    <meta name="description" content="@yield('meta_description', 'Yayasan Swarnadwipa Peduli Bangsa — lembaga sosial yang berdedikasi meningkatkan kualitas hidup masyarakat melalui program pendidikan, sosial, kemanusiaan, pemberdayaan ekonomi, kesehatan, dan pelestarian lingkungan.')">

    @php
        // Cache-bust on file mtime. Without it the browser holds on to a stale
        // spd.css after every edit, which reads as "the CSS change did nothing".
        $spdAsset = function ($path) {
            $full = base_path($path);
            $v = file_exists($full) ? filemtime($full) : null;
            return asset($path) . ($v ? '?v=' . $v : '');
        };
    @endphp

    <link rel="shortcut icon" href="{{ asset('resources/assets/spd/images/logo.png') }}">
    <link rel="stylesheet" href="{{ $spdAsset('resources/assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ $spdAsset('resources/assets/spd/css/spd.css') }}">
</head>
<body class="spd">

    {{-- The green bar is full-bleed as in the comp; its contents sit in the
         container so they line up with the page content below. --}}
    <header class="spd-header">
        <div class="spd-header__bar">
            <div class="container">
                <nav class="navbar navbar-expand-lg p-0" aria-label="Navigasi utama">
                    {{-- flex-wrap matters: Bootstrap gives .navbar-collapse a
                         flex-basis of 100%, so with wrapping enabled the
                         collapsed menu drops onto its own row beneath the logo
                         and toggler instead of being squeezed in beside them. --}}
                    <div class="d-flex flex-wrap align-items-center w-100 gap-3">

                        <a class="spd-logo" href="{{ route('spd_home') }}">
                            <img src="{{ asset('resources/assets/spd/images/logo.png') }}"
                                 alt="Yayasan Swarnadwipa Peduli Bangsa">
                        </a>

                        <button class="navbar-toggler spd-toggler ms-auto"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#spdNav"
                                aria-controls="spdNav"
                                aria-expanded="false"
                                aria-label="Buka navigasi">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        @php
                            // Only the two pages in the PSD exist; the remaining
                            // nav items are in the design but have no page yet.
                            $spdNav = [
                                ['label' => 'BERANDA',      'url' => route('spd_home'),         'key' => 'beranda'],
                                ['label' => 'TENTANG KAMI', 'url' => route('spd_tentang'), 'key' => 'tentang'],
                                ['label' => 'KEGIATAN',     'url' => null,                    'key' => 'kegiatan'],
                                ['label' => 'DONASI',       'url' => route('spd_donasi'),  'key' => 'donasi'],
                                ['label' => 'HUBUNGI KAMI', 'url' => null,                    'key' => 'hubungi'],
                            ];
                            $spdActive = $spdActive ?? null;
                        @endphp

                        <div class="collapse navbar-collapse spd-nav" id="spdNav">
                            <div class="d-flex flex-column flex-lg-row align-items-lg-center
                                        justify-content-lg-center flex-wrap w-100 gap-lg-2">
                                @foreach ($spdNav as $i => $item)
                                    @if ($i > 0)
                                        <span class="spd-nav__sep d-none d-lg-inline" aria-hidden="true">I</span>
                                    @endif

                                    <a href="{{ $item['url'] ?: '#' }}"
                                       @unless ($item['url']) aria-disabled="true" @endunless
                                       @if ($spdActive === $item['key']) aria-current="page" @endif>{{ $item['label'] }}</a>
                                @endforeach
                            </div>
                        </div>

                        <a class="spd-header__wa d-none d-lg-block"
                           href="https://wa.me/6281234567890"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="Hubungi kami melalui WhatsApp">
                            <img src="{{ asset('resources/assets/spd/images/whatsapp.png') }}" alt="">
                        </a>

                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="spd-footer mt-5">
        <div class="container">
            <div class="row g-4 align-items-start text-center text-lg-start">

                <div class="col-12 col-lg-4 spd-footer__sitemap">
                    <h2>PETA WEBSITE</h2>
                    <ul>
                        <li><a href="{{ route('spd_home') }}">BERANDA</a></li>
                        <li><a href="{{ route('spd_tentang') }}">TENTANG KAMI</a></li>
                        <li><a href="#">KEGIATAN</a></li>
                        <li><a href="{{ route('spd_donasi') }}">DONASI</a></li>
                        <li><a href="#">HUBUNGI KAMI</a></li>
                    </ul>
                </div>

                <div class="col-12 col-lg-4 d-flex justify-content-center">
                    <div class="spd-footer__logo">
                        <img src="{{ asset('resources/assets/spd/images/logo.png') }}"
                             alt="Yayasan Swarnadwipa Peduli Bangsa">
                    </div>
                </div>

                <div class="col-12 col-lg-4 spd-footer__address text-center text-lg-end">
                    <h2>ALAMAT KAMI</h2>
                    <p>JL DR HARUN XXX</p>
                    <p>BADNARLAMPUNG</p>
                    <p><a href="mailto:yayasanspd@gmail.com">YAYASANSPD@GMAIL.COM</a></p>
                </div>

            </div>

            <p class="spd-footer__copyright text-center">
                Copyright &copy; 2026 Yayasan SWARNADWIPA PEDULI BANGSA . All Rights Reserved
            </p>
        </div>
    </footer>

    <script src="{{ $spdAsset('resources/assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
