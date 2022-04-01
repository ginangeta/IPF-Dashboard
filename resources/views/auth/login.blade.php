@extends('auth.main')
@section('content')
    <form method="POST" class="form-horizontal" novalidate="" method="POST" action="{{ url('authenticate') }}">
        @csrf
        @if ($errors->any())
            <p class="alert alert-danger">{{ $errors->first() }}</p>
        @endif
        @if (Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
        <h2 class="heading text-center">Log In</h2>
        <div class="form-group d-flex flex-column">
            <label for="username" class="d-flex justify-content-start">E-Mail Address / Username</label>
            <input type="text" name="username" class="form-control" {{-- value="ROWFKaLK2T" --}} id="inputEmail3"
                placeholder="Email or Username">
            <i class="fa fa-user"></i>
            @if ($errors->has('username'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('username') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="password" class="d-flex justify-content-start">Password</label>
            <input type="password" name="password" class="form-control" {{-- value="AwpGIXA4Truccn6t" --}} id="inputPassword3"
                placeholder="Password">
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group m-0">
            <button type="submit" class="btn btn-primary btn-block">
                Login
            </button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(fade_out, 2000);

            function fade_out() {
                $(".alert").fadeOut().empty();
            }

        });
    </script>
@endsection
