<div class="modal fade" id="edit{{ $user->user_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    Edit {{ $user->user_id }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                    action="{{ route('edit.user') }}">
                    @csrf
                    @if ($errors->any())
                        <p class="alert alert-danger">{{ $errors->first() }}
                        </p>
                    @endif
                    @if (Session::has('success'))
                        <p class="alert alert-success">
                            {{ Session::get('success') }}</p>
                    @endif
                    <div class="row p-4">
                        <input type="hidden" value="{{ $user->user_id }}" name="user_id">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="user_first_name"
                                    aria-describedby="plateHelp" value="{{ $user->user_first_name }}" required
                                    placeholder="Enter User Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" name="user_middle_name"
                                    aria-describedby="plateHelp" value="{{ $user->user_middle_name }}" required
                                    placeholder="Enter User Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="user_last_name"
                                    aria-describedby="plateHelp" value="{{ $user->user_last_name }}" required
                                    placeholder="Enter User Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" value="{{ $user->user_name }}"
                                    name="user_name" aria-describedby="plateHelp" required
                                    placeholder="Enter User Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>User Email</label>
                                <input type="text" class="form-control" value="{{ $user->user_email }}"
                                    name="user_email" aria-describedby="plateHelp" required
                                    placeholder="Enter User Email">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>User Phone Number</label>
                                <input type="number" class="form-control" name="user_msisdn"
                                    value="{{ $user->user_msisdn }}" aria-describedby="plateHelp" required
                                    placeholder="Enter User Phone Number">
                            </div>
                        </div>
                        {{-- <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>User Role</label>
                                <select name="role_id" class="form-control" id="role_id" multiple>
                                    @if (isset($user->user_roles))
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->role_id }}" {!! in_array($role->role_id, $user->user_roles) ? 'selected' : '' !!}>
                                                {{ $role->role_name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->role_id }}">
                                                {{ $role->role_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div> --}}

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>User Status</label>
                                <select name="user_status" value="{{ $user->user_status }}" class="form-control"
                                    id="user_status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="text-left"><strong>Record
                                    Version</strong>
                            </label>
                            <input type="text" class="form-control" value="{{ $user->record_version }}"
                                name="record_version" aria-describedby="plateHelp" required
                                value="{{ $user->record_version }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit
                        Edit</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
