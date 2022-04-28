<div class="modal fade" id="edit{{ $organisation->organisation_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    Edit {{ $organisation->organisation_name }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                    action="{{ route('edit.organisation') }}">
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
                        <input type="hidden" $value="{{ $organisation->organisation_id }}" name="organisation_id">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Country</label>
                                <select name="country_id" class="form-control" id="country_id">
                                    @foreach ($countries as $country)
                                        <option $value="{{ $country->country_id }}" {!! $country->country_id == $organisation->country_id ? 'selected' : '' !!}>
                                            {{ $country->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Organization Name</label>
                                <input type="text" class="form-control" name="organisation_name"
                                    value="{{ $organisation->organisation_name }}" aria-describedby="plateHelp"
                                    required placeholder="Enter Organization Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Organization Code</label>
                                <input type="text" class="form-control" name="organisation_code"
                                    value="{{ $organisation->organisation_code }}" aria-describedby="plateHelp"
                                    required placeholder="Enter Organisation Code">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Organisation Email</label>
                                <input type="text" class="form-control" name="organisation_email"
                                    value="{{ $organisation->organisation_email }}" aria-describedby="plateHelp"
                                    required placeholder="Enter Organisation Email">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Organisation Phone</label>
                                <input type="text" class="form-control" name="organisation_msisdn"
                                    value="{{ $organisation->organisation_msisdn }}" aria-describedby="plateHelp"
                                    required placeholder="Enter Organisation Phone">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Organisation Contact</label>
                                <input type="text" class="form-control" name="organisation_contact"
                                    value="{{ $organisation->organisation_contact }}" aria-describedby="plateHelp"
                                    required placeholder="Enter Organisation Contant">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Organisation Status</label>
                                <select name="organisation_status" value="{{ $organisation->organisation_status }}"
                                    class="form-control" id="organisation_status">
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
                                value="{{ $organisation->record_version }}" aria-describedby="plateHelp" required
                                $value="{{ $organisation->record_version }}">
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
