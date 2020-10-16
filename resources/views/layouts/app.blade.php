<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Smarter Admin Panel</title>
    <link rel="apple-touch-icon" href="">
    <link rel="shortcut icon" type="image/x-icon" href="">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/data-tables/css/select.dataTables.min.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-tables.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->


    @yield('css')
</head>

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
            <div class="nav-wrapper">
                <div class="header-search-wrapper hide-on-med-and-down">
                </div>
                <ul class="navbar-list right">
                    <li>

                    </li>
                </ul>
            </div>
            <nav class="display-none search-sm">
                <div class="nav-wrapper">

                </div>
            </nav>
        </nav>
    </div>
</header>

<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="/home">
                <span class="logo-text hide-on-med-and-down">SMARTER</span>
            </a>
        </h1>
    </div>

    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li>
            <a class="grey-text text-darken-1" href="">
                <i class="material-icons">home</i> Home
            </a>
        </li>
        @if(auth()->user()->role->name == "SUPERADMIN")
            <li class="bold {{ Request::is('admin*')? "active":"" }}">
                <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
                    <i class="material-icons">people</i>
                    <span class="menu-title" data-i18n="Menu levels">ADMIN DATA</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a class="{{ Request::is('voucher')? "active":"" }} {{ Request::is('voucher/*')? "active":"" }}"href="">
                                <i class="material-icons"></i>
                                <span data-i18n="Second level">ADMIN</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @if(auth()->user()->role->name == "ADMIN" || auth()->user()->role->name == "SUPERADMIN")
            <li class="bold {{ Request::is('user*')? "active":"" }}">
                <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
                    <i class="material-icons">people</i>
                    <span class="menu-title" data-i18n="Menu levels">USER DATA</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a class="{{ Request::is('user')? "active":"" }} {{ Request::is('user/*')? "active":"" }}"href="">
                                <i class="material-icons"></i>
                                <span data-i18n="Second level">USER</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        <li>
            <a class="grey-text text-darken-1" href="{{ route('logout') }}">
                <i class="material-icons">keyboard_tab</i> Logout
            </a>
        </li>
    </ul>
    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->

<!-- BEGIN: Page Main-->
<div id="main">
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="col s12">
            <div class="container">
                @yield('content')
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>
<!-- END: Page Main-->

<!-- BEGIN: Footer-->

<footer class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow">
    <div class="footer-copyright">
        <div class="container"><span>&copy; 2020 <a href="" target="_blank">Learning Project</a> All rights reserved.</span>
        </div>
    </div>
</footer>


<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('app-assets/js/vendors.min.js') }} "></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }} "></script>
<script src="{{ asset('app-assets/vendors/data-tables/js/dataTables.select.min.js') }} "></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('app-assets/js/plugins.js') }} "></script>
<script src="{{ asset('app-assets/js/search.js') }} "></script>
<script src="{{ asset('app-assets/js/custom/custom-script.js') }} "></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('app-assets/js/scripts/data-tables.js') }} "></script>
<script src="{{ asset('app-assets/js/scripts/advance-ui-modals.js') }} "></script>
<!-- END PAGE LEVEL JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('app-assets/js/scripts/advance-ui-carousel.js') }} "></script>
<!-- END PAGE LEVEL JS-->

@yield('js')
</body>

</html>

