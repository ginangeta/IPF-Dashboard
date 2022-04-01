@extends('auth.main')
@section('title')
    Register | {{ config('app.name', 'Ipay CRM') }}
@endsection

@section('content')
    <div class="col-md-12 col-12 px-0">
        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
            <div class="card-header text-center">
                <?php
                $default_logo = asset('/')."/img/ipaylogo.svg";
                if (@getimagesize(@$organization->auth_page_logo))
                    $auth_page_logo = asset($organization->auth_page_logo);
                else if (@getimagesize($default_logo))
                    $auth_page_logo = $default_logo;
                else if (@getimagesize(@$organization->logo))
                    $auth_page_logo = asset($organization->logo);
                ?>
                <img class="card-img-top" style="width: auto" src="{{ $auth_page_logo }}" height="60" alt="Card image cap">

                {{--                <div class="card-title">--}}
                {{--                    <h4 class="text-center mb-2">Sign Up</h4>--}}
                {{--                </div>--}}
            </div>
            <div class="text-center">
                <p><small>Don't have an account? Create your own account, it takes less than a
                        minute</small>
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form method="POST" action="{{ url('register-user') }}" class="ajax-post">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-50 col-md-6">
                                <label class="text-bold-600" for="name">First Name</label>
                                <input type="text" class="form-control" name="first_name"
                                       placeholder="First Name">
                            </div>
                            <div class="form-group mb-50 col-md-6">
                                <label class="text-bold-600" for="name">Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                       placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-50 col-md-6">
                                <label class="text-bold-600" for="name">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name"
                                       placeholder="Middle Name">
                            </div>

                            <div class="form-group mb-50 col-md-6">
                                <label class="text-bold-600" for="email">Phone number</label>
                                <input  name="phone" class="form-control"
                                        placeholder="Phone Number">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mb-50 col-md-6">
                                <label class="text-bold-600 col-md-12" for="email">Email address <small class="float-right">(******@calltronix.co.ke)</small></label>
                                <input  name="email" class="form-control"
                                        placeholder="Email address : ******@calltronix.co.ke">
                            </div>
                            <div class="form-group mb-50 col-md-6">
                                <label class="text-bold-600" for="email">Department</label>
                                <select  name="department_id" class="form-control select2">
{{--                                    @foreach($departments as $department)--}}
{{--                                        <option value="{{ $department->id }}">{{ $department->name }}</option>--}}
{{--                                        @endforeach--}}
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-50 col-md-6">
                                <label class="text-bold-600" for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="Password">
                            </div>
                            <div class="form-group mb-50 col-md-6">
                                <label class="text-bold-600" for="password_confirmation"> Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control"
                                       placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="row col-md-12 text-center">
                            <div class="col-md-12">
                                <button style="color: #fff;background-color: #0072bc; border-color: #0072bc;" type="submit" class="btn glow position-relative submit submit-btn">
                                    SIGN UP <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center"><small class="mr-25">Already have an account?</small><a
                            class="load-page"   href="{{url('login')}}"><small>Sign in</small> </a></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            autoFillSelect('department_id','{{ url('calltronix-departments/list?all=1') }}')
        })
    </script>

@endsection
