<div class="modal fade" id="details{{ $customer->customer_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    {{ $customer->first_name }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><strong>Customer Status</strong></h6>
                <p>{{ $customer->customer_status }}</p>
                <hr>

                <h6><strong>First Name</strong></h6>
                <p>{{ $customer->first_name }}</p>
                <hr>

                <h6><strong>Last Name</strong></h6>
                <p>{{ $customer->last_name }}</p>
                <hr>

                <h6><strong>Customer Id</strong></h6>
                <p>{{ $customer->id_number }}</p>
                <hr>

                <h6><strong>Customer Pin</strong></h6>
                <p>{{ $customer->pin_number }}</p>
                <hr>

                <h6><strong>Customer Email</strong></h6>
                <p>{{ $customer->email_address }}</p>
                <hr>

                <h6><strong>Customer Phone</strong></h6>
                <p>{{ $customer->msisdn }}</p>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
