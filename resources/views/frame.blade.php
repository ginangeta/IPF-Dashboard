<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/img/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>IPF Exchange Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <!-- CSS Files -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ url('assets/css/demo.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/table.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/car-loader.css') }}" rel="stylesheet" />

    {{-- Toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="red" data-image="{{ url('assets/img/sidebar-4.jpg') }}">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        IPF Exchange
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('home') }}">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('application') }}">
                            <i class="nc-icon nc-notes"></i>
                            <p>Application</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('customers_covers') }}">
                            <i class="nc-icon nc-align-center"></i>
                            <p>Covers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('customers') }}">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Customers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('customers_payments') }}">
                            <i class="nc-icon nc-money-coins"></i>
                            <p>Payments</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('categories') }}">
                            <i class="nc-icon nc-grid-45"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('products') }}">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('offers') }}">
                            <i class="nc-icon nc-preferences-circle-rotate"></i>
                            <p>Offers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('message_template') }}">
                            <i class="nc-icon nc-layers-3"></i>
                            <p>Templates</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('messages') }}">
                            <i class="nc-icon nc-chat-round"></i>
                            <p>Messages</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('users') }}">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('signin') }}">
                            <i class="nc-icon nc-settings-gear-64"></i>
                            <p>Log Out</p>
                        </a>
                    </li>
                    <li class="nav-item active active-pro d-none">
                        <a class="nav-link active" href="upgrade.html">
                            <i class="nc-icon nc-settings-gear-64"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg" color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo">
                        @yield('title')
                    </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <p class="mb-0"><b class="session-timer"></b></p>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                @yield('content')
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
        {{-- Progress --}}
        <div class="modal fade" id="progress_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="loader">
                            <div class="d-flex align-items-center flex-column">
                                <div class="clock-loader"></div>
                                <div class="status">
                                    <span class="progress_title">
                                        Verifying Application Details
                                    </span>
                                    <span class="status__dot">.</span><span class="status__dot">.</span><span
                                        class="status__dot">.</span>
                                </div>
                                <small class="progress_text">Kindly be patient as we verify your account
                                    details</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{ url('assets/js/core/jquery.3.5.1.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/plugins/bootstrap-switch.js') }}"></script>
<!--  Google Maps Plugin    -->
{{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
{{-- Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!--  Chartist Plugin  -->
<script src="{{ url('assets/js/plugins/chartist.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ url('assets/js/plugins/bootstrap-notify.js') }}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{ url('assets/js/light-bootstrap-dashboard.js?v=2.0.0 ') }}" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ url('assets/js/demo.js') }}"></script>
<script src="{{ url('assets/js/table.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        setTimeout(fade_out, 2000);

        function fade_out() {
            $(".alert").fadeOut().empty();
        }

        window.setInterval(function() {
            const endtime = `{{ Session::get('endOfLifetime') }}`;
            // console.log(Date.parse(endtime), Date.parse(new Date()));
            if (Date.parse(endtime) < Date.parse(new Date())) {
                // location.href("{{ route('signin') }}");
                var url = window.location.href;
                `{{ Session::put('previous_url', `+url+`) }}`;
                window.location.replace("{{ route('signin') }}");

            } else {
                const total = Date.parse(endtime) - Date.parse(new Date());
                const seconds = Math.floor((total / 1000) % 60);
                const minutes = Math.floor((total / 1000 / 60) % 60);
                const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
                const days = Math.floor(total / (1000 * 60 * 60 * 24));

                $('.session-timer').html(days + ' Days ' + hours + ' Hours ' + minutes +
                    ' Minutes ' +
                    seconds + ' Seconds ');
            }

        }, 1000);
    });

    $('.nav-item').on('click', function(e) {
        $(this).addClass('active').siblings().removeClass('active');

    });
</script>

@yield('scripts')


</html>
