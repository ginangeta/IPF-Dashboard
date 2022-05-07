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
                                    {{-- <th>Customer</th> --}}
                                    <th>Mpesa Ref</th>
                                    <th>Other Ref</th>
                                    <th>Payment Status</th>
                                    <th>Customer Lead</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                </thead>
                                <tbody>
                                    @if ($customers)
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->mpesa_ref }}</td>
                                                <td>{{ $customer->other_ref }}</td>
                                                <td>{{ $customer->payment_status }}</td>
                                                <td>{{ $customer->customer_lead_id }}</td>
                                                <td>{{ number_format($customer->amount) }}</td>
                                                <td>{{ date('Y-m-d H:i:s', $customer->date_time_added) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="8" class="text-center">No data available in table</td>
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
