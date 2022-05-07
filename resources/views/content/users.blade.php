@extends('frame')
@section('title')
    Users
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-end mb-2">
                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal" data-target="#create_user"><i
                        class="zmdi zmdi-edit"></i>Create</button>

                <div class="modal fade" id="create_user" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                                    Create User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                                    action="{{ url('users') }}">
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
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="user_first_name"
                                                    aria-describedby="plateHelp" required placeholder="Enter User Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control" name="user_middle_name"
                                                    aria-describedby="plateHelp" required placeholder="Enter User Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="user_last_name"
                                                    aria-describedby="plateHelp" required placeholder="Enter User Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input type="text" class="form-control" name="user_name"
                                                    aria-describedby="plateHelp" required placeholder="Enter User Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>User Email</label>
                                                <input type="text" class="form-control" name="user_email"
                                                    aria-describedby="plateHelp" required placeholder="Enter User Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>User Phone Number</label>
                                                <input type="number" class="form-control" name="user_msisdn"
                                                    aria-describedby="plateHelp" required
                                                    placeholder="Enter User Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>User Role</label>
                                                <select name="role_id" class="form-control" id="role_id">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->role_id }}">
                                                            {{ $role->role_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="new_password"
                                                    aria-describedby="plateHelp" required placeholder="Enter Password">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>User Status</label>
                                                <select name="user_status" class="form-control" id="user_status">
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
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>User Type</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @if ($users)
                                    @foreach ($users as $user)
                                        {{-- @dd($user->user_roles) --}}
                                        <tr>
                                            <td>{{ $user->user_first_name . ' ' . $user->user_middle_name . ' ' . $user->user_last_name }}
                                            </td>
                                            <td>{{ $user->user_name }}</td>
                                            <td>{{ $user->user_email }}</td>
                                            <td>{{ $user->user_msisdn }}</td>
                                            <td>{{ $user->user_type }}</td>
                                            <td>{{ date('Y-m-d H:i a', $user->date_time_added) }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal"
                                                    data-target="#details{{ $user->user_id }}"><i
                                                        class="zmdi zmdi-eye"></i>Details</button>
                                                <button type="button" class="btn btn-warning btn-sm ml-2"
                                                    data-toggle="modal" data-target="#edit{{ $user->user_id }}"><i
                                                        class="zmdi zmdi-edit"></i>Edit</button>
                                                <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal"
                                                    data-target="#reset_password{{ $user->user_id }}"><i
                                                        class="zmdi zmdi-edit"></i>Reset Password</button>
                                            </td>
                                            {{-- Modals --}}
                                            @include(
                                                'content.includes.users.user_details'
                                            )
                                            @include(
                                                'content.includes.users.edit_password'
                                            )
                                            @include(
                                                'content.includes.users.edit_user'
                                            )
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="7" class="text-center">No data available in table</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
