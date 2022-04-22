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
                                        <span>Instalment : </span>
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
                                    <label for="plate_number">Vehicle Plate Number</label>
                                    <input type="text" class="form-control" name="plate_number"
                                        aria-describedby="plateHelp" placeholder="Enter Plate Number"
                                        style="text-transform:uppercase" size="7" maxlength="7">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vehicle">Vehicle Value</label>
                                    <input type="number" class="form-control" name="value"
                                        placeholder="Enter Vehicle's Estimated Value">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vehicle">Vehicle Premium</label>
                                    <input type="number" class="form-control" name="vehicle_premium"
                                        placeholder="Enter Vehicle's Premium">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vehicle">Categories</label>
                                    <select class="form-control" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}">
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="vehicle">Product</label>
                                <select class="form-control" name="product_id">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->product_id }}">{{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vehicle">Start Date</label>
                                    <input type="date" name="start_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="vehicle">End Date</label>
                                    <input type="date" name="end_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="button" id="compute_quote" class="btn btn-info btn-fill pull-right">Get
                            Application</button>
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
            var product_id = $('select[name=product_id]').val();
            var category_id = $('select[name=category_id]').val();
            var customer_id = `{{ @$customers->customer_id }}`;

            var plate_number = $('input[name=plate_number]').val();
            var start_date = $('input[name=start_date]').val();
            var end_date = $('input[name=end_date]').val();
            var value = $('input[name=value]').val();


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

            }).done(function(data) {
                console.log("ResponseText:" + data);
                if (data) {
                    var deposit_amount = data.deposit;
                    $('.premium_value').html(vehicle_premium);
                    $('.premium_deposit').html(data.deposit);
                    $('.premium_facility_fee').html(data.cost);
                    $('.premium_payable').html(data.total);
                    $('.premium_installment').html(data.installment);
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
    </script>
@endsection
