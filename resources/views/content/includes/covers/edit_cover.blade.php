<div class="modal fade" id="edit{{ $customer->customer_cover_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    Edit {{ $customer->car_reg_number }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                    action="{{ route('edit.cover', $customer->customer_cover_id) }}">
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
                        <input type="hidden" $value="{{ $customer->customer_cover_id }}" name="customer_cover_id">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Registration</label>
                                <input type="text" class="form-control" name="car_reg_number"
                                    value="{{ $customer->car_reg_number }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer Car Registration">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Premium</label>
                                <input type="number" class="form-control" name="premium"
                                    value="{{ $customer->premium }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer Premium">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Deposit</label>
                                <input type="number" class="form-control" name="deposit"
                                    value="{{ $customer->deposit }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer ID">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Installment</label>
                                <input type="number" class="form-control" name="installment"
                                    value="{{ $customer->installment }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Customer Installment">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Loan</label>
                                <input type="number" class="form-control" name="loan" value="{{ $customer->loan }}"
                                    aria-describedby="plateHelp" required placeholder="Enter Customer Loan">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Interest Rate</label>
                                <input type="text" class="form-control" name="interest_rate"
                                    value="{{ $customer->interest_rate }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Interest Rate">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Customer Status</label>
                                <select name="customer_cover_status" value="{{ $customer->customer_cover_status }}"
                                    class="form-control" id="customer_cover_status">
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
