<!-- Grandstand Open — sliced from the static tennis/ mockup. Everything outside <main> lives here; each page is extends + section. Bootstrap 5.3.3 is served from resources/assets/vendor/bootstrap (shared with the SPD theme) rather than the mockup's CDN link, so the site has no third-party runtime dependency. Google Fonts is still remote — Cormorant Garamond and Inter carry the whole look and self-hosting them is a separate job. ponytail: swap for local woff2 if the site must work offline or without third-party requests. -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Grandstand Open 2026') — Grandstand Open</title>
  <meta name="description" content="@yield('description', 'The Grandstand Open 2026: eight days of championship tennis.')">

  @php
      // Cache-bust on mtime so a CSS edit is not masked by the browser cache.
      $tennisAsset = function ($path) {
          $full = base_path($path);
          $v = file_exists($full) ? filemtime($full) : null;
          return asset($path) . ($v ? '?v=' . $v : '');
      };
  @endphp

  <link href="{{ $tennisAsset('resources/assets/vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ $tennisAsset('resources/assets/tennis/css/style.css') }}">
  @stack('head')
</head>
<body>

<div class="top-rule"></div>

@include('tennis.partials.header')

<main id="main">@yield('content')</main>

@include('tennis.partials.footer')

<script src="{{ $tennisAsset('resources/assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ $tennisAsset('resources/assets/tennis/js/main.js') }}"></script>
@stack('scripts')
</body>
</html>
