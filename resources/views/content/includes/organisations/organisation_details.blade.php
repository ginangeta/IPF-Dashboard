<div class="modal fade" id="details{{ $organisation->organisation_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    {{ $organisation->organisation_name }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><strong>Organization Status</strong></h6>
                <p>{{ $organisation->organisation_status }}</p>
                <hr>

                <h6><strong>Organization Country</strong></h6>
                <p>{{ $organisation->country_id }}</p>
                <hr>

                <h6><strong>Organization</strong></h6>
                <p>{{ $organisation->organisation_name }}</p>
                <hr>

                <h6><strong>Organization Type</strong></h6>
                <p>{{ $organisation->organisation_type }}</p>
                <hr>

                <h6><strong>Organization Code</strong></h6>
                <p>{{ $organisation->organisation_code }}</p>
                <hr>

                <h6><strong>Organization Email</strong></h6>
                <p>{{ $organisation->organisation_email }}</p>
                <hr>

                <h6><strong>Organization Contact</strong></h6>
                <p>{{ $organisation->organisation_contact }}</p>
                <hr>

                <h6><strong>Date Added</strong></h6>
                <p class="mb-0">{{ $organisation->modified_by }}</p>
                <small class="mb-0">
                    {{ date('Y-m-d H:i:s', $organisation->date_time_added) }}
                </small>
                <hr>

                <h6><strong>Last Modified</strong></h6>
                <p class="mb-0">{{ $organisation->modified_by }}</p>
                <small class="mb-0">
                    {{ date('Y-m-d H:i:s', $organisation->date_time_modified) }}
                </small>
                <hr>

                <h6 class="text-left"><strong>Record Version</strong>
                </h6>
                <p>{{ $organisation->record_version }}</p>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
