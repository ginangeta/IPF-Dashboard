@extends('frame')
@section('title')
    Application
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
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Car Registration Number</label>
                                        <input type="text" class="form-control" name="car_reg_number"
                                            aria-describedby="plateHelp" placeholder="Enter Plate Number"
                                            style="text-transform:uppercase" size="7" maxlength="7">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Balance</label>
                                        <input type="number" class="form-control" name="balance"
                                            aria-describedby="plateHelp" placeholder="Enter balance">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Deposit Amount</label>
                                        <input type="number" class="form-control" name="deposit"
                                            aria-describedby="plateHelp" placeholder="Enter Deposit Amount">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
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
                                        <label>Installments</label>
                                        <input type="number" class="form-control" name="installment"
                                            aria-describedby="plateHelp" placeholder="Enter Installments">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Interest Rate</label>
                                        <input type="number" class="form-control" name="interest_rate"
                                            aria-describedby="plateHelp" placeholder="Enter Interest Rate">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Loan</label>
                                        <input type="number" class="form-control" name="loan" aria-describedby="plateHelp"
                                            placeholder="Enter Loan Amount">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" name="start_date">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control" name="end_date">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Offer ID</label>
                                        <select name="offer_id" class="form-control" id="offer_id">
                                            @foreach ($offers as $offer)
                                                <option value="{{ $offer->offer_id }}">{{ $offer->offer }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Premium</label>
                                        <input type="number" class="form-control" name="premium"
                                            aria-describedby="plateHelp" placeholder="Enter Premium Amount">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Tenure</label>
                                        <input type="text" class="form-control" name="tenure" aria-describedby="plateHelp"
                                            placeholder="Enter Tenure">
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
