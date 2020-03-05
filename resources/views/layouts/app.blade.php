<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="{{ asset("material/js/modules/materialadmin/libs/jquery/jquery.min.js") }}"></script>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <title>Administrator : </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css' />--}}
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/bootstrap.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/materialadmin.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/font-awesome.min.css") }}" />
{{--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/material-design-iconic-font.min.css") }}" />
{{--    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/libs/morris/morris.core.css") }}" />--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/libs/summernote/summernote.css") }}" />--}}

{{--    <link rel="stylesheet" type="text/css" href="{{ asset("material/js/modules/materialadmin/libs/timepicker/bootstrap-timepicker.min.css") }}" />--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset("material/js/modules/materialadmin/libs/bootstrap-material-datetimepicker-gh-pages/css/bootstrap-material-datetimepicker.css") }}" />--}}

    <link rel="stylesheet" href="{{ asset("material/datatable/datatables.min.css") }}">
    <link rel="stylesheet" href="{{ asset("material/dropzone/dist/dropzone.css") }}">

    <link rel="stylesheet" href="{{ asset("material/select2/dist/css/select2.min.css") }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body class="menubar-hoverable header-fixed">
<header id="header">

    <div class="headerbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="headerbar-left">
            <ul class="header-nav header-nav-options">
                <li class="header-nav-brand">
                    <div class="brand-holder">
                        <a href="/admin">
                            <img src="{{ asset("images/logo.png") }}" alt="Logo">
                        </a>
                    </div>
                </li>
                <li>
                    <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                        <i class="fa fa-bars" style="color: white"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="headerbar-right">
            <ul class="header-nav header-nav-profile">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
                        <i class="fa fa-fw fa-connectdevelop" style="color: white"></i>
                        <span style="color: white" class="profile-info">Settings</span>
                    </a>
                    <ul class="dropdown-menu animation-dock">
                        <li><a href=""><i class="fa fa-fw fa-lock"></i> Change Password</a></li>
                        <li><a onclick="document.getElementById('logout-form').submit()" href="javascript:void(0)"><i class="fa fa-fw fa-power-off text-danger"></i>Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </ul>
                    <!--end .dropdown-menu -->
                </li>
                <!--end .dropdown -->
            </ul>
            <!--end .header-nav-profile -->
            <ul class="header-nav header-nav-toggle">
                <!--                <li>-->
                <!--                    <a class="btn btn-icon-toggle btn-default" href="#offcanvas-search" data-toggle="offcanvas"-->
                <!--                       data-backdrop="false">-->
                <!--                        <i class="fa fa-ellipsis-v"></i>-->
                <!--                    </a>-->
                <!--                </li>-->
            </ul>
            <!--end .header-nav-toggle -->
        </div>
        <!--end #header-navbar-collapse -->
    </div>
</header>
<!-- End: Header -->
<!-- Start: Main -->
<div id="base">
    <div class="offcanvas">
    </div>
    <!--end .offcanvas-->

    <!-- Start: Sidebar -->
    <div id="menubar" class="menubar-inverse ">
        <div class="menubar-fixed-panel">
            <div>
                <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar"
                   href="javascript:void(0);">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="expanded">
                <a href="">
                    <span class="text-lg text-bold text-primary ">ADMIN</span>
                </a>
            </div>
        </div>
        <div class="menubar-scroll-panel">
            <!-- BEGIN MAIN MENU -->
            <ul class="gui-controls" id="main-menu">

                <li @if(in_array("", explode(".", \Request::route()->getName()) )) class="active" @endif ><a href="/admin/"><div class="gui-icon"><i class="fa fa-question-circle fa-fw"></i></div><span class="title">Home Page</span></a></li>
                <li @if(in_array("users", explode(".", \Request::route()->getName()) )) class="active" @endif ><a href="/admin/users/"><div class="gui-icon"><i class="fa fa-user fa-fw"></i></div><span class="title">Users</span></a></li>

                {{--                feedback start--}}
                @if(in_array("feedback", explode("/", Request::url()) ))

                    <li @if(in_array("questions", explode(".", \Request::route()->getName()) )) class="active" @endif ><a href="/admin/feedback/questions"><div class="gui-icon"><i class="fa fa-question-circle fa-fw"></i></div><span class="title">Questions</span></a></li>
                    <li @if(in_array("answers", explode(".", \Request::route()->getName()) )) class="active" @endif><a href="/admin/feedback/answers"><div class="gui-icon"><i class="fa fa-list-ul fa-fw"></i></div><span class="title">Answers</span></a></li>
                    <li @if(in_array("employees", explode(".", \Request::route()->getName()) )) class="active" @endif><a href="/admin/feedback/employees"><div class="gui-icon"><i class="fa fa-group fa-fw"></i></div><span class="title">Employee</span></a></li>
                    <li @if(in_array("active-fields", explode(".", \Request::route()->getName()))) class="active" @endif><a href="/admin/feedback/active-fields"><div class="gui-icon"><i class="fa fa-cogs fa-fw"></i></div><span class="title">Manage Fields</span></a></li>
                    <li @if(in_array("images", explode(".", \Request::route()->getName()))) class="active" @endif><a href="/admin/feedback/images"><div class="gui-icon"><i class="fa fa-image fa-fw"></i></div><span class="title">Manage Images</span></a></li>
                    <li @if(in_array("clients", explode(".", \Request::route()->getName()))) class="active" @endif><a href="/admin/feedback/clients"><div class="gui-icon"><i class="fa fa-group fa-fw"></i></div><span class="title">Customer</span></a></li>
{{--                    <li @if(in_array("feedback-answers", explode(".", \Request::route()->getName()))) class="active" @endif><a href="/admin/feedback/feedback-answers"><div class="gui-icon"><i class="fa fa-check fa-fw"></i></div><span class="title">Feedbacks</span></a></li>--}}

                @endif
                {{--                feedback end--}}

                {{--                P.O.S start--}}
                @if(in_array("pos", explode("/", Request::url()) ))
                    <li @if(in_array("categories", explode(".", \Request::route()->getName()) )) class="active" @endif ><a href="/admin/pos/categories"><div class="gui-icon"><i class="fa fa-list"></i></div><span class="title">Food Categories</span></a></li>
                    <li @if(in_array("sections", explode(".", \Request::route()->getName()) )) class="active" @endif ><a href="/admin/pos/sections"><div class="gui-icon"><i class="fa fa-building"></i></div><span class="title">Table Sections</span></a></li>
                    <li @if(in_array("tables", explode(".", \Request::route()->getName()) )) class="active" @endif ><a href="/admin/pos/tables"><div class="gui-icon"><i class="fa fa-table"></i></div><span class="title">Tables</span></a></li>
                    <li @if(in_array("items", explode(".", \Request::route()->getName()) )) class="active" @endif ><a href="/admin/pos/items"><div class="gui-icon"><i class="fa fa-circle fa-fw"></i></div><span class="title">Food Items</span></a></li>
                    <li @if(in_array("orders", explode(".", \Request::route()->getName()) )) class="active" @endif ><a href="/admin/pos/orders"><div class="gui-icon"><i class="fa fa-check"></i></div><span class="title">Orders</span></a></li>
                    <li @if(in_array("current-orders", explode(".", \Request::route()->getName()) )) class="active" @endif ><a href="/admin/pos/current-orders"><div class="gui-icon"><i class="fa fa-check"></i></div><span class="title">Current Orders</span></a></li>
                @endif
                {{--                P.O.S end--}}
            </ul>
        </div>
    </div>

    <!-- End: Sidebar -->
    <!-- Start: Content -->
    <section id="content">
        <div id="topbar">

        </div>
        <div id="page-main-container" style="padding-top: 15px">

{{--            <div class="alert alert-alert-dismissible text-center fade in" role="alert">--}}
{{--                <button type="button" class="close" id="alert_button_from_flash" data-dismiss="alert"><span--}}
{{--                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>--}}
{{--                <strong></strong>--}}
{{--            </div>--}}
            @yield("content")
        </div>
    </section>

    <div class="offcanvas">


        <!-- BEGIN OFFCANVAS SEARCH -->
        <div id="offcanvas-search" class="offcanvas-pane width-8">
            <div class="offcanvas-head">
                <header class="text-primary">Search</header>
                <div class="offcanvas-tools">
                    <a class="btn btn-icon-toggle btn-default-light pull-right" data-dismiss="offcanvas">
                        <i class="md md-close"></i>
                    </a>
                </div>
            </div>

            <div class="offcanvas-body no-padding">
                <ul class="list liveSupportUsers">
                </ul>
            </div>
        </div>


        <div id="offcanvas-chat" class="offcanvas-pane style-default-light width-12">
            <div class="offcanvas-head style-default-bright">
                <header class="text-primary">Chat with <span id="LiveSupportUser"></span></header>
                <div class="offcanvas-tools">
                    <a class="btn btn-icon-toggle btn-default-light pull-right" data-dismiss="offcanvas">
                        <i class="md md-close"></i>
                    </a>
                    <a class="btn btn-icon-toggle btn-default-light pull-right" href="#offcanvas-search"
                       data-toggle="offcanvas" data-backdrop="false">
                        <i class="md md-arrow-back"></i>
                    </a>
                </div>
                <form class="form">
                    <div class="form-group floating-label">
                        <textarea name="sidebarChatMessage" id="sidebarChatMessage" class="form-control autosize"
                                  rows="1"></textarea>
                        <label for="sidebarChatMessage">Leave a message</label>
                    </div>
                </form>
            </div>

            <div class="offcanvas-body">
                <ul class="list-chats LiveSupportThreadMesages">
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- End: Main -->

<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/jquery/jquery-migrate-1.2.1.min.js") }}"></script>
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/jquery-ui/jquery-ui.min.js") }}"></script>
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/jqueryupload/js/jquery.fileupload.js") }}"></script>
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/bootstrap/bootstrap.min.js") }}"></script>
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/libs/spin.js/spin.min.js") }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/libs/autosize/jquery.autosize.min.js") }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/libs/moment/moment.min.js") }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/core/cache/ec2c8835c9f9fbb7b8cd36464b491e73.js") }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/libs/jquery-knob/jquery.knob.min.js") }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/libs/sparkline/jquery.sparkline.min.js") }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/libs/nanoscroller/jquery.nanoscroller.min.js") }}"></script>--}}
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/summernote/summernote.min.js") }}"></script>
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/core/cache/43ef607ee92d94826432d1d6f09372e1.js") }}"></script>--}}
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/core/cache/63d0445130d69b2868a8d28c93309746.js") }}"></script>
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/core/demo/Demo.js") }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/libs/jquerymask/jquery.maskedinput.min.js") }}"></script>--}}

