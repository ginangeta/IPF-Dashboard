@extends('frame')
@section('title')
    Customers
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body table-full-width table-responsive">
                            <table class="table-hover table-striped table" id="data-table">
                                <thead>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->product_id }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_status }}</td>
                                            <td>{{ \Carbon\Carbon::parse($product->date_time_added)->format('D jS M y h:i a') }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal"
                                                    data-target="#details{{ $product->product_id }}"><i
                                                        class="zmdi zmdi-eye"></i>Details</button>
                                                <button type="button" class="btn btn-warning btn-sm ml-2" data-toggle="modal"
                                                    data-target="#edit-details{{ $product->product_id }}"><i
                                                        class="zmdi zmdi-edit"></i>Edit</button>
                                            </td>
                                            {{-- Modals --}}
                                            <div class="modal fade" id="details{{ $product->product_id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-capitalize"
                                                                id="exampleModalLongTitle">
                                                                {{ $product->product_name }} Details</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6><strong>Product Status</strong></h6>
                                                            <p>{{ $product->product_status }}</p>
                                                            <hr>

                                                            <h6><strong>Product Category</strong></h6>
                                                            <p>{{ $product->category_id }}</p>
                                                            <hr>

                                                            <h6><strong>Date Added</strong></h6>
                                                            <p class="mb-0">{{ $product->modified_by }}</p>
                                                            <small class="mb-0">
                                                                {{ \Carbon\Carbon::parse($product->date_time_added)->format('D jS M y h:i a') }}
                                                            </small>
                                                            <hr>

                                                            <h6><strong>Last Modified</strong></h6>
                                                            <p class="mb-0">{{ $product->modified_by }}</p>
                                                            <small class="mb-0">
                                                                {{ \Carbon\Carbon::parse($product->date_time_added)->format('D jS M y h:i a') }}
                                                            </small>
                                                            <hr>

                                                            <h6 class="text-left"><strong>Record Version</strong>
                                                            </h6>
                                                            <p>{{ $product->record_version }}</p>
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
