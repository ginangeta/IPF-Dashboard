@extends('frame')
@section('title')
    Products
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-end mb-2">
                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal" data-target="#create_product"><i
                        class="zmdi zmdi-edit"></i>Create</button>

                <div class="modal fade" id="create_product" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                                    Create Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                                    action="{{ url('products') }}">
                                    @csrf
                                    @if ($errors->any())
                                        <p class="alert alert-danger">{{ $errors->first() }}</p>
                                    @endif
                                    @if (Session::has('success'))
                                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                                    @endif
                                    <div class="row p-4">
                                        <div class="col-md-12 col-sm-12">
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
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Product</label>
                                                <input type="text" class="form-control" name="product_name"
                                                    aria-describedby="plateHelp" required placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Product Status</label>
                                                <select name="product_status" class="form-control" id="product_status">
                                                    <option value="ACTIVE">Active</option>
                                                    <option value="INACTIVE">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit
                                        Product</button>
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
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @if ($products)
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->product_id }}</td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->product_status }}</td>
                                                <td>{{ date('Y-m-d H:i:s', $product->date_time_added) }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm ml-2"
                                                        data-toggle="modal"
                                                        data-target="#details{{ $product->product_id }}"><i
                                                            class="zmdi zmdi-eye"></i>Details</button>
                                                    <button type="button" class="btn btn-warning btn-sm ml-2"
                                                        data-toggle="modal"
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
                                                                {{-- <p class="mb-0">{{ $product->modified_by }}</p> --}}
                                                                <small class="mb-0">
                                                                    {{ date('Y-m-d H:i:s', $product->date_time_added) }}
                                                                </small>
                                                                <hr>

                                                                <h6><strong>Last Modified</strong></h6>
                                                                {{-- <p class="mb-0">{{ $product->modified_by }}</p> --}}
                                                                <small class="mb-0">
                                                                    {{ date('Y-m-d H:i:s', $product->date_time_added) }}
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
                                    @else
                                        <td colspan="5" class="text-center">No data available in table</td>
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
