@extends('backend.layouts.master')
@section('title')
    Balance Sheet
@endsection
@section('content')

    <div class="container-fluid">

    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Final Balance Sheet </h1>
            <form action="{{url('admin/final_blance_sheet')}}"  method="get">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="date" class="form-control " required name="start_date" id="start_date" placeholder="Start Date">
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
                <a class="btn btn-warning" href="{{url('admin/final_blance_sheet')}}"> <i class="fa fa-backward"></i> Back</a>
                {{--                <a href="{{url('admin/final-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{url('admin/final-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{route('admin.final-pdf',[$start_date, $end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
    @php
        $today =  date("Y-m-d");
    @endphp
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Final Balance Sheet @if($today!=$start_date){{ $start_date }} - {{ $end_date }} @endif </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th >Investment </th>
                            <!--<th >Profit/loss </th>-->
                            <th >Client </th>
                            <th > Bank Loan</th>
                            <th > Others Loan </th>
                            <th > Grand Total </th>
                            <th > ptodate Expenditure </th>
                            <th > Balance </th>
                            <th > Balance Cash </th>
                            <th > Balance Bnak </th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td><a href="{{url('admin/investmoneys')}}" style="text-decoration:none; font-weight:bold;">
                                    @if($today != $start_date)
                                    {{ number_format($in = ( \App\InvestAdd::all()->whereBetween('date',[$start_date,$end_date])->sum('amount')) -(\App\InvestExpense::all()->whereBetween('date',[$start_date,$end_date])->sum('amount')),2) }}
                                    @elseif($today == $start_date)
                                        {{ number_format($in = ( \App\InvestAdd::all()->sum('amount')) -(\App\InvestExpense::all()->sum('amount')),2) }}
                                    @endif
                                </a> </td>
                            <!--<td > -29,196,474 </td>-->
                            <td > <a href="{{url('admin/colloections')}}" style="text-decoration:none; font-weight:bold;">
                                    @if($today != $start_date)
                                    {{ number_format($cl = \App\ClientPayment::all()->whereBetween('date',[$start_date,$end_date])->sum('amount'),2) }}
                                    @elseif($today == $start_date)
                                    {{ number_format($cl = \App\ClientPayment::all()->sum('amount'),2) }}
                                    @endif
                                </a> </td>
                            <td > <a href="{{url('admin/bankloans')}}" style="text-decoration:none; font-weight:bold;">
                                    @if($today != $start_date)
                                    {{ number_format( $ba = (\App\BankLoanAdd::all()->whereBetween('date',[$start_date,$end_date])->sum('amount') -\App\BankLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->sum('amount')) ,2) }}
                                    @elseif($today == $start_date)
                                    {{ number_format( $ba = (\App\BankLoanAdd::all()->sum('amount') -\App\BankLoanExpense::all()->sum('amount')) ,2) }}
                                    @endif
                                </a></td>
                            <td > <a href="{{url('admin/othersloans')}}" style="text-decoration:none; font-weight:bold;">
                                    @if($today != $start_date)
                                    {{ number_format($ot = (\App\OtherLoanAdd::all()->whereBetween('date',[$start_date,$end_date])->sum('amount'))-(\App\OtherLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->sum('amount')),2) }}
                                    @elseif($today == $start_date)
                                    {{ number_format($ot = (\App\OtherLoanAdd::all()->sum('amount'))-(\App\OtherLoanExpense::all()->sum('amount')),2) }}
                                        @endif
                                </a></td>
                            <td > {{number_format($in+$cl+$ba+$ot,2)}} </td>
                            <td > <a href="{{url('admin/project_dashboard')}}" style="text-decoration:none; font-weight:bold;">
                                    @if($today != $start_date)
                                    {{ number_format($project = \App\ProjectPayment::all()->whereBetween('date',[$start_date,$end_date])->sum('amount'),2) }}
                                    @elseif($today == $start_date)
                                    {{ number_format($project = \App\ProjectPayment::all()->sum('amount'),2) }}
                                        @endif
                                </a></td>
                            <td > {{number_format(($in+$cl+$ba+$ot)-$project,2)}}</td>
                            <td>
                                @php $st_total =0;$st=''; @endphp
                                    @foreach($cashs as $cash)
                         <a href="{{url('admin/cashes')}}" style="text-decoration:none; font-weight:bold;">
                             @if($today != $start_date)
                             {{number_format($st = (\App\ClientPayment::where('payment_method','cash')->whereBetween('date',[$start_date,$end_date])->sum('amount')+\App\InvestAdd::all()->where('payment_method','cash')->whereBetween('date',[$start_date,$end_date])->sum('amount') +\App\OtherLoanAdd::all()->where('payment_method','cash')->whereBetween('date',[$start_date,$end_date])->sum('amount') + \App\Cashopen::all()->whereBetween('date',[$start_date,$end_date])->sum('amount')  + \App\Cash::all()->whereBetween('date',[$start_date,$end_date])->sum('amount') + \Illuminate\Support\Facades\DB::table("widraws")->whereBetween('date',[$start_date,$end_date])->get()->sum("amount")) - (\App\OtherLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->where('payment_method','cash')->sum('amount')+ \App\InvestExpense::all()->where('payment_method','cash')->whereBetween('date',[$start_date,$end_date])->sum('amount')+\App\ProjectPayment::where('payment_method','cash')->whereBetween('date',[$start_date,$end_date])->sum('amount') + \Illuminate\Support\Facades\DB::table("deposits")->whereBetween('date',[$start_date,$end_date])->get()->sum("amount")),2)}}
                             @elseif($today == $start_date)
                                 {{number_format($st = (\App\ClientPayment::where('payment_method','cash')->sum('amount')+\App\InvestAdd::all()->where('payment_method','cash')->sum('amount') +\App\OtherLoanAdd::all()->where('payment_method','cash')->sum('amount') + \App\Cashopen::all()->sum('amount')  + $cash->amount + \Illuminate\Support\Facades\DB::table("widraws")->get()->sum("amount")) - (\App\OtherLoanExpense::all()->where('payment_method','cash')->sum('amount')+ \App\InvestExpense::all()->where('payment_method','cash')->sum('amount')+\App\ProjectPayment::where('payment_method','cash')->sum('amount') + \Illuminate\Support\Facades\DB::table("deposits")->get()->sum("amount")),2)}}
                             @endif
                         </a>
                          @endforeach
                            </td>
                            <td >

                        @php $st_total = 0; $st=''; @endphp
                        @foreach($banks as $bank)
                                    @if($today != $start_date)
                      @php number_format($st = (\App\BankTransfer::all()->where('to_bank_id', $bank->id)->whereBetween('date',[$start_date,$end_date])->sum('amount') + \App\ClientPayment::where('bank_id', $bank->id)->whereBetween('date',[$start_date,$end_date])->where('payment_method','check')->sum('amount')+ \App\InvestMoney::all()->whereBetween('date',[$start_date,$end_date])->sum('amount') +\App\OtherLoanAdd::all()->whereBetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount') + \App\BankLoanAdd::all()->whereBetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount') + \App\InvestAdd::all()->whereBetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\Deposit::where('bank_id', $bank->id)->whereBetween('date',[$start_date,$end_date])->sum('amount') + \App\Bank::all()->whereBetween('date',[$start_date,$end_date])->sum('amount')) - (\App\BankTransfer::all()->where('form_bank_id', $bank->id)->whereBetween('date',[$start_date,$end_date])->sum('amount') + \App\ProjectPayment::where('bank_id', $bank->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->sum('amount')
                                    + \App\Widraw::where('bank_id', $bank->id)->whereBetween('date',[$start_date,$end_date])->sum('amount')+ \App\InvestExpense::all()->where('bank_id', $bank->id)->whereBetween('date',[$start_date,$end_date])->where('payment_method','check')->sum('amount')+\App\BankLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->whereBetween('date',[$start_date,$end_date])->sum('amount')+\App\OtherLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')), 2); @endphp
                       @php $st_total = $st_total + $st  ;@endphp
                                    @elseif($today == $start_date)
                                    @php number_format($st = (\App\BankTransfer::all()->where('to_bank_id', $bank->id)->sum('amount') + \App\ClientPayment::where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\InvestMoney::all()->sum('amount') +\App\OtherLoanAdd::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount') + \App\BankLoanAdd::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount') + \App\InvestAdd::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\Deposit::where('bank_id', $bank->id)->sum('amount') + $bank->amount) - (\App\BankTransfer::all()->where('form_bank_id', $bank->id)->sum('amount') + \App\ProjectPayment::where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')
                                    + \App\Widraw::where('bank_id', $bank->id)->sum('amount')+ \App\InvestExpense::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+\App\BankLoanExpense::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+\App\OtherLoanExpense::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')), 2); @endphp
                                    @php $st_total = $st_total + $st  ;@endphp
                            @endif
                            @endforeach
                          <a href="{{url('admin/banks')}}" style="text-decoration:none; font-weight:bold;"> {{number_format($st_total,2)}} </a></td>
                        </tr>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
