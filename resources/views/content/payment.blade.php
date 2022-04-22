@extends('frame')
@section('title')
    Customers Covers
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-sm-12 d-sm-none d-md-flex">
                <div class="card h-100 w-100">
                    <div class="card-header">
                        <h4 class="card-title">IPF Application Deposit Payment
                            {{ @$cover[0]->car_reg_number }}
                        </h4>
                        <p class="mb-0">For Loan Amount: {{ @$cover[0]->loan }}</p>
                    </div>
                    <div class="card-body">
                        <img src="{{ url('img/happy_payment.jpg') }}" alt="logo" class="img-fluid mt-4">
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">IPF Application Details
                            {{ @$cover[0]->car_reg_number }}
                        </h4>
                        <p class="mb-0">Details of the loan application</p>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Cover Status : </span>
                                <strong>
                                    <span>{{ @$cover[0]->customer_cover_status }}</span>
                                </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Car Use : </span>
                                <strong>
                                    <span>{{ @$cover[0]->use_type }}</span>
                                </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Premium (a) : </span>
                                <strong>
                                    KES <span>{{ number_format(@$cover[0]->premium) }}</span>
                                </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Deposit (b) : </span>
                                <strong>
                                    KES <span>{{ number_format(@$cover[0]->deposit) }}</span>
                                </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Balance : </span>
                                <strong>
                                    KES <span>{{ number_format(@$cover[0]->balance) }}</span>
                                </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Instalment : </span>
                                <strong>
                                    KES <span>{{ number_format(@$cover[0]->installment) }}</span>
                                </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Start Date : </span>
                                <strong>
                                    <span>{{ \Carbon\Carbon::parse(@$cover[0]->start_date)->format('jS M Y') }}</span>
                                </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>End Date : </span>
                                <strong>
                                    <span>{{ \Carbon\Carbon::parse(@$cover[0]->end_date)->format('jS M Y') }}</span>
                                </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Application Date : </span>
                                <strong>
                                    <span>{{ \Carbon\Carbon::parse(@$cover[0]->date_time_added)->format('jS M Y') }}</span>
                                </strong>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="cover_id btn btn-info btn-secondary">Pay</button>
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
                        <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Back</button>
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
                                <label for="expected_name">Expected Name</label>
                                <input type="text" name="expected_name" class="form-control" id="expected_name"
                                    placeholder="Enter Mpesa Expected Name" style="text-transform:uppercase">
                                <span class="btn btn-primary btn-round btn-block pay mt-2" id="payment_push" type="button">
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
                                    Payment <span class="payment_code"></span> Made Initiated Successfully
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
                var expected_name = $('input[name=expected_name]').val();
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
                    expected_name: expected_name,
                    cover_id: `{{ @$cover[0]->customer_cover_id }}`,
                    customer_id: `{{ @$cover[0]->customer_id }}`,
                    customer_lead_id: `{{ @$cover[0]->customer_lead_id }}`,
                    deposit: `{{ @$cover[0]->deposit }}`,
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
