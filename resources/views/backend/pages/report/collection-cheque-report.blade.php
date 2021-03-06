@extends('backend.layouts.master')
@section('title')
    Amount Collect List
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b class="text-danger">{{ $banks->bank_name }} </b></h1>
            <a href="{{ route('clients.created', $banks->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Collection Amount </a>
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                <a href="{{ url('admin/clients-payments-export-csv') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>
                <a href="{{ url('admin/clients-payments-export-excel') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{ url('admin/pdf-clients-payments') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $banks->client_name }} </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th> Sl </th>
                            <th> Client Name </th>
                            <th> Date </th>
                            <th> Amount </th>
                            <th> Payment Method </th>
                            <th> Note </th>
                            <th> Check Image </th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th colspan="3"> Total </th>
                            <th colspan="4"> <strong class="text-danger"> {{ number_format($banks->clientPayments->sum('amount'), 2) }} </strong></th>
                            <th width="15%"> Action </th>
                        </tr>
                        </tfoot>

                        <tbody>
                        @foreach($banks->clientPayments as $clientPayment)
                            <tr>
                                <td>{{ $clientPayment->id  }}</td>
                                <td>{{ $banks->bank_name  }}</td>
                                <td>{{ $clientPayment->date  }}</td>
                                <td>{{ number_format($clientPayment->amount, 2)  }}</td>
                                <td> @if( $clientPayment->payment_method == 'check') Cheque @elseif($clientPayment->payment_method == 'open') Opening Balance @else Cash @endif</td>
                                <td>{{ $clientPayment->note  }}</td>
                                <td><img src="{{ asset($clientPayment->check_file) }}" width="40px" height="40px" /> </td>

                                <td>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
