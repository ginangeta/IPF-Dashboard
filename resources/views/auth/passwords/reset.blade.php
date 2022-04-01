@extends('auth.main')
@section('title')
    Reset Password | {{ config('app.name', 'Ipay CRM') }}
@endsection
@section('content')
    <div class="col-md-6 col-12 px-0">
        <div class="card disable-rounded-right d-flex justify-content-center mb-0 p-2 h-100">
            <div class="card-header pb-1">
                <div class="card-title  text-center">
                    <img class="card-img-top" style="height:100px;" src="{{url('img/ipaylogo.svg')}}"
                         alt="Card image cap">

                    {{--                    <h4 class="text-center mb-2">Login to your account</h4>--}}
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label class="text-bold-600" for="emailaddress">Email address</label>
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   value="{{ $email ?? old('email') }}" type="email" name="email" id="email"
                                   placeholder="Enter your email" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-bold-600" for="exampleInputPassword1">New Password</label>
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required type="password" id="password"
                                   placeholder="Enter your password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                        </div>
                        <div class="form-group mb-2">
                            <label class="text-bold-600" for="exampleInputPassword2">Confirm New
                                Password</label>
                            <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                   name="password_confirmation" required type="password" id="password_confirmation"
                                   placeholder="Enter your password again">
                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <button style="color: #fff;background-color: #0072bc; border-color: #0072bc;" type="submit" class="btn glow position-relative w-100">Reset my
                            password<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
