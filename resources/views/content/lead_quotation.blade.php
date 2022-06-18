@extends('frame')
@section('title')
    Application Quotation
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="modal fade" id="quotation_details" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                                    Quotation For {{ @$customers->first_name . ' ' . @$customers->last_name }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Premium (a) : </span>
                                        <strong>KES <span class="premium_value"></span></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Deposit (b) : </span>
                                        <strong>KES <span class="premium_deposit"></span></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Facility fee (c) : </span>
                                        <strong>KES <span class="premium_facility_fee"></span></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Payable now (a+c) : </span>
                                        <strong>KES <span class="premium_payable"></span></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Installment : </span>
                                        <strong>KES <span class="premium_installment"></span></strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info btn-secondary" data-dismiss="modal">OK</button>
                                <a href="{{ url('lead_application', @$customers->customer_id) }}"
                                    class="btn btn-success btn-secondary">Submit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">IPF Application Quotation For
                        {{ @$customers->first_name . ' ' . @$customers->last_name }}
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST">
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
                                    <label for="vehicle">Underwriter</label>
                                    <select class="form-control" name="category_id">
                                        @if ($categories)
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}">
                                                    {{ $category->category }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="vehicle">Product</label>
                                <span>
                                    <div class="demo-container d-none">
                                        <div class="progress-bar">
                                            <div class="progress-bar-value"></div>
                                        </div>
                                    </div>
                                    <select class="form-control" name="product_id" aria-placeholder="Product Id">
                                    </select>
                                </span>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="plate_number">Vehicle Plate Number</label>
                                    <input type="text" class="form-control" name="plate_number"
                                        aria-describedby="plateHelp" placeholder="Enter Plate Number"
                                        style="text-transform:uppercase" size="7" maxlength="7">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vehicle">Vehicle Value</label>
                                    <input type="text" class="form-control number-input" name="value"
                                        placeholder="Enter Vehicle's Estimated Value">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vehicle">Vehicle Premium</label>
                                    <input type="text" class="form-control number-input" name="vehicle_premium"
                                        placeholder="Enter Vehicle's Premium">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 d-none">
                                <label for="vehicle">IPF Term</label>
                                <select class="form-control" name="tenor">
                                    @foreach ($tenor_types as $tenor_type)
                                        <option value="{{ $tenor_type->enum_label }}">
                                            {{ Illuminate\Support\Str::upper($tenor_type->enum_label) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vehicle">Policy Start Date</label>
                                    <input type="date" name="start_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 d-none">
                                <div class="form-group">
                                    <label for="vehicle">End Date</label>
                                    <input type="date" name="end_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="button" id="compute_quote" class="btn btn-info btn-fill pull-right">Get
                            Quotation</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#compute_quote', function() {
            $(this).removeClass('btn-primary').addClass('btn-outline-primary');
            $('.progress_title').html('Obtaining Quotation Details')
            $('.progress_text').html('Kindly be patient as we obtain the quotation details')
            $('#progress_modal').modal('show');

            var vehicle_premium = $('input[name=vehicle_premium]').val();
            vehicle_premium = vehicle_premium.replace(",", "");
            var value = $('input[name=value]').val();
            value = value.replace(new RegExp(",", "g"), "");
            var product_id = $('select[name=product_id]').val();
            var category_id = $('select[name=category_id]').val();
            var customer_id = `{{ @$customers->customer_id }}`;

            var plate_number = $('input[name=plate_number]').val();
            var start_date = $('input[name=start_date]').val();
            var end_date = $('input[name=end_date]').val();
            var tenor = $('select[name=tenor]').val();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                }
            });

            console.log(vehicle_premium, product_id, category_id);

            $.post("{{ url('get_quotation') }}", {
                vehicle_premium: vehicle_premium,
                product_id: product_id,
                category_id: category_id,
                customer_id: customer_id,
                plate_number: plate_number,
                start_date: start_date,
                end_date: end_date,
                value: value,
                tenor: tenor,

            }).done(function(data) {
                console.log("ResponseText:" + data);
                if (data) {
                    var deposit_amount = data.deposit;
                    $('.premium_value').html(vehicle_premium.toLocaleString());
                    $('.premium_deposit').html(data.deposit.toLocaleString());
                    $('.premium_facility_fee').html(data.cost.toLocaleString());
                    $('.premium_payable').html(data.total.toLocaleString());
                    $('.premium_installment').html(data.installment.toLocaleString());
                    $('#progress_modal').modal('hide');
                    $('#quotation_details').modal('show');
                } else {
                    // $('#payment_options').modal('show');
                    $.each(data.errors, function(key, val) {
                        toastr.error(val.message);
                    });
                }
            }).fail(function(data) {
                $.each(data.errors, function(key, val) {
                    toastr.error(val.message);
                });
            });

            $(this).find('fa-spin').addClass('d-none');
            // $('#message_modal').modal('hide');
        });

        $(document).on('keyup', '.number-input', function() {
            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            getCategoryProducts();
        });

        $(document).on('change', 'select[name=category_id]', function() {
            $(this).removeClass('btn-primary').addClass('btn-outline-primary');
            $('.demo-container').removeClass('d-none');
            $('select[name=product_id]').prop('disabled', true);
            $('select[name=product_id]').empty();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                }
            });

            var category_id = $(this).val();

            $.post("{{ url('categories_products') }}", {
                category_id: category_id,

            }).done(function(data) {
                console.log("ResponseText:" + data);
                if (data) {
                    $.each(data, function(i, item) {
                        $('select[name=product_id]').append($('<option>', {
                            value: item.product_id,
                            text: item.product_name
                        }));
                    });

                } else {
                    // $('#payment_options').modal('show');
                    $.each(data.errors, function(key, val) {
                        toastr.error(val.message);
                    });
                }

                $('.demo-container').addClass('d-none');
                $('select[name=product_id]').prop('disabled', false);

            }).fail(function(data) {
                $.each(data.errors, function(key, val) {
                    toastr.error(val.message);
                });

                $('.demo-container').addClass('d-none');
                $('select[name=product_id]').prop('disabled', false);
            });

        });

        function getCategoryProducts() {
            $('select[name=category_id]').removeClass('btn-primary').addClass('btn-outline-primary');
            $('.demo-container').removeClass('d-none');
            $('select[name=product_id]').prop('disabled', true);
            $('select[name=product_id]').empty();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                }
            });

            var category_id = $('select[name=category_id]').val();

            $.post("{{ url('categories_products') }}", {
                category_id: category_id,

            }).done(function(data) {
                console.log("ResponseText:" + data);
                if (data) {
                    $.each(data, function(i, item) {
                        $('select[name=product_id]').append($('<option>', {
                            value: item.product_id,
                            text: item.product_name
                        }));
                    });

                } else {
                    // $('#payment_options').modal('show');
                    $.each(data.errors, function(key, val) {
                        toastr.error(val.message);
                    });
                }

                $('.demo-container').addClass('d-none');
                $('select[name=product_id]').prop('disabled', false);

            }).fail(function(data) {
                $.each(data.errors, function(key, val) {
                    toastr.error(val.message);
                });

                $('.demo-container').addClass('d-none');
                $('select[name=product_id]').prop('disabled', false);
            });
        }
    </script>
@endsection
