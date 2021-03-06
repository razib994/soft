@extends('backend.layouts.master')
@section('title')
    Amount Collect List
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b class="text-danger">{{ $client->client_name }} </b></h1>
            <a href="{{ route('clients.created', $client->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Collection Amount </a>
            <form action="{{route('clients.payments', $client->id)}}"  method="get">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="date" class="form-control" required name="start_date" id="start_date" placeholder="Start Date">
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" required name="end_date" id="end_date" placeholder="End Date">

                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Report</button>
                    </div>
                </div>
            </form>
        </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 mb-2 text-right">
            <a href="{{ route('clients.payments', $client->id)}}" class="btn btn-warning btn-sm "><i class="fas fa-backward " aria-hidden="true"></i> Back </a>

            {{--            <a href="{{ url('admin/clients-payments-export-csv') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
            <a href="{{ url('admin/clients-payments-export-excel') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
            <a href="{{ url('admin/pdf-clients-payments', [$client->id, $start_date, $end_date]) }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
        </div>
    </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Amount Collect - {{ $client->client_name }}  {{ $start_date }} </h6>
            </div>
            @php
                $today =  date("Y-m-d");
$fi_to=0; $to='';
            @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th> Sl </th>
                            <th> Client Name </th>
                            <th> Date </th>
                            <th style="text-align: right !important;"> Amount </th>
                            <th> Payment Method </th>
                            <th> Note </th>
                            <th> Check Image </th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>


                        <tbody>
{{--                        @foreach($client->clientPayments as $clientPayment)--}}
                        @foreach($client_payments as $clientPayment)
                        <tr>
                            <td>{{ $clientPayment->id  }}</td>
                            <td>{{ $client->client_name  }}</td>
                            <td>{{ $clientPayment->date  }}</td>
                            <td style="text-align: right !important;">

                                    {{ number_format( $to = $clientPayment->amount, 2)  }}

                                @php
                                    $fi_to = $fi_to + $to;
                                    @endphp
                            </td>
                            <td> @if( $clientPayment->payment_method == 'check') Cheque @elseif($clientPayment->payment_method == 'open') Opening Balance @elseif($clientPayment->payment_method == 'refund') Refund @else Cash @endif</td>
                            <td>{{ $clientPayment->note  }}</td>
                            <td><img src="{{ asset($clientPayment->check_file) }}" width="40px" height="40px" /> </td>

                            <td>
                                <form action="{{route('clients.payments.destroy', ['id' => $client->id, 'clients_id' => $clientPayment->id])}}" method="POST">
                                    <a href="{{route('clients.payments.edit', ['id' => $client->id, 'cliented_id' => $clientPayment->id]) }}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Client Payments!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3"> Total </th>
                            <th colspan="4" style="text-align: right !important;"> <strong class="text-danger">

                                    {{ number_format($fi_to,2)  }}
                                </strong></th>
                            <th width="15%"> Action </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
