@extends('frame')
@section('title')
    Organizations
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-end mb-2">
                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal"
                    data-target="#create_organisation"><i class="zmdi zmdi-edit"></i>Create</button>

                <div class="modal fade" id="create_organisation" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
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
                                    action="{{ url('organisations') }}">
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
                                                <label>Country</label>
                                                <select name="country_id" class="form-control" id="country_id">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->country_id }}">
                                                            {{ $country->country }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Organization Name</label>
                                                <input type="text" class="form-control" name="organisation_name"
                                                    aria-describedby="plateHelp" required
                                                    placeholder="Enter Organization Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Organization Code</label>
                                                <input type="text" class="form-control" name="organisation_code"
                                                    aria-describedby="plateHelp" required
                                                    placeholder="Enter Organisation Code">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Organisation Email</label>
                                                <input type="number" class="form-control" name="organisation_email"
                                                    aria-describedby="plateHelp" required placeholder="Enter Organisation Email">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Organisation Phone</label>
                                                <input type="text" class="form-control" name="organisation_msisdn"
                                                    aria-describedby="plateHelp" required placeholder="Enter Organisation Phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Organisation Contact</label>
                                                <input type="number" class="form-control" name="organisation_contact"
                                                    aria-describedby="plateHelp" required placeholder="Enter Organisation Contant">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Organisation Status</label>
                                                <select name="organisation_status" class="form-control"
                                                    id="organisation_status">
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
                                <th>Name</th>
                                <th>Type</th>
                                <th>Code</th>
                                <th>Organisation Email</th>
                                <th>Organisation Phone</th>
                                <th>Organisation Contact</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($organisations as $organisation)
                                    <tr>
                                        <td>{{ $organisation->organisation_id }}</td>
                                        <td>{{ $organisation->organisation_name }}</td>
                                        <td>{{ $organisation->organisation_type }}</td>
                                        <td>{{ $organisation->organisation_code }}</td>
                                        <td>{{ $organisation->organisation_email }}</td>
                                        <td>{{ $organisation->organisation_msisdn }}</td>
                                        <td>{{ $organisation->organisation_contact }}</td>
                                        <td>{{ date('Y-m-d H:i:s', $organisation->date_time_added) }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal"
                                                data-target="#details{{ $organisation->organisation_id }}"><i
                                                    class="zmdi zmdi-eye"></i>Details</button>
                                            <button type="button" class="btn btn-warning btn-sm ml-2" data-toggle="modal"
                                                data-target="#edit{{ $organisation->organisation_id }}"><i
                                                    class="zmdi zmdi-edit"></i>Edit</button>
                                        </td>
                                        {{-- Modals --}}
                                        @include('content.includes.organisations.organisation_details')
                                        @include('content.includes.organisations.edit_organisation')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
