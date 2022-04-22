@extends('frame')
@section('title')
    Application
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">IPF Customer Application</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="d-sm-none d-md-flex col-md-4">
                                <img src="{{ url('img/insurance.jpg') }}" alt="logo" class="form-img">
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                                    action="{{ url('customers') }}">
                                    @csrf
                                    @if ($errors->any())
                                        <p class="alert alert-danger">{{ $errors->first() }}</p>
                                    @endif
                                    @if (Session::has('success'))
                                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                                    @endif
                                    <div class="row p-4">
                                        <div class="col-md-7 col-sm-12">
                                            <div class="form-group">
                                                <label>First Name & Middle Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    aria-describedby="plateHelp" required placeholder="Enter First Name"
                                                    style="text-transform:capitalize">
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-12">
                                            <div class="form-group">
                                                <label>Last name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    aria-describedby="plateHelp" required placeholder="Enter Last Name"
                                                    style="text-transform:capitalize">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="number" class="form-control" name="msisdn"
                                                    aria-describedby="plateHelp" required
                                                    placeholder="Enter Phone Number (254xxxxxxxxx)">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Id Number</label>
                                                <input type="number" class="form-control" name="id_number"
                                                    aria-describedby="plateHelp" required placeholder="Enter Id Number">
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Customer's Email</label>
                                                <input type="email" class="form-control" name="email_address"
                                                    aria-describedby="plateHelp" required placeholder="Enter Email Address"
                                                    style="text-transform:lowercase">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit
                                        Application</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
