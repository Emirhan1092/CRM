<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{(isset($page_title) ? $page_title.' | ' : '').setting('site_name')}}</title>
        <meta property="route" content="{{url('')}}">
        <meta property="token" content="{{ csrf_token() }}">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="keywords" content="{{(isset($page_keywords) ? $page_keywords : setting('site_description'))}}">
        <meta name="description" content="{{(isset($page_summary) ? $page_summary : setting('site_description'))}}">
        <link href="{{ setting('site_favicon') }}" rel="icon">
        <link href="{{ setting('site_favicon') }}" rel="apple-touch-icon">
        <link href="{{ url('cdn-front/beta') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/plugins/flag-icons/flag-icon.min.css" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/plugins/select2/css/select2.min.css" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/plugins/owl-carousel/owl.theme.default.css" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/plugins/owl-carousel/owl.theme.green.min.css" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/plugins/dropify/css/dropify.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/css/variables.css" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/css/animations.css" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/css/patterns.css" rel="stylesheet">
        <link href="{{ url('cdn-front/beta') }}/css/style.css" rel="stylesheet">
        @php $lang = frontLanguage(); @endphp
        @if($lang['direction'] == 'rtl')
        <link href="{{ url('cdn-front/beta') }}/css/style-rtl.css" rel="stylesheet">
        @endif
        <link href="{{ url('cdn-front/beta') }}/css/custom-css.css" rel="stylesheet">
    </head>
    <body>
        @include('front.beta.layouts.menu')
        @yield('breadcrumb')
        @yield('content')
        @include('front.beta.layouts.footer')
    </body>
    <script src="{{ url('cdn-front/beta') }}/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{ url('cdn-front/beta') }}/js/jquery-3.6.1.min.js"></script>
    <script src="{{ url('cdn-front/beta') }}/js/js.cookie.min.js"></script>
    <script src="{{ url('cdn-front/beta') }}/plugins/select2/js/select2.min.js"></script>
    <script src="{{ url('cdn-front/beta') }}/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="{{ url('cdn-front/beta') }}/plugins/dropify/js/dropify.min.js"></script>
    <script src="{{url('cdn-general')}}/js/lang.js"></script>
    <script src="{{ url('cdn-front/beta') }}/js/app.js"></script>
    <script src="{{ url('cdn-front/beta') }}/js/helpers.js"></script>
    <script src="{{ url('cdn-front/beta') }}/js/main.js"></script>
    <script src="{{ url('cdn-front/beta') }}/js/account.js"></script>
    <script src="{{ url('cdn-front/beta') }}/js/menu.js"></script>
    @yield('page-scripts')

</html>