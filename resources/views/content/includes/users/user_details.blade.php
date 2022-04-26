<div class="modal fade" id="details{{ $user->user_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    {{ $user->user_name }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><strong>User Status</strong></h6>
                <p>{{ $user->user_status }}</p>
                <hr>

                <h6><strong>User's Full Name</strong></h6>
                <p>
                    {{ $user->user_first_name . ' ' . $user->user_middle_name . ' ' . $user->user_last_name }}
                </p>
                <hr>

                <h6><strong>User Email</strong></h6>
                <a href="mailto:{{ $user->user_email }}">{{ $user->user_email }}</a>
                <hr>

                <h6><strong>User</strong></h6>
                <a href="tel:{{ $user->user_msisdn }}">{{ $user->user_msisdn }}</a>
                <hr>

                <h6><strong>User Type</strong></h6>
                <p>{{ $user->user_type }}</p>
                <hr>

                <h6><strong>User Type</strong></h6>
                <p>{{ $user->user_type }}</p>
                <hr>

                <h6><strong>User Organisation</strong></h6>
                <p>{{ $user->organisation_type }}</p>
                <hr>

                <h6><strong>Date Added</strong></h6>
                <p class="mb-0">{{ $user->modified_by }}</p>
                <small class="mb-0">
                    {{ date('Y-m-d H:i a', $user->date_time_added) }}
                </small>
                <hr>

                <h6><strong>User Roles</strong></h6>
                @if (isset($user->user_roles))
                    @foreach ($user->user_roles as $role)
                        <small>{{ $role->role_name }}</small>
                    @endforeach
                @endif
                <hr>

                <h6 class="text-left"><strong>Record Version</strong>
                </h6>
                <p>{{ $user->record_version }}</p>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
