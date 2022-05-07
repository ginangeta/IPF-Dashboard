@extends('frame')
@section('title')
    Lead Application
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- @dd(@$customers) --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">IPF Application
                            {{ @$customers->first_name . ' ' . @$customers->last_name }}
                        </h4>
                        {{-- @dd(@$quotation->plate_number) --}}
                        <p class="mb-0">For Vehicle: {{ @$quotation->plate_number }}</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="form-horizontal" novalidate="" method="POST"
                            action="{{ url('storeLead') }}">
                            @csrf
                            @if ($errors->any())
                                <p class="alert alert-danger">{{ $errors->first() }}</p>
                            @endif
                            @if (Session::has('success'))
                                <p class="alert alert-success">{{ Session::get('success') }}</p>
                            @endif
                            <div class="row p-4">
                                <input type="hidden" name="customer_id" value="{{ @$customers->customer_id }}">
                                <input type="hidden" name="car_reg_number" value="{{ @$quotation->plate_number }}">
                                <input type="hidden" name="installment" value="{{ @$quotation->data->installment }}">
                                <input type="hidden" name="premium" value="{{ @$quotation->vehicle_premium }}">
                                <input type="hidden" name="start_date" value="{{ @$quotation->dates->start_date }}">
                                <input type="hidden" name="end_date" value="{{ @$quotation->dates->end_date }}">
                                <input type="hidden" name="offer_id" value="{{ @$quotation->offer_id }}">
                                <input type="hidden" name="loan" value="{{ @$quotation->data->total }}">
                                <input type="hidden" name="car_value" value="{{ @$quotation->car_value }}">
                                <input type="hidden" name="interest_rate" value="10">
                                <input type="hidden" name="balance" value="0">
                                <input type="hidden" name="tenure" value="1">

                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Deposit Amount</label>
                                        <input type="number" class="form-control" name="deposit"
                                            value="{{ @$quotation->data->deposit }}" aria-describedby="plateHelp"
                                            placeholder="Enter Deposit Amount">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 d-none">
                                    <div class="form-group">
                                        <label>Lead Status</label>
                                        <select name="customer_lead_status" class="form-control"
                                            id="customer_lead_status">
                                            <option value="PENDING_PAYMENT">Pending Payment</option>
                                            <option value="PAID">PAID</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Car Make</label>
                                        <input type="text" class="form-control" name="car_make" placeholder="Mazda">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Car Model</label>
                                        <input type="text" class="form-control" name="car_model"
                                            placeholder="Axela, Atenxa, Demio etc">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Car Use</label>
                                        <select name="use_type" class="form-control" id="use_type">
                                            <option value="PRIVATE">Private</option>
                                            <option value="PSV">Psv</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Cover Type</label>
                                        <select name="cover_type" class="form-control" id="cover_type">
                                            <option value="COMPREHENSIVE">Comprehensive</option>
                                            <option value="THIRDPARTY">Third Party</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Year of Manufacture</label>
                                        <input type="number" class="form-control" name="year_of_manufacture">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Year of Registration</label>
                                        <input type="number" class="form-control" name="year_of_registration">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Chasis Number</label>
                                        <input type="text" class="form-control" name="chassis_number">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Submit Application</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
