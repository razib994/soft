@extends('backend.layouts.master')
@section('title')
    Amount Collect List
@endsection
@section('content')

    <div class="container-fluid">
    {{--        @if (Session::has('message'))--}}
    {{--            <div class="alert alert-success">--}}
    {{--                <div>--}}
    {{--                    <p>{{ Session::get('message') }}</p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--    @endif--}}
    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b class="text-danger">{{ $banks->bank_name }} </b> </h1>
            <a href="{{ route('projects.created', $banks->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Expenditure Amount </a>
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                <a href="{{url('admin/project-payments-export-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>
                <a href="{{url('admin/project-payments-export-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{url('admin/pdf-project-payments')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Projects - {{ $banks->bank_name }} </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Category Name </th>
                            <th> Item Name </th>
                            <th> Date </th>
                            <th>Amount</th>
                            <th> Payment Method </th>
                            <th> Note </th>
                            <th> Cheque Image </th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach($banks->projectPayments as $projectPayment)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $projectPayment->category->category_name }}</td>
                                <td> @php $items = \App\Item::where('id',$projectPayment->item_name )->get() @endphp @foreach($items as $item) {{ $item->items_name }} @endforeach </td>
                                <td>{{ $projectPayment->date }}</td>
                                <td>{{ number_format($projectPayment->amount, 2) }}</td>
                                <td> @if( $projectPayment->payment_method == 'check') Cheque @elseif($projectPayment->payment_method == 'open') Opening Balance @else Cash @endif</td>
                                <td>{{  $projectPayment->note }}</td>
                                <td><img src="{{ asset($projectPayment->check_file) }}" width="40px" height="40px" /> </td>
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
