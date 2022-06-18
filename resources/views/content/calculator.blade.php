@extends('frame')
@section('title')
    Quotation Calculator
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">IPF Quotation Calculator </h4>
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
                                <div class="col-md-6 col-sm-12">
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
                                <div class="col-md-6 col-sm-12">
                                    <label for="product">Product</label>
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
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="vehicle">Vehicle Premium</label>
                                        <input type="number" class="form-control" name="vehicle_premium"
                                            placeholder="Enter Vehicle's Premium">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="vehicle">Tenor</label>
                                    <select class="form-control" name="tenor">
                                        @foreach ($tenor_types as $tenor_type)
                                            <option value="{{ $tenor_type->enum_label }}">
                                                {{ Illuminate\Support\Str::upper($tenor_type->enum_label) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="button" id="compute_quote" class="btn btn-info btn-fill pull-right">Get
                                Quotation</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card quotation_details d-none h-100">
                    <div class="card-header">
                        <h4 class="card-title">IPF Quotation </h4>
                    </div>
                    <div class="card-body">
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
            var tenor = $('select[name=tenor]').val();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                }
            });

            console.log(vehicle_premium, product_id, category_id);

            $.post("{{ url('calculate') }}", {
                vehicle_premium: vehicle_premium,
                product_id: product_id,
                category_id: category_id,
                tenor: tenor,

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
                    $('.quotation_details').removeClass('d-none');
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
    <script>
        $(document).ready(function() {
            getCategoryProducts();
        });

        $(document).on('change', 'select[name=category_id]', function() {
            getCategoryProducts();
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
