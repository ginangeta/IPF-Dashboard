<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>IPF Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/my-login.css') }}">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body>
    <div class="my-login-page clear-filter" filter-color="orange">
        <div class="my-login-page-image" data-parallax="true"
            style="background-image:url('{{ url('assets/img/car.jpg') }}');">
        </div>
        <div class="form-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="card p-4">
                            <div class="brand d-flex justify-content-center">
                                {{-- <img src="{{ url('img/now-logo.png') }}" alt="logo"> --}}
                            </div>
                            <!-- left section-login -->
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    @yield('scripts')

</body>

</html>
