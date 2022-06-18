<div class="modal fade" id="edit{{ $product->product_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    Edit {{ $product->product_name }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                    action="{{ route('edit.product', $product->product_id) }}">
                    @csrf
                    @if ($errors->any())
                        <p class="alert alert-danger">{{ $errors->first() }}</p>
                    @endif
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    <div class="row p-4">
                        <input type="hidden" value="{{ $product->product_id }}" name="product_id">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Product Category</label>
                                <select name="category_id" class="form-control" id="category_id">
                                    @if ($categories)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}" {!! $category->category_id == $product->category_id ? 'selected' : '' !!}>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Product</label>
                                <input type="text" class="form-control" name="product_name"
                                    value="{{ @$product->product_name }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Product Status</label>
                                <select name="product_status" value="{{ @$product->product_status }}"
                                    class="form-control" id="product_status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <label class="text-left"><strong>Record
                                    Version</strong>
                            </label>
                            <input type="text" class="form-control" name="record_version"
                                value="{{ @$product->record_version }}" aria-describedby="plateHelp" required
                                $value="{{ @$product->record_version }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit
                        Product</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
