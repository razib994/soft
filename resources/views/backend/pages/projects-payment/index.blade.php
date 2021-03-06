@extends('backend.layouts.master')
@section('title')
    Amount Collect List
@endsection
@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b class="text-danger">{{ $project->project_name }} </b> </h1>
            <a href="{{ route('projects.created', $project->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Expenditure Amount </a>
            <form action="{{route('projects.payments', $project->id)}}"  method="get">
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
        @php
            $today =  date("Y-m-d");
$fi_to=0; $to='';
        @endphp
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 mb-2 text-right">
{{--            <a href="{{url('admin/project-payments-export-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
            <a href="{{ route('projects.payments', $project->id)}}" class="btn btn-warning btn-sm "><i class="fas fa-backward " aria-hidden="true"></i> Back </a>
            <a href="{{url('admin/project-payments-export-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
            <a href="{{url('admin/pdf-project-payments', [$project->id, $start_date, $end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
        </div>
    </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Projects - {{ $project->project_name }} </h6>
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
                            <th style="text-align: right !important;">Amount</th>
                            <th> Payment Method </th>
                            <th> Note </th>
                            <th> Cheque Image </th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @php
                        $i=1;
                        $t =0;
                        $a ='';
                        @endphp
                        @foreach($project_payments as $projectPayment)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                @php $category =  \App\Category::where('id',$projectPayment->category_id )->get(); @endphp @foreach($category as $cat) {{ $cat->category_name }} @endforeach
                                <!--{{ $projectPayment->category_id }} -->
                                </td>
                                <td> @php $items = \App\Item::where('id',$projectPayment->item_name )->get() @endphp @foreach($items as $item) {{ $item->items_name }} @endforeach </td>
                                <td>{{ $projectPayment->date }}</td>
                                <td style="text-align: right !important;">
                                    @if($today!=$start_date)
                                        {{ number_format($to = $projectPayment->amount, 2) }}

                                    @elseif($today=$start_date)
                                        {{ number_format($to = $projectPayment->amount, 2) }}
                                    @endif
                                    @php

                                        $fi_to = $fi_to + $to;
                                    @endphp

                                </td>
                                <td> @if( $projectPayment->payment_method == 'check') Cheque @elseif($projectPayment->payment_method == 'open') Opening Balance @else Cash @endif</td>
                                <td>{{  $projectPayment->note }}</td>
                                <td><img src="{{ asset($projectPayment->check_file) }}" width="40px" height="40px" /> </td>
                                <td>
                                    <form action="{{route('projects.payments.destroy', ['id' => $project->id, 'payment_id' => $projectPayment->id])}}" method="POST">
                                        <a href="{{route('projects.payments.edit', ['id' => $project->id, 'payments_id' => $projectPayment->id])}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are You Sure Deleted This Expenditure Amount!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

{{--                        @foreach($project->projectPayments as $projectPayment)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $i++ }}</td>--}}
{{--                            <td>--}}
{{--                                @php $category =  \App\Category::where('id',$projectPayment->category_id )->get(); @endphp @foreach($category as $cat) {{ $cat->category_name }} @endforeach--}}
{{--                                <!--{{ $projectPayment->category_id }} -->--}}
{{--                                </td>--}}
{{--                            <td> @php $items = \App\Item::where('id',$projectPayment->item_name )->get() @endphp @foreach($items as $item) {{ $item->items_name }} @endforeach </td>--}}
{{--                            <td>{{ $projectPayment->date }}</td>--}}
{{--                            <td style="text-align: right !important;">--}}
{{--                                @if($today!=$start_date)--}}
{{--                                    {{ number_format($to = $projectPayment->amount, 2) }}--}}

{{--                                @elseif($today=$start_date)--}}
{{--                                    {{ number_format($to = $projectPayment->amount, 2) }}--}}
{{--                                @endif--}}
{{--                                @php--}}

{{--                                    $fi_to = $fi_to + $to;--}}
{{--                                @endphp--}}

{{--                            </td>--}}
{{--                            <td> @if( $projectPayment->payment_method == 'check') Cheque @elseif($projectPayment->payment_method == 'open') Opening Balance @else Cash @endif</td>--}}
{{--                            <td>{{  $projectPayment->note }}</td>--}}
{{--                            <td><img src="{{ asset($projectPayment->check_file) }}" width="40px" height="40px" /> </td>--}}
{{--                            <td>--}}
{{--                                <form action="{{route('projects.payments.destroy', ['id' => $project->id, 'payment_id' => $projectPayment->id])}}" method="POST">--}}
{{--                                    <a href="{{route('projects.payments.edit', ['id' => $project->id, 'payments_id' => $projectPayment->id])}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Expenditure Amount!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        @endforeach--}}

                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4">Total</th>
                            <th colspan="4" style="text-align: right !important;"><strong class="text-danger"> {{ number_format( $fi_to,2) }} </strong></th>
                            <th width="15%">Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
