@extends('backend.layouts.master')
@section('title')
    Project Information
@endsection
@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6"><h1 class="h3 mb-0 text-gray-800">{{ $project->project_name }}  </h1></div>
            <div class="col-md-6 mb-2 text-right">
                <form action="{{route('projects.indivisual_Report', $project->id)}}"  method="get">
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
        </div>
@php
            $today =  date("Y-m-d");
        @endphp
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $project->project_name }} ({{ $project->project_address }}) </h6>

                    </div>
                    <div class="col-md-3">{{ $start_date }} to {{ $end_date }}</div>
                    <div class="col-md-3">
{{--                        <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                        <a class="btn btn-warning" href="{{route('projects.indivisual_Report', $project->id)}}"> <i class="fa fa-backward"></i> Back</a>
                        <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                        <a href="{{url('admin/pdf-project-wise-payments', [$project->id, $start_date, $end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                        {{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}

                    </div>


                </div>


            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="bg-success text-white">
                        <td> Item Name </td>
                         <td style="text-align: right !important;"> Cash </td>
                        <td style="text-align: right !important;"> Cheque </td>

                        <td style="text-align: right !important;"> Total </td>
                        <td style="text-align: right !important;"> Up to Prev Month </td>
                        <td style="text-align: right !important;"> Net Amount </td>
                    </tr>
                    </thead>
                    <?php $total = 0; $to = 0;
                    $net=0; $nets=''; $check=0;  $checks =''; $cashs = '';
                    $cash =0; $net=''; $t_nes =0; $opens=''; $privies=''; $t_pre=0; $opensd='';
                    $checks_date=''; $c_final=0; $cashs_date=''; $cash_f = 0;

                    ?>

                    <tbody>
                    @foreach($categories_main as $category_m)
                        <tr style="background: #eee;" >
                            <th colspan="6">
                                <strong >{{ $category_m->category_name }} </strong>
                            </th>
                        </tr>
                        <?php $items = \App\Item::where('category_id', $category_m->id)->get()?>
                        @foreach($items as $item)
                            <tr>
                                <td> {{ $item->items_name }}</td>
                                <td style="text-align: right !important;">
                                    @if($today!=$start_date)
                                        @php number_format($cashs_date = \App\ProjectPayment::where('item_name',$item->id)->whereDate('date','<',$start_date)->where('payment_method','cash')->where('project_id', $project->id)->sum('amount'),2) @endphp

                                        {{ number_format($cashs = \App\ProjectPayment::where('item_name',$item->id)->whereBetween('date',[$start_date,$end_date])->where('payment_method','cash')->where('project_id', $project->id)->sum('amount'),2) }}
                                    @elseif($today=$start_date)
                                        @php $cashs_date=0 @endphp
                                    {{ number_format($cashs = \App\ProjectPayment::where('item_name',$item->id)->where('payment_method','cash')->where('project_id', $project->id)->sum('amount'),2) }}

                                    @endif
                                    </td>
                                <td style="text-align: right !important;">
                                    @if($today!=$start_date)
                                        @php number_format($checks_date = \App\ProjectPayment::where('item_name',$item->id)->whereDate('date','<',$start_date)->where('payment_method','check')->where('project_id', $project->id)->sum('amount'),2) @endphp

                                        {{  number_format($checks = \App\ProjectPayment::where('item_name',$item->id)->whereBetween('date',[$start_date,$end_date])->where('payment_method','check')->where('project_id', $project->id)->sum('amount'),2) }}
                                    @elseif($today=$start_date)
                                        @php $checks_date=0 @endphp
                                    {{  number_format($checks = \App\ProjectPayment::where('item_name',$item->id)->where('payment_method','check')->where('project_id', $project->id)->sum('amount'),2) }}
                                    @endif



                                </td>

                                <td style="text-align: right !important;">{{ number_format(($checks + $cashs),2) }}
                                    @if($today!=$start_date)
                                        @php  number_format($opens = \App\ProjectPayment::where('item_name',$item->id)->whereBetween('date',[$start_date,$end_date])->where('payment_method','open')->where('project_id', $project->id)->sum('amount'),2) @endphp
                                        @php  number_format($opensd = \App\ProjectPayment::where('item_name',$item->id)->whereDate('date','<=',$start_date)->where('payment_method','open')->where('project_id', $project->id)->sum('amount'),2) @endphp
                                    @elseif($today=$start_date)
                                        @php  number_format($opens = \App\ProjectPayment::where('item_name',$item->id)->where('payment_method','open')->where('project_id', $project->id)->sum('amount'),2) @endphp
                                    @endif
                                </td>
                                <td style="text-align: right !important;">



                                        {{ number_format($privies = \App\ProjectPayment::where('item_name',$item->id)->whereDate('date','<=',$start_date)->where('project_id', $project->id)->sum('amount'),2) }}

                                </td>
                                <td style="text-align: right !important;">
                                    @if($today!=$start_date)
                                    {{ number_format($net = (($checks+$cashs+ $opens)+$privies),2) }}
                                    @elseif($today=$start_date)
                                        {{ number_format($net = ($checks+$cashs+ $opens),2) }}
                                    @endif

                                </td>
                            </tr>

                            <?php

                            $check = $check + $checks;
                            $cash = $cash + $cashs;
                            $t_nes = $t_nes + $net;
                                $t_pre = $t_pre + $privies;
                                $c_final =$c_final + $checks_date;
                            $cash_f = $cash_f+$cashs_date;
                            ?>
                        @endforeach

                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th> Total </th>

                    <th style="text-align: right !important;"> {{ number_format(($cash),2) }} </th>
                    <th style="text-align: right !important;"> {{ number_format(($check),2) }} </th>
                    <th style="text-align: right !important;"> {{ number_format($check + $cash,2) }}</th>
                    <th style="text-align: right !important;"> {{ number_format($t_pre,2) }}</th>
                    <th style="text-align: right !important;"><strong> {{ number_format($t_nes,2) }}  </strong></th>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
@endsection
