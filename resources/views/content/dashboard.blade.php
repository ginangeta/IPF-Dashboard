@extends('frame')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 p-2 text-center"><b>Total Value of IPF</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <h4 class="m-2"><b>Amount</b></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 p-2 text-center"><b>Total Number of IPF Issued</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <h4 class="m-2"><b>Amount</b></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 p-2 text-center"><b>Total Number of Customer</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <h4 class="m-2"><b>Amount</b></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 p-4"><b>10 Most Recent Customer Covers</b></h5>
                        @if ($errors->any())
                            <p class="alert alert-danger">{{ $errors->first() }}
                            </p>
                        @endif
                        @if (Session::has('success'))
                            <p class="alert alert-success">
                                {{ Session::get('success') }}</p>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-body table-full-width table-responsive">
                            <table class="table-hover table-striped table" id="data-table">
                                <thead>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Cover Status</th>
                                    <th>Cover Type</th>
                                    <th>Car Reg Number</th>
                                    <th>Policy Number</th>
                                    <th>Car Use Type</th>
                                    <th>Car Value</th>
                                    <th>Policy Premium</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @if ($customers)
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td><a href="{{ route('lead.payment', $customer->customer_cover_id) }}">
                                                        {{ $customer->customer_cover_id }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <p class="mb-0" style="font-size: revert;">
                                                        {{ $customer->first_name . ' ' . $customer->last_name }}
                                                    </p>
                                                    <small>
                                                        <a href="tel:{{ $customer->msisdn }}">
                                                            {{ $customer->msisdn }}
                                                        </a>
                                                    </small>
                                                </td>
                                                <td>{{ $customer->customer_cover_status }}</td>
                                                <td>{{ $customer->cover_type }}</td>
                                                <td>{{ $customer->car_reg_number }}</td>
                                                <td>{{ $customer->policy_number }}</td>
                                                <td>{{ $customer->use_type }}</td>
                                                <td>{{ number_format($customer->car_value) }}</td>
                                                <td>{{ number_format($customer->premium) }}</td>
                                                {{-- <td>{{ date('Y-m-d H:i:s', $customer->start_date) }} --}}
                                                <td>{{ date('Y-m-d H:i:s', $customer->start_date / 1000) }}
                                                </td>
                                                <td>{{ date('Y-m-d H:i:s', $customer->end_date / 1000) }}
                                                </td>
                                                <td>{{ date('Y-m-d H:i:s', $customer->date_time_added) }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm ml-2"
                                                        data-toggle="modal"
                                                        data-target="#details{{ $customer->customer_cover_id }}"><i
                                                            class="zmdi zmdi-eye"></i>Details</button>
                                                    <button type="button" class="btn btn-warning btn-sm ml-2"
                                                        data-toggle="modal"
                                                        data-target="#edit{{ $customer->customer_cover_id }}"><i
                                                            class="zmdi zmdi-edit"></i>Edit</button>
                                                </td>
                                                {{-- Modals --}}
                                                @include(
                                                    'content.includes.covers.edit_cover'
                                                )
                                                @include(
                                                    'content.includes.covers.cover_details'
                                                )
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="13" class="text-center">No data available in table</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
