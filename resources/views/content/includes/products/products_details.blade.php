<div class="modal fade" id="details{{ $product->product_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    {{ $product->product_name }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><strong>Product Status</strong></h6>
                <p>{{ $product->product_status }}</p>
                <hr>

                <h6><strong>Product Category</strong></h6>
                <p>{{ $product->category_id }}</p>
                <hr>

                <h6><strong>Date Added</strong></h6>
                {{-- <p class="mb-0">{{ $product->modified_by }}</p> --}}
                <small class="mb-0">
                    {{ date('Y-m-d H:i:s', $product->date_time_added) }}
                </small>
                <hr>

                <h6><strong>Last Modified</strong></h6>
                {{-- <p class="mb-0">{{ $product->modified_by }}</p> --}}
                <small class="mb-0">
                    {{ date('Y-m-d H:i:s', $product->date_time_added) }}
                </small>
                <hr>

                <h6 class="text-left"><strong>Record Version</strong>
                </h6>
                <p>{{ $product->record_version }}</p>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
