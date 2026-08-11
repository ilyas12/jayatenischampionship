    <title>{{ $page }} | {{$title != '' ? $title : ''}}</title>
    <link rel="shortcut icon" href="{{ URL::asset('resources/assets/images/'.$website_favicon) }}"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $meta_description != '' ? $meta_description : '' }}">
    <meta name="keywords" content="{{ $meta_keywords != '' ? $meta_keywords : '' }}">
    <meta name="author" content="{{ $meta_author != '' ? $meta_author : '' }}">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KFTK25NF8N"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-KFTK25NF8N');
    </script>