@extends('auth.main')

@section('title')
    Verify Email
@endsection

@section('content')





    {{--    <form class="login-form" action="index.html" _lpchecked="1">--}}
    <div class="card mb-0 col-md-7">
        <div class="card-body">
            <div class="text-center mb-3">
                <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                <h5 class="mb-0">Verify Your Email Address</h5>
                <span class="d-block text-muted">Your email has not been verified</span>
            </div>

            <div class="form-group form-group-feedback form-group-feedback-right">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                @if (session('ver_expires'))
                    <div class="alert alert-danger" role="alert">
                        {{ __('The verification link has expired, click below to request another.') }}
                    </div>
                @endif
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},</br>
            </div>

           <a href="{{ route('verification.resend') }}" class="btn bg-blue btn-block "> <i class="icon-spinner11 mr-2"></i> click here to request another</a>
        </div>
    </div>
    {{--    </form>--}}
    {{--    <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}
    {{--            <div class="col-md-8">--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>--}}

    {{--                    <div class="card-body">--}}
    {{--                        @if (session('resent'))--}}
    {{--                            <div class="alert alert-success" role="alert">--}}
    {{--                                {{ __('A fresh verification link has been sent to your email address.') }}--}}
    {{--                            </div>--}}
    {{--                        @endif--}}

    {{--                        {{ __('Before proceeding, please check your email for a verification link.') }}--}}
    {{--                        {{ __('If you did not receive the email') }}, <a--}}
    {{--                                href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
