<div class="modal fade" id="reset_password{{ $user->user_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    Reset Password For {{ $user->user_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                    action="{{ route('reset.user.password') }}">
                    @csrf
                    @if ($errors->any())
                        <p class="alert alert-danger">{{ $errors->first() }}
                        </p>
                    @endif
                    @if (Session::has('success'))
                        <p class="alert alert-success">
                            {{ Session::get('success') }}</p>
                    @endif
                    <div class="row pb-4">
                        <input type="hidden" value="{{ $user->user_id }}" name="user_id">
                        <input type="hidden" value="{{ $user->user_name }}" name="user_name">

                        <div class="col-sm-12">
                            <label><strong>User's Email</strong></label>
                            <input type="email" class="form-control" name="user_email" aria-describedby="plateHelp"
                                required value="{{ $user->user_email }}">
                        </div>
                        <div class="col-sm-12">
                            <label><strong>User's Phone Number</strong></label>
                            <input type="number" class="form-control" name="user_msisdn" aria-describedby="plateHelp"
                                required value="{{ $user->user_msisdn }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-fill pull-right">Send
                        Request</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
