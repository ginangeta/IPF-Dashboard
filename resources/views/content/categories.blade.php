@extends('frame')
@section('title')
    Product Underwriter
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
                                    Create Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                                    action="{{ url('categories') }}">
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
                                                <label>Category Brief</label>
                                                <input type="text" class="form-control" name="brief"
                                                    aria-describedby="plateHelp" required
                                                    placeholder="Enter Brief eg Motor Insurance">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" name="category_name"
                                                    aria-describedby="plateHelp" required placeholder="Enter Category Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Category Status</label>
                                                <select name="category_status" class="form-control" id="category_status">
                                                    <option value="ACTIVE">Active</option>
                                                    <option value="INACTIVE">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit
                                        Category</button>
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
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Brief</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @if ($categories)
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->category_id }}</td>
                                                <td>{{ $category->category }}</td>
                                                <td>{{ $category->brief }}</td>
                                                <td>{{ $category->category_status }}</td>
                                                <td>{{ date('Y-m-d H:i:s', $category->date_time_added) }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm ml-2"
                                                        data-toggle="modal"
                                                        data-target="#details{{ $category->category_id }}"><i
                                                            class="zmdi zmdi-eye"></i>Details</button>
                                                    <button type="button" class="btn btn-warning btn-sm ml-2"
                                                        data-toggle="modal"
                                                        data-target="#edit{{ $category->category_id }}"><i
                                                            class="zmdi zmdi-edit"></i>Edit</button>
                                                </td>
                                                {{-- Modals --}}
                                                @include('content.includes.categories.categories_details')
                                                @include('content.includes.categories.edit_categories')
                                                {{-- Modals --}}
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="6" class="text-center">No data available in table</td>
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
