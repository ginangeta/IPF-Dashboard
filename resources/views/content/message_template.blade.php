@extends('frame')
@section('title')
    Messages Templates
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal" data-target="#create_template"><i
                        class="zmdi zmdi-edit"></i>Create</button>

                <div class="modal fade" id="create_template" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                                    Create Template</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" class="form-horizontal" novalidate="" method="POST"
                                    action="{{ url('store_template') }}">
                                    @csrf
                                    @if ($errors->any())
                                        <p class="alert alert-danger">{{ $errors->first() }}</p>
                                    @endif
                                    @if (Session::has('success'))
                                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Template Name</label>
                                                <input type="text" class="form-control" name="template"
                                                    aria-describedby="plateHelp" required placeholder="Enter Template Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Template Place Holder</label>
                                                <input type="text" class="form-control" name="place_holders"
                                                    aria-describedby="plateHelp" required
                                                    placeholder="Enter Template Place holder">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Template Status</label>
                                                <select name="template_status" class="form-control" id="template_status">
                                                    <option value="ACTIVE">Active</option>
                                                    <option value="INACTIVE">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Template Content</label>
                                                <textarea rows="8" cols="50" name="contents" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Submit
                                        Application</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body table-full-width table-responsive">
                            <table class="table-hover table-striped table" id="data-table">
                                <thead>
                                    <th>Template Name</th>
                                    <th>Template Status</th>
                                    <th>Content</th>
                                    <th>Sent By</th>
                                    <th>Date Sent</th>
                                </thead>
                                <tbody>
                                    @foreach ($templates as $template)
                                        <tr>
                                            <td>
                                                {{ $template->template_name }}
                                            </td>
                                            <td>{{ $template->template_status }}</td>
                                            <td>
                                                <span style="max-width:150px; white-space: normal;">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#details{{ $template->template_id }}">
                                                        {{ strlen($template->template) > 50 ? substr($template->template, 0, 50) . '...' : $template->template }}
                                                    </a>
                                                </span>
                                            </td>
                                            <td>{{ $template->added_by }}</td>
                                            <td>{{ date("Y-m-d H:i:s",$template->date_time_added) }}
                                            </td>

                                            {{-- Modals --}}
                                            <div class="modal fade" id="details{{ $template->template_id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-capitalize"
                                                                id="exampleModalLongTitle">
                                                                {{ $template->template_name }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Template Content</label>
                                                                <textarea rows="14" cols="50" class="form-control">{{ $template->template }}
                                                            </textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success btn-secondary"
                                                                data-dismiss="modal">OK</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