{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/libs/timepicker/bootstrap-timepicker.min.js") }}"></script>--}}
{{--<script type="text/javascript"--}}
{{--        src="{{ asset("material/js/modules/materialadmin/libs/bootstrap-material-datetimepicker-gh-pages/js/bootstrap-material-datetimepicker.js") }}"></script>--}}

<script src="{{ asset("material/datatable/datatables.min.js") }}"></script>
<script src="{{ asset("material/dropzone/dist/dropzone.js") }}"></script>

<script src="{{ asset("material/select2/dist/js/select2.min.js") }}"></script>

<script type="text/javascript">

    jQuery(document).ready(function () {

        $('.summernote').summernote({
            height: 200
        });

        $('.select2').select2();

        sideMenu();

    });

    function make_note(type, message) {
        $('#content').prepend('<div class="alert alert-' + type + ' alert-dismissible text-center fade in" role="alert">'
            + '<button type="button" class="close alert_button_from_flash" id="alert_button_from_flash" data-dismiss="alert"><span'
            + 'aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
            + '<strong>' + message + '</strong>'
            + '</div>');
        $(window).scrollTop( 0 );
        setTimeout(function () {
            $('.alert_button_from_flash').trigger('click')
        }, 5000);
    }

    function sideMenu() {
        // Collapse Side Menu on Click
        $(".sidebar-toggle").click(toggleSideMenu);

        // Adds a single class to body which we use to
        // collapse entire side menu via preset CSS
        function toggleSideMenu() {
            if ($('body').hasClass('sidebar-collapsed')) {
                $('body').removeClass('sidebar-collapsed');
            }
            else {
                $('body').addClass('sidebar-collapsed');
            }
        }

        // If window is under 1200 we remove the sidemenu collapsed class
        // At <1200px CSS media queries will take over and JS will only interfere
        $(window).resize(function () {
            if ($(window).width() < 1200) {
                if ($('body').hasClass('sidebar-collapsed')) {
                    $('body').removeClass('sidebar-collapsed');
                }
            }
        });

        //SideMenu animated accordion toggle
        $('#sidebar-menu .sidebar-nav a.accordion-toggle').click(function (e) {
            e.preventDefault();

            var SubMenus = $('#sidebar-menu ul.sub-nav'),
                MenuUrl = $(this).attr('href');

            if ($(this).hasClass('collapsed')) {

                // To create accordion effect we collapse all open menus
                $('#sidebar-menu .sidebar-nav > li > a.accordion-toggle').addClass('collapsed');
                $(SubMenus).slideUp('fast');

                // When effect is complete we remove ".menu-open" class
                $(SubMenus).promise().done(function () {
                    $(SubMenus).removeClass('menu-open');
                });

                // We now open the targeted menu item.
                $(this).removeClass('collapsed');
                $(MenuUrl).slideDown('fast', function () {
                    // after the animation we apply the "menu-open" class.
                    // The animation leaves an inline "display:block" style.
                    // We remove this as it interferes with media queries
                    $(MenuUrl).addClass('menu-open').attr('style', '');
                });
            } else {
                $(this).addClass('collapsed');
                $(MenuUrl).slideUp('fast', function () {
                    $(MenuUrl).removeClass('menu-open');
                });
            }
        });
    }
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.datatable').dataTable({
            "paging": false
        });
    });

    function delRow(id) {
        if(confirm("Do You Really Want To Remove The Row?") === false) return false;
        $("." + id).remove();
    }
</script>
</body>
</html>

