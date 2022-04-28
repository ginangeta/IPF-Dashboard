<div class="modal fade" id="edit{{ $customer->customer_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    Edit {{ $customer->first_name }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                    action="{{ route('edit.customer') }}">
                    @csrf
                    @if ($errors->any())
                        <p class="alert alert-danger">{{ $errors->first() }}
                        </p>
                    @endif
                    @if (Session::has('success'))
                        <p class="alert alert-success">
                            {{ Session::get('success') }}</p>
                    @endif
                    <div class="row">
                        <input type="hidden" $value="{{ $customer->customer_id }}" name="customer_id">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer First Name</label>
                                <input type="text" class="form-control" name="first_name"
                                    value="{{ $customer->first_name }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer First Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ $customer->last_name }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer Last Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer ID</label>
                                <input type="text" class="form-control" name="id_number"
                                    value="{{ $customer->id_number }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer ID">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Email</label>
                                <input type="text" class="form-control" name="email_address"
                                    value="{{ $customer->email_address }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer Email">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Phone</label>
                                <input type="text" class="form-control" name="msisdn"
                                    value="{{ $customer->msisdn }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer Phone">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Pin</label>
                                <input type="text" class="form-control" name="pin_number"
                                    value="{{ $customer->pin_number }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer Pin">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Status</label>
                                <select name="customer_status" value="{{ $customer->customer_status }}"
                                    class="form-control" id="customer_status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label class="text-left"><strong>Record
                                    Version</strong>
                            </label>
                            <input type="text" class="form-control" name="record_version"
                                value="{{ $customer->record_version }}" aria-describedby="plateHelp" required
                                $value="{{ $customer->record_version }}">
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
