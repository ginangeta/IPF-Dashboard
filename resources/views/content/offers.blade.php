@extends('frame')
@section('title')
    Offers
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
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
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->category_id }}">
                                                            {{ $category->category }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Product</label>
                                                <select name="category_id" class="form-control" id="product_id">
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->product_id }}">
                                                            {{ $product->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                                                <input type="number" class="form-control" name="tenure"
                                                    aria-describedby="plateHelp" required placeholder="Enter Tenure">
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
                    <div class="card-body">
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
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($offers as $offer)
                                        <tr>
                                            <td>{{ $offer->offer_id }}</td>
                                            <td>{{ $offer->offer_status }}</td>
                                            <td>{{ $offer->offer }}</td>
                                            <td>{{ $offer->tenure }}</td>
                                            <td>{{ $offer->interest_rate }}</td>
                                            <td>{{ $offer->deposit_formulae }}</td>
                                            <td>{{ $offer->installment_formulae }}</td>
                                            <td>{{ \Carbon\Carbon::parse($offer->date_time_added)->format('D jS M y h:i a') }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal"
                                                    data-target="#details{{ $offer->offer_id }}"><i
                                                        class="zmdi zmdi-eye"></i>Details</button>
                                                <button type="button" class="btn btn-warning btn-sm ml-2"
                                                    data-toggle="modal"
                                                    data-target="#edit-details{{ $offer->offer_id }}"><i
                                                        class="zmdi zmdi-edit"></i>Edit</button>
                                            </td>
                                            {{-- Modals --}}
                                            <div class="modal fade" id="details{{ $offer->offer_id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-capitalize"
                                                                id="exampleModalLongTitle">
                                                                {{ $offer->offer_id }} Details</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6><strong>Offer Status</strong></h6>
                                                            <p>{{ $offer->offer_status }}</p>
                                                            <hr>

                                                            <h6><strong>Offer Category</strong></h6>
                                                            <p>{{ $offer->category_id }}</p>
                                                            <hr>

                                                            <h6><strong>Offer Product</strong></h6>
                                                            <p>{{ $offer->product_id }}</p>
                                                            <hr>

                                                            <h6><strong>Offer</strong></h6>
                                                            <p>{{ $offer->offer }}</p>
                                                            <hr>

                                                            <h6><strong>Offer Interest Rate</strong></h6>
                                                            <p>{{ $offer->interest_rate }}</p>
                                                            <hr>

                                                            <h6><strong>Offer Deposit Formulae</strong></h6>
                                                            <p>{{ $offer->deposit_formulae }}</p>
                                                            <hr>

                                                            <h6><strong>Offer Installment Formulae</strong></h6>
                                                            <p>{{ $offer->installment_formulae }}</p>
                                                            <hr>

                                                            <h6><strong>Date Added</strong></h6>
                                                            <p class="mb-0">{{ $offer->modified_by }}</p>
                                                            <small class="mb-0">
                                                                {{ \Carbon\Carbon::parse($offer->date_time_added)->format('D jS M y h:i a') }}
                                                            </small>
                                                            <hr>

                                                            <h6><strong>Last Modified</strong></h6>
                                                            <p class="mb-0">{{ $offer->modified_by }}</p>
                                                            <small class="mb-0">
                                                                {{ \Carbon\Carbon::parse($offer->date_time_added)->format('D jS M y h:i a') }}
                                                            </small>
                                                            <hr>

                                                            <h6 class="text-left"><strong>Record Version</strong>
                                                            </h6>
                                                            <p>{{ $offer->record_version }}</p>
                                                            <hr>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success btn-secondary"
                                                                data-dismiss="modal">OK</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
