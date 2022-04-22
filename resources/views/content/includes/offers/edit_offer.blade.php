<div class="modal fade" id="edit{{ $offer->offer_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    Edit {{ $offer->offer_id }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                    action="{{ route('edit.offer') }}">
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
                        <input type="hidden" value="{{ $offer->offer_id }}" name="offer_id">

                        <div class="col-sm-12 col-md-6">
                            <label><strong>Offer Status</strong></label>
                            <input type="text" class="form-control" name="offer_status" aria-describedby="plateHelp"
                                required value="{{ $offer->offer_status }}">
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label><strong>Offer Category</strong></label>
                            <select name="category_id" class="form-control" id="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}" {!! $category->category_id == $offer->category_id ? 'selected' : '' !!}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label><strong>Offer Product</strong></label>
                            <select name="product_id" class="form-control">
                                @foreach ($products as $product)
                                    <option value="{{ $product->product_id }}" {!! $product->product_id == $offer->product_id ? 'selected' : '' !!}>
                                        {{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label><strong>Offer</strong></label>
                            <input type="text" class="form-control" name="offer" aria-describedby="plateHelp" required
                                value="{{ $offer->offer }}">
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label><strong>Offer Interest Rate</strong></label>
                            <input type="text" class="form-control" name="interest_rate" aria-describedby="plateHelp"
                                required value="{{ $offer->interest_rate }}">
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label><strong>Offer Deposit Formulae</strong></label>
                            <input type="text" class="form-control" name="deposit_formulae"
                                aria-describedby="plateHelp" required value="{{ $offer->deposit_formulae }}">
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label><strong>Offer Installment
                                    Formulae</strong></label>
                            <input type="text" class="form-control" name="installment_formulae"
                                aria-describedby="plateHelp" required value="{{ $offer->installment_formulae }}">
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label class="text-left"><strong>Record
                                    Version</strong>
                            </label>
                            <input type="text" class="form-control" name="record_version" aria-describedby="plateHelp"
                                required value="{{ $offer->record_version }}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="text-left"><strong>
                                    Tenure</strong>
                            </label>
                            <input type="text" class="form-control" name="tenure" aria-describedby="plateHelp"
                                required value="{{ $offer->tenure }}">
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
