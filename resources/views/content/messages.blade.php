@extends('frame')
@section('title')
    Messages
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body table-full-width table-responsive">
                            <table class="table-hover table-striped table" id="data-table">
                                <thead>
                                    <th>Id</th>
                                    <th>Message Status</th>
                                    <th>Subject</th>
                                    <th>Sent To</th>
                                    <th>Content</th>
                                    <th>Sent By</th>
                                    <th>Date Sent</th>
                                </thead>
                                <tbody>
                                    @if ($messages)
                                        @foreach ($messages as $message)
                                            <tr>
                                                <td><a
                                                        href="@if ($message->template_id) {{ route('message.template', @$message->template_id) }} @endif">
                                                        {{ $message->message_id }}
                                                    </a>
                                                </td>
                                                <td>{{ $message->message_status }}</td>
                                                <td>{{ $message->subject }}</td>
                                                <td>{{ $message->recipient }}</td>
                                                <td>
                                                    <span style="max-width:150px; white-space: normal;">
                                                        {{ $message->message }}
                                                    </span>
                                                </td>
                                                <td>{{ $message->sender }}</td>
                                                <td>{{ date('Y-m-d H:i:s', $message->date_time_added) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="7" class="text-center">No data available in table</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
