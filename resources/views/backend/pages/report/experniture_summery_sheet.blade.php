@extends('backend.layouts.master')
@section('title')
    Expenditure Summary List
@endsection
@section('content')

    <div class="container-fluid">
        @php
            $today =  date("Y-m-d");
        @endphp
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Expenditure Summary </h1>
            <form action="#"  method="get">
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
                <a class="btn btn-warning" href="{{route('admin.expenditure_summery')}}"> <i class="fa fa-backward"></i> Back</a>

                {{--                <a href="{{url('admin/export-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{url('admin/export-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{route('admin.expenditure-pdf',[$start_date, $end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Expenditure Summary  </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th> Sl</th>
                            <th> Project Name</th>
                            <th> Cash Exp. </th>
                            <th> Bank Exp. </th>
                            <th width="20%">Total</th>
                        </tr>
                        </thead>
                        <?php $total = 0; $to = 0; $final =0; $fin=''; $ck=''; $ca='';

                    ?>

                        <tbody>

                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td><a class="text-primary" style=" text-decoration:none;" href="{{route('projects.indivisual_Report', $project->id)}}"> <b>{{ $project->project_name }} ({{ $project->project_address }}) </b></a> </td>
                                <td>
                                    @if($today != $start_date)
                                 {{  number_format($ca = \App\ProjectPayment::where('project_id', $project->id)->where('payment_method', 'cash')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2) }}
                                    <?php $total = $total + $ca ;?>
                                    @elseif($today == $start_date)
                                {{  number_format($ca = \App\ProjectPayment::where('project_id', $project->id)->where('payment_method', 'cash')->sum('amount'),2) }}
                                    <?php $total = $total + $ca;?>
                                    @endif
                                </td>
                                <td>
                                    @if($today != $start_date)
                                 {{ number_format($ck = \App\ProjectPayment::where('project_id', $project->id)->where('payment_method', 'check')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2) }}
                                    <?php $to = $to + $ck; ?>
                                    @elseif($today == $start_date)
                                {{ number_format($ck =\App\ProjectPayment::where('project_id', $project->id)->where('payment_method', 'check')->sum('amount'),2) }}
                                    <?php $to = $to +$ck; ?>
                                    @endif

                                </td>
                                <td>
                                    {{  number_format($ca + $ck,2) }}

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th> Sl</th>
                            <th> Project Name</th>
                            <th> {{ number_format($total,2) }}</th>
                            <th> {{ number_format($to,2) }} </th>
                            <th width="20%">{{ number_format($total + $to,2)  }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

