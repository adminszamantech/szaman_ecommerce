<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <meta name="description" content="Page Title">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/assets') }}/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/assets') }}/css/app.bundle.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets') }}/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/assets') }}/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="{{ asset('backend/assets') }}/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/assets') }}/css/miscellaneous/reactions/reactions.css">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/assets') }}/css/miscellaneous/fullcalendar/fullcalendar.bundle.css">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/assets') }}/css/miscellaneous/jqvmap/jqvmap.bundle.css">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/assets') }}/css/notifications/sweetalert2/sweetalert2.bundle.css">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/assets') }}/css/datagrid/datatables/datatables.bundle.css">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/assets') }}/css/formplugins/select2/select2.bundle.css">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/assets') }}/css/formplugins/summernote/summernote.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .tox-promotion {
            display: none !important;
        }
        .tox-statusbar__right-container {
            display: none !important;
        }
    </style>
    <x-head.text-editor-config />
    @yield('css')
</head>
<!-- BEGIN Body -->

<body class="mod-bg-1 ">
<!-- DOC: script to save and load page settings -->
<script>
    /**
     *	This script should be placed right after the body tag for fast execution
     *	Note: the script is written in pure javascript and does not depend on thirdparty library
     **/
    'use strict';

    var classHolder = document.getElementsByTagName("BODY")[0],
        /**
         * Load from localstorage
         **/
        themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {},
        themeURL = themeSettings.themeURL || '',
        themeOptions = themeSettings.themeOptions || '';
    /**
     * Load theme options
     **/
    if (themeSettings.themeOptions)
    {
        classHolder.className = themeSettings.themeOptions;
        console.log("%c✔ Theme settings loaded", "color: #148f32");
    }
    else
    {
        console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
    }
    if (themeSettings.themeURL && !document.getElementById('mytheme'))
    {
        var cssfile = document.createElement('link');
        cssfile.id = 'mytheme';
        cssfile.rel = 'stylesheet';
        cssfile.href = themeURL;
        document.getElementsByTagName('head')[0].appendChild(cssfile);

    }
    else if (themeSettings.themeURL && document.getElementById('mytheme'))
    {
        document.getElementById('mytheme').href = themeSettings.themeURL;
    }
    /**
     * Save to localstorage
     **/
    var saveSettings = function()
    {
        themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
        {
            return /^(nav|header|footer|mod|display)-/i.test(item);
        }).join(' ');
        if (document.getElementById('mytheme'))
        {
            themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
        };
        localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
    }
    /**
     * Reset settings
     **/
    var resetSettings = function()
    {
        localStorage.setItem("themeSettings", "");
    }

</script>
<!-- BEGIN Page Wrapper -->
<div class="page-wrapper">
    <div class="page-inner">
        <!-- BEGIN Left Aside -->
    @include('backend.common.sidebar')
    <!-- END Left Aside -->
        <div class="page-content-wrapper">
            <!-- BEGIN Page Header -->
        @include('backend.common.header')
        <!-- END Page Header -->
            <!-- BEGIN Page Content -->
            <!-- the #js-page-content id is needed for some plugins to initialize -->
            <main id="js-page-content" role="main" class="page-content">
                @yield('content')
            </main>
            <!-- this overlay is activated only when mobile menu is triggered -->
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
            <!-- BEGIN Page Footer -->
        @include('backend.common.footer')
        <!-- END Page Footer -->

        </div>
    </div>
</div>
<!-- END Page Wrapper -->
<!-- BEGIN Quick Menu -->
<!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->

<!-- END Quick Menu -->


<script src="{{ asset('backend/assets') }}/js/vendors.bundle.js"></script>
<script src="{{ asset('backend/assets') }}/js/app.bundle.js"></script>
<script src="{{ asset('backend/assets') }}/js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
<script src="{{ asset('backend/assets') }}/js/datagrid/datatables/datatables.bundle.js"></script>
<script src="{{ asset('backend/assets') }}/js/formplugins/select2/select2.bundle.js"></script>
<script src="{{ asset('backend/assets') }}/js/formplugins/summernote/summernote.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"></script>
<!-- Jwt decode -->
{{--<script src="https://cdn.jsdelivr.net/npm/jwt-decode@3.1.2/build/jwt-decode.min.js"></script>--}}
<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

<script type="text/javascript">
    /* Activate smart panels */
    $('#js-page-content').smartPanel();
    $('.select2').select2();
    // axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('access_token');

    {{--$('#logoutButton').click(function (e){--}}
    {{--    e.preventDefault();--}}
    {{--    localStorage.removeItem('access_token');--}}
    {{--    localStorage.removeItem('admin_id');--}}
    {{--    window.location.href = "{{ route('admin.login') }}"--}}
    {{--});--}}

    {{--$('#header_logout').click(function (e){--}}
    {{--    e.preventDefault();--}}
    {{--    localStorage.removeItem('access_token');--}}
    {{--    localStorage.removeItem('admin_id');--}}
    {{--    window.location.href = "{{ route('admin.login') }}"--}}
    {{--});--}}

    // ====== JWT Token Checking ============= //
    {{--function checkTokenExpiration(token) {--}}
    {{--    try {--}}
    {{--        const decoded = jwt_decode(token);--}}

    {{--        // Get current time--}}
    {{--        const currentTime = Math.floor(Date.now() / 1000);--}}

    {{--        // Check if token is expired--}}

    {{--        if (decoded.exp < currentTime) {--}}
    {{--            localStorage.removeItem('access_token');--}}
    {{--            localStorage.removeItem('admin_id');--}}
    {{--            window.location.href = "{{ route('admin.login') }}"--}}
    {{--        }--}}
    {{--    } catch (error) {--}}
    {{--        localStorage.removeItem('access_token');--}}
    {{--        localStorage.removeItem('admin_id');--}}
    {{--        window.location.href = "{{ route('admin.login') }}"--}}
    {{--    }--}}
    {{--}--}}
    // Example usage
    // const token = localStorage.getItem('access_token'); // Replace with the token you want to check
    // checkTokenExpiration(token);
    // console.log(token)

    // ====== JWT Token Checking ============= //

</script>
@yield('js')


</body>
<!-- END Body -->
</html>
