{{--
    Jaya Tennis Championship — 2026 theme.

    Sliced from JTC_Desktop_Master_New.psd. Self-contained: its own stylesheet,
    its own script, its own asset folder, and no Bootstrap — the design is a
    handful of grids and reads more clearly written directly than bent around a
    framework's classes. It shares nothing with the older tennis/ theme, so the
    two can run side by side until this one replaces it.

    The PSD sets everything in Arial and Georgia, which are stand-ins rather
    than the brand's type. Archivo carries the grotesque and Source Serif 4 the
    editorial moments; both are close to what the mockup shows.
--}}
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Jaya Tennis Championship') — Jaya Tennis Championship</title>
  <meta name="description" content="@yield('description', 'Jaya Tennis Championship 2026, Jakarta. A tournament for players, ideas and opportunities.')">

  <link rel="icon" href="{{ \terre\Libraries\Asset::v('resources/assets/jtc/img/jtc_logo_dark.png') }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800&family=Source+Serif+4:opsz,wght@8..60,400;8..60,500;8..60,600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ \terre\Libraries\Asset::v('resources/assets/jtc/css/jtc_style.css') }}">
</head>
<body class="jtc">

  <a class="jtc__skip" href="#jtc-main">Skip to content</a>

  @include('jtc.partials.jtc_header')

  <main id="jtc-main">@yield('content')</main>

  @include('jtc.partials.jtc_footer')

  <script src="{{ \terre\Libraries\Asset::v('resources/assets/jtc/js/jtc_main.js') }}"></script>
</body>
</html>
