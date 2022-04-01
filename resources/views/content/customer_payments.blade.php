@extends('frame')
@section('title')
    Customers Payments
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
                                    <th>Mpesa Ref</th>
                                    <th>Other Ref</th>
                                    <th>Payment Status</th>
                                    <th>Customer Lead</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->mpesa_ref }}</td>
                                            <td>{{ $customer->other_ref }}</td>
                                            <td>{{ $customer->payment_status }}</td>
                                            <td>{{ $customer->customer_lead_id }}</td>
                                            <td>{{ number_format($customer->amount) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($customer->date_time_added)->format('d/m/y h:i a') }}
                                            </td>
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
