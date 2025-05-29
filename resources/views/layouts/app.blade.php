<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="horizontal" data-bs-theme="ligth" data-layout-mode="default" data-layout-width="default" data-menu-color="light" data-menu-icon="default" data-sidenav-size="default" class="menuitem-active">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>@yield('title', 'Sistema de Chamados')</title>
       
         <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

        <!-- Plugins css -->
        <link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Theme Config Js -->
        <script src="{{ asset('js/head.js') }}"></script>

        <!-- Bootstrap css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- App css -->
        <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Icons css -->
        <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Toastr CSS -->
        <link href="{{ asset('libs/toastr/build/toastr.min.css') }}" rel="stylesheet" type="text/css" />

       
    </head>

    <body class="show" cz-shortcut-listen="true" data-topbar-color="dark">
        
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="app-menu menuitem-active">

                <!-- Brand Logo -->
                <div class="logo-box">
                    <!-- Brand Logo Light -->
                    <a href="index.html" class="logo-light">
                        <img src="assets/images/logo-light.png" alt="logo" class="logo-lg">
                        <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
                    </a>

                    <!-- Brand Logo Dark -->
                    <a href="index.html" class="logo-dark">
                        <img src="assets/images/logo-dark.png" alt="dark logo" class="logo-lg">
                        <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
                    </a>
                </div>

                <!--- Menu -->
                <div class="scrollbar show h-100" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: scroll;"><div class="simplebar-content" style="padding: 0px;">
                    <ul class="menu">

                        <li class="menu-item">
                            <a href="#menuDashboards" data-bs-toggle="collapse" class="menu-link">
                                <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></span>
                                <span class="menu-text"> Dashboards </span>
                                <span class="badge bg-success rounded-pill ms-auto">4</span>
                            </a>
                        </li>
                    </ul>
                </div></div></div></div><div class="simplebar-placeholder" style="width: 1027px; height: 55px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: visible;"><div class="simplebar-scrollbar" style="width: 25px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 53px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
                <!--- End Menu -->
            </div>
            <!-- ========== Left Sidebar End ========== -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

                <!-- ========== Topbar Start ========== -->
                <div class="navbar-custom">
                    <div class="topbar">
                        <div class="topbar-menu d-flex align-items-center gap-1">

                            <!-- Topbar Brand Logo -->
                            <div class="logo-box">
                                <!-- Brand Logo Light -->
                                <a href="index.html" class="logo-light">
                                    <img src="assets/images/logo-light.png" alt="logo" class="logo-lg">
                                    <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
                                </a>

                                <!-- Brand Logo Dark -->
                                <a href="index.html" class="logo-dark">
                                    <img src="assets/images/logo-dark.png" alt="dark logo" class="logo-lg">
                                    <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
                                </a>
                            </div>

                            <!-- Sidebar Menu Toggle Button -->
                            <button class="button-toggle-menu">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </div>

                        
                    </div>
                </div>
                <!-- ========== Topbar End ========== -->

                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h3 class="page-title">@yield('page', 'Dashboard')</h3>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                    </div> <!-- container -->

                   
                    @yield('content')

                </div> <!-- content -->
            </div>
        </div>

        
        
        <!-- Vendor js -->
        <script src="{{ asset('js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('js/app.min.js') }}"></script>
        
        <script src="{{ asset('libs/toastr/toastr.js') }}"></script>
        <script>
            toastr.options = {
                "positionClass": "toast-top-center"
            }
        </script>
                <!-- Sweet Alerts js -->
        <script src="{{ asset('libs/sweetalert2/sweetalert2.all.min.js')}}"></script>

        <!-- Sweet alert init js-->
        <script src="{{ asset('js/pages/sweet-alerts.init.js')}}"></script>
     @stack('scripts')
    </body>

</html>