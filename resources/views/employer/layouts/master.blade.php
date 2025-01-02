<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta property="route" content="{{url('')}}">
        <meta property="token" content="{{ csrf_token() }}">
        <title>{{ settingEmp('site_name') }} | {{ $page }}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="{{ settingEmp('site_favicon') }}" rel="icon">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/select2.min.css"/ />
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/jquery.multi-select.css" />
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/jquery-ui.css" />
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/jquery-ui-timepicker-addon.css" />
        <link rel="stylesheet" href="{{url('cdn-employers')}}/plugins/iCheck/all.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/dropify.min.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/css-beautify.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/AdminLTE.min.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/bar-rating-pill.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/toggle.min.css" >
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/cf/dashboard-styles.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/cf/team-page-styles.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/cf/candidate-page-styles.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/cf/job-listing-page-styles.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/cf/quiz-page-styles.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/cf/interview-page-styles.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/cf/job-board-styles.css">
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/cf/general-styles.css">
        @php $lang = employerLanguage(); @endphp
        @if($lang['direction'] == 'rtl')
        <link rel="stylesheet" href="{{url('cdn-employers')}}/css/cf/rtl-styles.css">
        @endif
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        {!! setting('employer_header_scripts') !!}
    </head>
    <body class="hold-transition skin-black-light sidebar-mini {{ getSessionValues('sidebar_toggle') == 'off' ? '' : 'sidebar-collapse'; }}">
        <div class="wrapper">
            @include('employer.layouts.topbar')
            @include('employer.layouts.sidebar')
            @yield('content')
            <div class="modal fade in" id="modal-default" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Default Modal</h4>
                        </div>
                        <div class="modal-body-container">
                        </div>
                    </div>
                </div>
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; {{ date('Y') }}.</strong> {{__('message.all_rights_reserved_2')}}
            </footer>
        </div>
    </body>
    <script src="{{url('cdn-employers/')}}/js/jquery.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/jquery-ui.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/jquery-ui-timepicker-addon.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/popper.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/bootstrap.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/raphael.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/morris.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/Chart.js"></script>
    <script src="{{url('cdn-employers/')}}/js/jquery.slimscroll.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/jquery.dataTables.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/dataTables.bootstrap.min.js"></script>
    <script src="{{url('cdn-employers/')}}/plugins/iCheck/iCheck.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/select2.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/dropify.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/jquery.multi-select.js"></script>
    <script src="{{url('cdn-employers')}}/plugins/ckeditor5/upload-adapter.js"></script>
    <script src="{{url('cdn-employers/')}}/plugins/ckeditor5/ckeditor.js"></script>
    <script src="{{url('cdn-employers/')}}/js/bar-rating.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/toggle.min.js"></script>
    <script src="{{url('cdn-employers/')}}/js/adminlte.min.js"></script>
    <script src="{{url('cdn-general/')}}/js/lang.js"></script>
    <script src="{{url('cdn-employers/')}}/js/cf/app.js"></script>
    <script src="{{url('cdn-employers/')}}/js/cf/general.js"></script>
    @yield('page-scripts')
    {!! setting('employer_footer_scripts') !!}
</html>