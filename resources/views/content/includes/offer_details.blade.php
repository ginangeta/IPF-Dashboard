<div class="modal fade" id="details{{ $offer->offer_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    {{ $offer->offer_id }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><strong>Offer Status</strong></h6>
                <p>{{ $offer->offer_status }}</p>
                <hr>

                <h6><strong>Offer Category</strong></h6>
                <p>{{ $offer->category_id }}</p>
                <hr>

                <h6><strong>Offer Product</strong></h6>
                <p>{{ $offer->product_id }}</p>
                <hr>

                <h6><strong>Offer</strong></h6>
                <p>{{ $offer->offer }}</p>
                <hr>

                <h6><strong>Offer Interest Rate</strong></h6>
                <p>{{ $offer->interest_rate }}</p>
                <hr>

                <h6><strong>Offer Deposit Formulae</strong></h6>
                <p>{{ $offer->deposit_formulae }}</p>
                <hr>

                <h6><strong>Offer Installment Formulae</strong></h6>
                <p>{{ $offer->installment_formulae }}</p>
                <hr>

                <h6><strong>Date Added</strong></h6>
                <p class="mb-0">{{ $offer->modified_by }}</p>
                <small class="mb-0">
                    {{ date("Y-m-d H:i:s",$offer->date_time_added) }}
                </small>
                <hr>

                <h6><strong>Last Modified</strong></h6>
                <p class="mb-0">{{ $offer->modified_by }}</p>
                <small class="mb-0">
                    {{ date("Y-m-d H:i:s",$offer->date_time_added) }}
                </small>
                <hr>

                <h6 class="text-left"><strong>Record Version</strong>
                </h6>
                <p>{{ $offer->record_version }}</p>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
