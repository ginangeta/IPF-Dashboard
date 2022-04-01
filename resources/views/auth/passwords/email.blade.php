@extends('auth.main')
@section('title')
    Forgot Password | {{ config('app.name', 'Ipay CRM') }}
@endsection
@section('content')
    <div class="col-md-6 col-12 px-0">
        <div class="card disable-rounded-right mb-0 p-2">
            <div class="card-header pb-1">
                <div class="card-title  text-center">
                    <img class="card-img-top" style="height:100px;" src="{{url('img/ipaylogo.svg')}}"
                         alt="Card image cap">

                    {{--                    <h4 class="text-center mb-2">Login to your account</h4>--}}
                </div>
            </div>

            <div class="card-content">
                <div class="card-body">
                    <div class="text-muted text-center mb-2"><small>Enter the email or phone number you
                            used
                            when you joined
                            and we will send you temporary password</small></div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-group mb-2">
                            <label class="text-bold-600" for="emailaddress">Email </label>
                            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   id="emailaddress"
                                   placeholder="Enter your email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <button style="color: #fff;background-color: #0072bc; border-color: #0072bc;" type="submit" class="btn glow position-relative w-100">SEND
                            PASSWORD<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                    </form>
                    <div class="text-center mb-2"><a href="{{ url('login') }}"><small class="text-muted">I
                                remembered my
                                password</small></a></div>
                    <div class="divider mb-2">
                        <div class="divider-text">Or</div>
                    </div>
                    <div class="form-group justify-content-between align-items-center mb-2">
                        <div class="text-center">
                            <div class="ml-3 ml-md-2 mr-1">
                                <a href="{{url('login')}}"
                                   class="card-link btn btn-outline-primary text-nowrap load-page">Sign
                                    in</a>
                            </div>
                        </div>
{{--                        <div class="mr-3"><a href="{{url('register')}}"--}}
{{--                                             class="card-link btn btn-outline-primary text-nowrap load-page">Sign--}}
{{--                                up</a></div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
