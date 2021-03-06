<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- Theme style -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin/library-image.css') }}" rel="stylesheet">
        @yield('style')
    </head>
    <body class="hold-transition skin-blue sidebar-mini" data-src='{{ url("/") }}'>
        <div class="wrapper">
            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="/admin" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    {{ config('app.name', 'Laravel') }}
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="lang">
                            <li><a href="{{ url('locale/en') }}">EN</a></li>
                            <li><a href="{{ url('locale/vi') }}" >VI</a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn-user btn-default btn-flat">{{ __('messages.profile') }}</a>
                                        </div>
                                    </li>

                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-user btn-default">{{ __('messages.sing_out') }}</button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown notifications-menu open">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">
                                    @php
                                        $number = count( $notes );
                                    @endphp
                                    {{ $number }}
                                  </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have {{ $number }} notifications</li>
                                    <li>
                                    <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            @foreach( $notes as $note )
                                                @php
                                                    $detail = $note->data;
                                                    $detail = json_encode($detail);
                                                    $detail = json_decode($detail);

                                                @endphp
                                                <li>
                                                    <a href="/note/{{ $note->id }}">
                                                      <i class="fa fa-users text-aqua"></i> Order {{ $detail->order_id }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="">
                            <a href="{{ url('/note') }}">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>{{ __('messages.notification') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="/stores">
                                <i class="fa fa-link"></i>
                                <span>{{ __('messages.stores') }}</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ url('/users') }}">
                                <i class="fa fa-user"></i>
                                <span>{{ __('messages.user') }}</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ url('/categories') }}">
                                <i class="fa fa-list-alt"></i>
                                <span>{{ __('messages.category') }}</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ url('/product') }}">
                                <i class="fa fa-product-hunt"></i>
                                <span>{{ __('messages.product') }}</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ url('/slider') }}">
                                <i class="fa fa-photo"></i>
                                <span>Slider</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ url('/order') }}">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>{{ __('messages.order') }}</span>
                            </a>
                        </li>
                    </li>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="main-content content-header">
                <div class="container">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane active" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Recent Activity</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:;">
                                <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                    <p>Will be 23 on April 24th</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->
                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:;">
                                <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="pull-right-container">
                                    <span class="label label-danger pull-right">70%</span>
                                </span>
                                </h4>
                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->
                </div>
                <!-- /.tab-pane -->
                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                <!-- /.tab-pane -->
                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>
                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked>
                            </label>
                            <p>
                                Some information about this general settings option
                            </p>
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/admin/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
    Both of these plugins are recommended to enhance the
    user experience. -->
</body>
</html>
