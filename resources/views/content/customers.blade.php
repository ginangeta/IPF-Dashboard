@extends('frame')
@section('title')
    Customers
@endsection
@section('content')
    <style>
        input[type=checkbox] {
            /* Double-sized Checkboxes */
            -ms-transform: scale(2);
            /* IE */
            -moz-transform: scale(2);
            /* FF */
            -webkit-transform: scale(2);
            /* Safari and Chrome */
            -o-transform: scale(2);
            /* Opera */
            transform: scale(2);
            padding: 10px;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-sm btn-info" id="send_message">Message</button>

                            <div class="modal fade" id="message_modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-capitalize" id="exampleModalLongTitle">
                                                Create Message</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Message Channel</label>
                                                        <select name="channel_id" class="form-control" id="channel_id">
                                                            @foreach ($channels as $channel)
                                                                <option value="{{ $channel->channel_id }}">
                                                                    {{ $channel->channel_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Message Template</label>
                                                        <select name="template_id" class="form-control" id="template_id">
                                                            @foreach ($templates as $template)
                                                                <option value="{{ $template->template_id }}">
                                                                    {{ $template->template_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Message Place Holder</label>
                                                        <input type="text" class="form-control" name="place_holders"
                                                            aria-describedby="plateHelp" required
                                                            placeholder="Enter  Place holder">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Message Status</label>
                                                        <select name="message_status" class="form-control"
                                                            id="message_status">
                                                            <option value="NEW">New</option>
                                                            <option value="OLD">Old</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" id="btn_send_message"
                                                class="btn btn-info btn-fill pull-right">
                                                <i class="fa fa-spinner fa-spin d-none"></i>
                                                Send Message</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-full-width table-responsive">
                            <table class="table-hover table-striped table" id="data-table">
                                <thead>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Customer Status</th>
                                    <th>Customer Phone</th>
                                    <th>Id Number</th>
                                    <th>Email</th>
                                    <th>Pin</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                </thead>
                                <tbody>
                                    <form method="POST" id="sendMessageForm" action="{{ url('sendMessage') }}">
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" value="{{ $customer->msisdn }}"
                                                        class="form-control customers-checkbox" name="contacts">
                                                </td>
                                                <td><a href="{{ route('lead.quotation.view', $customer->customer_id) }}">
                                                        {{ $customer->first_name . ' ' . $customer->last_name }}
                                                    </a>
                                                </td>
                                                <td>{{ $customer->customer_status }}</td>
                                                <td>{{ $customer->msisdn }}</td>
                                                <td>{{ $customer->id_number }}</td>
                                                <td>{{ $customer->email_address }}</td>
                                                <td>{{ $customer->pin_number }}</td>
                                                <td>{{ $customer->registered_by_msisdn }}</td>
                                                <td>{{ \Carbon\Carbon::parse($customer->date_time_added)->format('d/m/y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            var $contacts = [];

            $('#send_message').on('click', function() {
                // console.log('Here');

                $contacts = [];
                var $boxes = $('input[name=contacts]:checked');

                $boxes.each(function() {
                    $contacts.push($(this).val());
                });

                if ($contacts.length > 0) {
                    $('#message_modal').modal('show');
                } else {
                    toastr.error('Kindly select customers to send message to.');
                }
            });


            $('#btn_send_message').on('click', function() {

                $(this).find('fa-spin').removeClass('d-none');
                var message_status = $('select[name=message_status]').val();
                var place_holders = $('input[name=place_holders]').val();
                var template_id = $('select[name=template_id]').val();
                var channel_id = $('select[name=channel_id]').val();
                var msisdn = $contacts;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                    }
                });

                $.post("{{ url('send_message') }}", {
                    message_status: message_status,
                    msisdn: msisdn,
                    place_holders: place_holders,
                    template_id: template_id,
                    channel_id: channel_id
                }).done(function(data) {
                    console.log("ResponseText:" + data);
                }).fail(function() {
                    toastr.error('An error occured. Kindly try again later.');
                });

                $(this).find('fa-spin').addClass('d-none');
                $('#message_modal').modal('hide');
            });
        });
    </script>
@endsection
