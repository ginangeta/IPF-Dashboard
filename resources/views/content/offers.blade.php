@extends('frame')
@section('title')
    Offers
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-end mb-2">
                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal" data-target="#create_offer"><i
                        class="zmdi zmdi-edit"></i>Create</button>

                <div class="modal fade" id="create_offer" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                                    Create Offer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                                    action="{{ url('offers') }}">
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
                                                <label>Product Category</label>
                                                <select name="category_id" class="form-control" id="category_id">
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
                                                <select class="form-control" name="product_id"
                                                    aria-placeholder="Product Id">
                                                </select>
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Deposit Formulae</label>
                                                <input type="text" class="form-control" name="deposit_formulae"
                                                    aria-describedby="plateHelp" required
                                                    placeholder="Enter Deposit Formulae (=B)">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Installement Formulae</label>
                                                <input type="text" class="form-control" name="installment_formulae"
                                                    aria-describedby="plateHelp" required
                                                    placeholder="Enter Installment Formulae (=A)">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Interest Rate</label>
                                                <input type="number" class="form-control" name="interest_rate"
                                                    aria-describedby="plateHelp" required placeholder="Enter Interest Rate">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Offer</label>
                                                <input type="text" class="form-control" name="offer"
                                                    aria-describedby="plateHelp" required placeholder="Enter Offer (AA)">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Tenure</label>
                                                <select name="tenure" class="form-control" id="tenure">
                                                    <option value="1">1 Installment </option>
                                                    <option value="3">3 Installments </option>
                                                    <option value="6">6 Installments</option>
                                                    <option value="10">10 Installments</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Offer Status</label>
                                                <select name="offer_status" class="form-control" id="offer_status">
                                                    <option value="ACTIVE">Active</option>
                                                    <option value="INACTIVE">Inactive</option>
                                                </select>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if ($errors->any())
                            <p class="alert alert-danger">{{ $errors->first() }}</p>
                        @endif
                        @if (Session::has('success'))
                            <p class="alert alert-success">{{ Session::get('success') }}</p>
                        @endif
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table-hover table-striped table" id="data-table">
                            <thead>
                                <th>Id</th>
                                <th>Status</th>
                                <th>Offer</th>
                                <th>Tenure</th>
                                <th>Interest Rate</th>
                                <th>Deposit Formulae</th>
                                <th>Installment Formulae</th>
                                <th>Category Id</th>
                                <th>Product Id</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @if ($offers)
                                    @foreach ($offers as $offer)
                                        <tr>
                                            <td>{{ $offer->offer_id }}</td>
                                            <td>{{ $offer->offer_status }}</td>
                                            <td>{{ $offer->offer }} Installment(s)</td>
                                            <td>{{ $offer->tenure }}</td>
                                            <td>{{ $offer->interest_rate }}</td>
                                            <td>{{ $offer->deposit_formulae }}</td>
                                            <td>{{ $offer->installment_formulae }}</td>
                                            <td>{{ $offer->category_id }}</td>
                                            <td>{{ $offer->product_id }}</td>
                                            <td>{{ date('Y-m-d H:i:s', $offer->date_time_added) }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm ml-2"
                                                    data-toggle="modal" data-target="#details{{ $offer->offer_id }}"><i
                                                        class="zmdi zmdi-eye"></i>Details</button>
                                                <button type="button" class="btn btn-warning btn-sm ml-2"
                                                    data-toggle="modal" data-target="#edit{{ $offer->offer_id }}"><i
                                                        class="zmdi zmdi-edit"></i>Edit</button>
                                            </td>
                                            {{-- Modals --}}
                                            @include('content.includes.offers.offer_details')
                                            @include('content.includes.offers.edit_offer')
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="9" class="text-center">No data available in table</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
