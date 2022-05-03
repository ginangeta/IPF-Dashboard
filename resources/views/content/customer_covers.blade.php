@extends('frame')
@section('title')
    @if ($single)
        Customers Covers for Customer Number {{ $single ?? '' }}
    @else
        Customers Covers
    @endif
@endsection
@section('content')
    <style>
        .clock-loader {
            --clock-color: #e01703;
            --clock-width: 4rem;
            --clock-radius: calc(var(--clock-width) / 2);
            --clock-minute-length: calc(var(--clock-width) * 0.4);
            --clock-hour-length: calc(var(--clock-width) * 0.2);
            --clock-thickness: 0.2rem;

            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: var(--clock-width);
            height: var(--clock-width);
            border: 3px solid var(--clock-color);
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .clock-loader::before,
        .clock-loader::after {
            position: absolute;
            content: "";
            top: calc(var(--clock-radius) * 0.25);
            width: var(--clock-thickness);
            background: var(--clock-color);
            border-radius: 10px;
            transform-origin: center calc(100% - calc(var(--clock-thickness) / 2));
            animation: spin infinite linear;
        }

        .clock-loader::before {
            height: var(--clock-minute-length);
            animation-duration: 2s;
        }

        .clock-loader::after {
            top: calc(var(--clock-radius) * 0.25 + var(--clock-hour-length));
            height: var(--clock-hour-length);
            animation-duration: 15s;
        }


        @keyframes spin {
            to {
                transform: rotate(1turn);
            }
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
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
                                    <th>Cover Status</th>
                                    <th>Cover Type</th>
                                    <th>Car Reg Number</th>
                                    <th>Policy Number</th>
                                    <th>Car Value</th>
                                    <th>Loan Amount</th>
                                    <th>Policy Premium</th>
                                    <th>Policy Deposit</th>
                                    <th>Installment</th>
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
                                                <td>{{ $customer->customer_cover_status }}</td>
                                                <td>{{ $customer->cover_type }}</td>
                                                <td>{{ $customer->car_reg_number }}</td>
                                                <td>{{ $customer->policy_number }}</td>
                                                <td>{{ number_format($customer->car_value) }}</td>
                                                <td>{{ number_format($customer->loan) }}</td>
                                                <td>{{ number_format($customer->premium) }}</td>
                                                <td>{{ number_format($customer->deposit) }}</td>
                                                <td>{{ number_format($customer->installment) }}</td>
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
                                        <tr>
                                            <td colspan="14">
                                                <p class="text-center">no data found</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payment Mode --}}
        <div class="modal fade modal-mini modal-primary" id="payment_options" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4>Payment Options.</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-center align-items-center flex-column"
                                style="border-right: 1px solid lightgrey">
                                <div class="modal-profile">
                                    <i class="nc-icon nc-credit-card"></i>
                                </div>
                                <h5 class="mt-1"><strong>Card</strong></h5>
                            </div>
                            <div class="col-6 d-flex justify-content-center align-items-center flex-column">
                                <div class="modal-profile">
                                    <i class="nc-icon nc-mobile"></i>
                                </div>
                                <h5 class="mt-1"><strong>Mpesa</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link btn-neutral">Back</button>
                        <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payment --}}
        <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-start">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button>
                        <h4 class="title title-up mt-0 p-0">Payment</h4>
                    </div>
                    <div class="modal-body pt-0">
                        <form class="card-form row">
                            <div class="col-12">
                                <div class="form-group pb-2">
                                    <input type="text" class="form-control" id="card_holder"
                                        placeholder="Enter Name On Card">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-8">
                                <div class="form-group pb-2">
                                    <input type="number" class="form-control" id="card_number"
                                        placeholder="Enter Card Number">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group pb-2">
                                    <input type="number" class="form-control" id="cvc" placeholder="CVC">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group pb-2">
                                    <input type="date" class="form-control" id="exp_date" placeholder="Exp date (mm/yy)">
                                </div>
                            </div>
                            <span class="btn btn-warning btn-round btn-block pay" id="pay" type="button">
                                Make Payment
                            </span>
                        </form>
                        <form class="mpesa-form">
                            <div class="form-group pb-2">
                                <label for="payment_phone">Mobile Number</label>
                                <input type="number" name="payment_phone" class="form-control" id="payment_phone"
                                    placeholder="Enter Mobile Number">
                                <span class="btn btn-primary btn-round btn-block pay" style="margin-top:30px !important"
                                    id="payment_push" type="button">
                                    Send Payment Push
                                </span>
                            </div>
                        </form>
                        <div class="loader">
                            <div class="d-flex align-items-center flex-column">
                                <div class="clock-loader"></div>
                                <div class="status">
                                    Verifying Payment
                                    <span class="status__dot">.</span><span class="status__dot">.</span><span
                                        class="status__dot">.</span>
                                </div>
                                <small>Verifying Payment of <b class="amount">10</b> made to IPF Exchange from <b
                                        class="phone-number"></b></small>
                            </div>
                        </div>
                        <div class="success">
                            <div class="d-flex align-items-center flex-column">
                                <img src="{{ url('assets/img/success.png') }}" style="max-width: 100px;">
                                <div class="status">
                                    Payment <span class="payment_code"></span> Made Successfully
                                    <span class="status__dot">.</span><span class="status__dot">.</span><span
                                        class="status__dot">.</span>
                                </div>
                                <small>Kindly confirm</small>
                                <a href="{{ route('customers.payments') }}"
                                    class="btn btn-primary btn-round btn-block">OK</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection @section('scripts')
    <script>
        $(function() {
            var $contacts = [];
            var cover_id;

            $('.cover_id').on('click', function() {
                $('#payment_options').modal('show');
                cover_id = $(this).html();
            });


            $('.modal-profile').on('click', function() {
                var payment_mode = $(this).next().find('strong').html();
                if (payment_mode == "Mpesa") {
                    $('.mpesa-form').removeClass('d-none').siblings().addClass('d-none');
                } else {
                    $('.card-form').removeClass('d-none').siblings().addClass('d-none');
                }
                $('#payment').modal('show');
                $('#payment_options').modal('hide');
            });

            $('#payment_push').on('click', function() {
                $(this).removeClass('btn-primary').addClass('btn-outline-primary');
                $('.loader').removeClass('d-none').siblings().addClass('d-none');
                $('.close').addClass('d-none');

                var payment_phone = $('input[name=payment_phone]').val();
                $('.phone-number').html(payment_phone);

                console.log(cover_id);
                // $('#payment_options').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                    }
                });

                $.post("{{ url('application_payment') }}", {
                    payment_phone: payment_phone,
                    cover_id: cover_id,
                }).done(function(data) {
                    console.log("ResponseText:" + data);
                    if (data.response_code == 200) {
                        // alert('Here');
                        $('.payment_code').html(data.resource.other_ref);
                        $('.success').removeClass('d-none').siblings().addClass('d-none');
                        $('.close').removeClass('d-none');
                    } else {
                        $.each(data.errors, function(key, val) {
                            toastr.error(val.message);
                        });
                    }
                }).fail(function(data) {
                    $.each(data.errors, function(key, val) {
                        toastr.error(val.message);
                    });
                });

                // $('#payment').modal('hide');

            });
        });
    </script>
@endsection
