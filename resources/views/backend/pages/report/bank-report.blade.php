@extends('backend.layouts.master')
@section('title')
    Bank Report
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $banks->bank_name }}</h1>
                <div class="col-md-6 mb-2 text-right">
                    <form action="{{route('admin.bank-report', $banks->id)}}"  method="get">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="date" class="form-control " required name="start_date" id="start_date" placeholder="Start Date">
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control" required name="end_date" id="end_date" placeholder="End Date">

                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                {{--            <a href="{{url('admin/withdraw-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{url('admin/withdraw-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{route('admin.banks-pdf',[$banks->id,$start_date, $end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Projects - {{ $banks->bank_name }} </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                @php
                                    $today =  date("Y-m-d");
                                @endphp
                                <tr>
                                    <th colspan="4" class="text-center"> Expenditure </th>
                                </tr>
                                <tr>
                                    <th> Date </th>
                                    <th> Item Name </th>
                                    <th> check NO </th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0; $to = 0; $final =0; $fin=''; $ck=''; $ca='';

                                ?>
                                @php $project_amount =''; $pro_t_amount = 0;
                                if($today != $start_date){
                                $projectPayments = \Illuminate\Support\Facades\DB::table('project_payments')->where('bank_id',$banks->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->get();
                                } else {
                                $projectPayments = \Illuminate\Support\Facades\DB::table('project_payments')->where('bank_id',$banks->id)->where('payment_method','check')->get();
                                }
                                @endphp
                                @foreach($projectPayments as $projectPayment)
                                    <tr>
                                        <td>{{ $projectPayment->date }}</td>
                                        <td> @php $items = \App\Item::where('id',$projectPayment->item_name )->get() @endphp @foreach($items as $item) {{ $item->items_name }} @endforeach </td>

                                        <td>{{ $projectPayment->check_no}}</td>
                                        <td style="text-align: right!important;">{{  number_format($project_amount=$projectPayment->amount, 2) }}
                                            @php $pro_t_amount = $pro_t_amount + $project_amount; @endphp
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3"> Total </th>
                                    <th style="text-align: right!important;"> {{ number_format($pro_t_amount,2) }} </th>
                                </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Projects - {{ $banks->bank_name }} </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th colspan="4" class="text-center">Collection</th>
                                </tr>
                                <tr>

                                    <th> Date </th>
                                    <th> Client Name </th>
                                    <th> check NO </th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $client_amount =''; $t_amount = 0; $finals_report=''; $bank_lon='';
                                if($today != $start_date){
                                $clientsPayment = \Illuminate\Support\Facades\DB::table('client_payments')->where('bank_id',$banks->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->where('bank_id',$banks->id)->get();
                                } else {
                                $clientsPayment = \Illuminate\Support\Facades\DB::table('client_payments')->where('bank_id',$banks->id)->where('payment_method','check')->where('bank_id',$banks->id)->get();
                                }
                                @endphp
                                @foreach($clientsPayment as $clientPayment)
                                    <tr>
                                        <td>{{ $clientPayment->date }}</td>
                                        <td> @php $client = \App\Client::where('id',$clientPayment->client_id )->get() @endphp @foreach($client as $client) {{ $client->client_name }} @endforeach </td>
                                        <td>{{ $clientPayment->check_no}}</td>
                                        <td style="text-align: right!important;">{{   number_format($client_amount = $clientPayment->amount, 2) }}
                                        @php $t_amount = $t_amount+$client_amount; @endphp
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" style="text-align: center!important;"> {{ $banks->bank_name }} </td>
                                    <td style="text-align: right!important;">
                                        @if($today != $start_date)
                                        {{ number_format($t_bank = (\App\Bank::all()->where('id',$banks->id)->whereBetween('date',[$start_date,$end_date])->sum('amount')-\App\Widraw::all()->where('bank_id',$banks->id)->whereBetween('date',[$start_date,$end_date])->sum('amount')),2) }}
                                        @else
                                        {{ number_format($t_bank = (\App\Bank::all()->where('id',$banks->id)->sum('amount')-\App\Widraw::all()->where('bank_id',$banks->id)->sum('amount')),2) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center!important;"> <b>Deposit - {{ $banks->bank_name }} </b></td>
                                    <td style="text-align: right!important;">
                                        @if($today != $start_date)
                                        {{ number_format($d_bank = (\App\Deposit::all()->where('bank_id',$banks->id)->whereBetween('date',[$start_date,$end_date])->sum('amount')),2) }}
                                        @else
                                        {{ number_format($d_bank = (\App\Deposit::all()->where('bank_id',$banks->id)->sum('amount')),2) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3"> Invest Money </th>
                                    <th style="text-align: right!important;">
                                        @if($today != $start_date)
                                        {{number_format($investadd = \App\InvestAdd::all()->where('bank_id',$banks->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->sum('amount')-\App\InvestExpense::all()->where('bank_id',$banks->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                        @else
                                        {{number_format($investadd = \App\InvestAdd::all()->where('bank_id',$banks->id)->where('payment_method','check')->sum('amount')-\App\InvestExpense::all()->where('bank_id',$banks->id)->where('payment_method','check')->sum('amount'),2)}}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3"> Other Loan </th>
                                    <th style="text-align: right!important;">
                                        @if($today != $start_date)
                                        {{number_format($loan = \App\OtherLoanAdd::all()->where('bank_id',$banks->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->sum('amount')-\App\OtherLoanExpense::all()->where('bank_id',$banks->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                        @else
                                        {{number_format($loan = \App\OtherLoanAdd::all()->where('bank_id',$banks->id)->where('payment_method','check')->sum('amount')-\App\OtherLoanExpense::all()->where('bank_id',$banks->id)->where('payment_method','check')->sum('amount'),2)}}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3"> Bank Loan </th>
                                    <th style="text-align: right!important;">
                                        @if($today != $start_date)
                                            {{number_format($bank_lon = \App\BankLoanAdd::all()->where('bank_id',$banks->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->sum('amount')-\App\BankLoanExpense::all()->where('bank_id',$banks->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                        @else
                                            {{number_format($bank_lon = \App\BankLoanAdd::all()->where('bank_id',$banks->id)->where('payment_method','check')->sum('amount')-\App\BankLoanExpense::all()->where('bank_id',$banks->id)->where('payment_method','check')->sum('amount'),2)}}
                                        @endif
                                    </th>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3"> Total </th>
                                    <th style="text-align: right!important;">
                                        @if($today != $start_date)
                                        {{ number_format(($finals_report = (\App\BankTransfer::all()->where('to_bank_id', $banks->id)->whereBetween('date',[$start_date,$end_date])->sum('amount') + $t_amount +$investadd +$loan + $d_bank +$bank_lon + $t_bank)-\App\BankTransfer::all()->where('form_bank_id', $banks->id)->whereBetween('date',[$start_date,$end_date])->sum('amount')),2) }}
                                        @else
                                        {{ number_format(($finals_report = (\App\BankTransfer::all()->where('to_bank_id', $banks->id)->sum('amount') + $t_amount +$investadd +$loan + $d_bank+$bank_lon + $t_bank)-\App\BankTransfer::all()->where('form_bank_id', $banks->id)->sum('amount')),2) }}
                                       @endif
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">Balance</th>
                            <th style="text-align: right!important;">{{number_format(($finals_report) - $pro_t_amount,2)}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
