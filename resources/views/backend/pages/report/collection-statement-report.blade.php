@extends('backend.layouts.master')
@section('title')
    Monthly Collection Statement List
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
            <h1 class="h3 mb-0 text-gray-800">Monthly Collection Statement </h1>


        </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 mb-2 text-right">
            <a href="{{ url('admin/collection-statement-report') }}" class="btn btn-warning btn-sm"> <i class="fa fa-backward"></i> Back </a>
{{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
            <a href="{{route('admin.collection_pdf_statement',[$start_date,$end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
            {{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
        </div>
    </div>
@php
    $today =  date("Y-m-d");
@endphp
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-3">
                     <h6 class="m-0 font-weight-bold text-primary">Monthly Collection Statement </h6>
                    </div>
                    <div class="col-md-3">
                        {{$start_date}} to {{ $end_date }}
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route("admin.collection-statement-report") }}" method="get">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="date" required name="start_date" class="form-control"/>
                                </div>
                                <div class="col-md-5">
                                    <input type="date" required name="end_date" class="form-control"/>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary"> Report </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="bg-primary text-white">
                            <th>Client Name</th>
                            <th>Client ID</th>
                            <th>Date</th>
                            <th>Cash </th>
                            <th>Bank </th>
                            <th>Up to Prev. Month </th>
                            <th>Refund </th>
                            <th>Net Collection </th>
                            <th width="10%">Remark</th>
                        </tr>

                        </thead>
                        @php $main_cash = 0; $main_bank =0; $main_net=0; $main_re=0; $main_refund = 0; @endphp
                        @foreach($projects as $project)
                        <tbody>
                        <tr>
                            <td colspan="9" class="py-1"></td>
                        </tr>
                        <tr style="background: rgba(0,0,0,0.2); ">
                            <td colspan="9"><strong style="font-size: 20px;">{{ $project->project_name }} </strong></td>
                        </tr>
                        @php $clients = \App\Client::where('project_id', $project->id)->get() @endphp
                        <?php $cashed = 0; $cash=''; $banked = 0; $net =0; $nets=''; $bank =''; $up_pre =0; $refund=''; $re=0;
                        ?>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->client_name }}</td>
                            <td>Client-{{ $client->id }}</td>
                            <td> </td>

                            <td class="text-right">

                                @if($today!=$start_date)
                                 {{ number_format($cash = \App\ClientPayment::where('client_id',$client->id)->where('payment_method','cash')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                 @elseif($today=$start_date)
                                 {{ number_format($cash = \App\ClientPayment::where('client_id',$client->id)->where('payment_method','cash')->sum('amount'),2)}}
                                 @endif
                                 </td>
                            <td class="text-right">
                                @if($today!=$start_date)
                            {{ number_format($bank = \App\ClientPayment::where('client_id',$client->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->sum('amount') ,2)}}
                            @elseif($today=$start_date)
                            {{ number_format($bank = \App\ClientPayment::where('client_id',$client->id)->where('payment_method','check')->sum('amount') ,2)}}
                            @endif
                            </td>
                            <td class="text-right">
                                {{  number_format(\App\ClientPayment::where('client_id',$client->id)->where('date','<',$end_date)->sum('amount') - ($cash + $bank),2)  }}
                            </td>
                            <td class="text-right">
                                @if($today!=$start_date)
                                {{  number_format($refund =\App\ClientPayment::where('client_id',$client->id)->where('payment_method','refund')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)  }}
                                @elseif($today=$start_date)
                                {{  number_format($refund =\App\ClientPayment::where('client_id',$client->id)->where('payment_method','refund')->sum('amount'),2)  }}
                                    @endif
                            </td>
                            <td class="text-right"> {{  number_format($nets = \App\ClientPayment::where('client_id',$client->id)->where('date','<',$end_date)->sum('amount'), 2) }} </td>
                            <td> <?php $pays =  \App\ClientPayment::where('client_id', $client->id)->get()  ?> @foreach($pays as $pay) {{ $pay->note }} @endforeach  </td>
                            <?php
                            $cashed = $cashed + $cash;
                            $banked = $banked + $bank;
                            $net = $net + $nets;
                            $re = $re + $refund;
                            ?>
                        </tr>
                        @endforeach

                        <tr style="background: rgba(0,0,0,0.1); ">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong> {{number_format($cashed,2)}} @php $main_cash = $main_cash + $cashed; @endphp </strong></td>
                            <td class="text-right"><strong> {{number_format($banked,2)}} @php $main_bank = $main_bank + $banked; @endphp</strong></td>
                            <td class="text-right"><strong> {{number_format($net - ($cashed + $banked),2)}} @php $main_refund = $main_refund + ($net - ($cashed + $banked)); @endphp </strong></td>
                            <td class="text-right"><strong> {{number_format( $re,2)  }} @php $main_re = $main_re + $re; @endphp</strong></td>
                            <td class="text-right"> <strong>{{number_format($net,2)}} @php $main_net = $main_net + $net; @endphp</strong></td>
                            <td> <strong>Noted </strong></td>
                        </tr>
                        @endforeach
                        </tbody>
                            <tfoot>
                            <tr class="bg-dark text-white">
                                <th colspan="3">Total</th>

                                <th>{{number_format($main_cash,2)}} </th>
                                <th>{{number_format($main_bank,2)}} </th>
                                <th>{{number_format($main_refund,2)}}  </th>
                                <th>{{number_format($main_re,2)}}  </th>
                                <th>{{number_format($main_net,2)}}  </th>
                                <th width="10%">Remark</th>
                            </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
