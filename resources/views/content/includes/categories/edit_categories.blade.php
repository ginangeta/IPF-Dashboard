<div class="modal fade" id="edit{{ $category->category_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    Edit {{ $category->category }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                    action="{{ route('edit.category', $category->category_id) }}">
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
                        <input type="hidden" value="{{ $category->category_id }}" name="category_id">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Category Brief</label>
                                <input type="text" class="form-control" value="{{ $category->brief }}" name="brief"
                                    aria-describedby="plateHelp" required placeholder="Enter Brief eg Motor Insurance">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="category"
                                    value="{{ $category->category }}" aria-describedby="plateHelp" required
                                    placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Category Status</label>
                                <select name="category_status" class="form-control" id="category_status">
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
                                value="{{ $category->record_version }}" aria-describedby="plateHelp" required
                                $value="{{ $category->record_version }}">
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
