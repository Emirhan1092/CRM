<!doctype html>
<html lang="en">
    <head>
        <title>@yield('page-title')</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta property="route" content="{{ empUrl() }}">
        <meta property="token" content="{{ csrf_token() }}">
        <meta content="{{ settingEmpSlug('site_keywords') }}" name="keywords">
        <meta content="{{ settingEmpSlug('site_description') }}" name="description">
        <link href="{{ settingEmpSlug('site_favicon') }}" rel="icon">
        <link href="{{ settingEmpSlug('site_favicon') }}" rel="apple-touch-icon">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/css/bootstrap-social.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/css/jquery-ui.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/plugins/flag-icons/flag-icon.min.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/plugins/select2/css/select2.min.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/plugins/owl-carousel/owl.theme.default.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/plugins/owl-carousel/owl.theme.green.min.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/plugins/dropify/css/dropify.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @if(empSlugBranding())
        <link href="{{ url('/').'/'.employerPath(true) }}/custom-style.css?ver={{curRand()}}" rel="stylesheet">
        <link href="{{ url('/').'/'.employerPath(true) }}/variables.css?ver={{curRand()}}" rel="stylesheet">
        @else
        <link href="{{ url('cdn-candidates/beta') }}/css/variables.css?ver={{curRand()}}" rel="stylesheet">
        @endif
        <link href="{{ url('cdn-candidates/beta') }}/css/custom-css.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/css/ct-{{defaultColorTheme()}}.css" rel="stylesheet">
        <link href="{{ url('cdn-candidates/beta') }}/css/style.css" rel="stylesheet">
        @php $lang = frontLanguage(); @endphp
        @if($lang['direction'] == 'rtl')
        <link href="{{ url('cdn-candidates/beta') }}/css/style-rtl.css" rel="stylesheet">
        @endif
        {!! setting('candidate_header_scripts') !!}

    </head>
    <body>
        @include('candidate.beta.layouts.menu')
        @yield('breadcrumb')
        BURADA BİR SORUN VAR
        @yield('content')
        @include('candidate.beta.layouts.footer')
    </body>
    <script src="{{ url('cdn-candidates/beta') }}/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/js/jquery-3.6.1.min.js"></script>
    <script src="{{ url('cdn-candidates/beta')}}/js/jquery-ui.min.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/js/js.cookie.min.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/plugins/select2/js/select2.min.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/plugins/dropify/js/dropify.min.js"></script>
    <script src="{{ url('cdn-general') }}/js/lang.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/js/app.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/js/helpers.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/js/account.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/js/general.js"></script>
    <script src="{{ url('cdn-candidates/beta') }}/js/menu.js"></script>
    @yield('page-scripts')

</html>