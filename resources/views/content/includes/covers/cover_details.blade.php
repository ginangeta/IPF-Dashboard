<div class="modal fade" id="details{{ $customer->customer_cover_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    {{ $customer->car_reg_number }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h6><strong>Customer Status</strong></h6>
                        <p>{{ $customer->customer_cover_status }}</p>
                        <hr>

                        <h6><strong>Premium</strong></h6>
                        <p>{{ number_format($customer->premium) }}</p>
                        <hr>

                        <h6><strong>Deposit</strong></h6>
                        <p>{{ number_format($customer->deposit) }}</p>
                        <hr>

                        <h6><strong>Installment</strong></h6>
                        <p>{{ number_format($customer->installment) }}</p>
                        <hr>

                        <h6><strong>Loan</strong></h6>
                        <p>{{ number_format($customer->loan) }}</p>
                        <hr>

                        <h6><strong>Interest Rate</strong></h6>
                        <p>{{ number_format($customer->interest_rate) }}</p>
                        <hr>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <h6><strong>Start Date</strong></h6>
                        <small class="mb-0">
                            {{ date('Y-m-d H:i:s', substr($customer->start_date, 0, -3)) }}
                        </small>
                        <hr>

                        <h6><strong>End Date</strong></h6>
                        <small class="mb-0">
                            {{ date('Y-m-d H:i:s', substr($customer->end_date, 0, -3)) }}
                        </small>
                        <hr>

                        <h6><strong>Date Added</strong></h6>
                        <p class="mb-0">{{ $customer->modified_by }}</p>
                        <small class="mb-0">
                            {{ date('Y-m-d H:i:s', $customer->date_time_added) }}
                        </small>
                        <hr>

                        <h6><strong>Last Modified</strong></h6>
                        <p class="mb-0">{{ $customer->modified_by }}</p>
                        <small class="mb-0">
                            {{ date('Y-m-d H:i:s', $customer->date_time_modified) }}
                        </small>
                        <hr>

                        <h6 class="text-left"><strong>Record Version</strong>
                        </h6>
                        <p>{{ $customer->record_version }}</p>
                        <hr>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>
