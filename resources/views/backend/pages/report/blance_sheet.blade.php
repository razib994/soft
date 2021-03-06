@extends('backend.layouts.master')
@section('title')
    Balance Sheet
@endsection
@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Balance Sheet </h1>
            <form action="{{url('admin/profit-loss')}}"  method="get">
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
{{--                <a href="{{url('admin/export-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="#" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{route('admin.balance-pdf',[$start_date, $end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
    @php
        $today =  date("Y-m-d");
    @endphp
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Balance Sheet @if($today!=$start_date){{ $start_date }} - {{ $end_date }} @endif </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="bg-success text-white">
                            <th colspan="2">Income </th>
                            <th colspan="2"> Expense </th>
                        </tr>
                        </thead>

                        <tbody>
                            <tr style="background: #e2e6ea; font-weight: bold; border: 1px solid #000;">
                                <td> I. Particulars Name </td>
                                <td> Income Amount </td>

                                <td> E. Particulars Name </td>
                                <td> Expense Amount </td>
                            </tr>
                            <tr>
                                <td> Collection Form CLient </td>
                                <td>
                                    @if($today != $start_date)
                                        {{number_format($ct =  \Illuminate\Support\Facades\DB::table('client_payments')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                    @elseif($today == $start_date)
                                    {{number_format($ct =  \Illuminate\Support\Facades\DB::table('client_payments')->sum('amount'),2)}}
                                    @endif
                                </td>

                                <td>Project Expenditure </td>
                                <td>
                                    @if($today != $start_date)
                                    {{ number_format($ex = \Illuminate\Support\Facades\DB::table('project_payments')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                    @elseif($today == $start_date)
                                    {{ number_format($ex = \Illuminate\Support\Facades\DB::table('project_payments')->sum('amount'),2)}}
                                    @endif
                                </td>
                            </tr>
                            @php $st = ''; $total = 0; @endphp
                            <tr>
                                <td> <strong>Invest</strong> </td>
                                <td>
                                    @if($today != $start_date)
                                    {{ number_format( $invest = \App\InvestAdd::all()->whereBetween('date',[$start_date,$end_date])->sum('amount'),2) }}
                                @elseif($today == $start_date)
                                {{ number_format( $invest = \App\InvestAdd::all()->sum('amount'),2) }}
                                    @endif
                                </td>

                                <td><strong>Invest Refund </strong></td>
                                <td>
                                    @if($today != $start_date)
                                    {{ number_format($refund_invest = \App\InvestExpense::all()->whereBetween('date',[$start_date,$end_date])->sum('amount'),2) }}
                                @elseif($today == $start_date)
                                {{ number_format($refund_invest = \App\InvestExpense::all()->sum('amount'),2) }}
                                    @endif</td>

                            </tr>
                            <tr>
                                <td><strong>Other Loan </strong></td>
                                <td>
                                    @if($today != $start_date)
                                    {{number_format( $loan = \App\OtherLoanAdd::all()->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                @elseif($today == $start_date)
                                {{number_format( $loan = \App\OtherLoanAdd::all()->sum('amount'),2)}}
                                    @endif</td>

                                <td><strong> Loan Refund </strong> </td>
                                <td>
                                    @if($today != $start_date)
                                    {{number_format($loan_final = \App\OtherLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                @elseif($today == $start_date)
                                {{number_format($loan_final = \App\OtherLoanExpense::all()->sum('amount'),2)}}
                                    @endif</td>
                            </tr>
                            <tr>
                                <td><strong> Bank Loan </strong></td>
                                <td>
                                    @if($today != $start_date)
                                    {{number_format( $loan = \App\BankLoanAdd::all()->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                @elseif($today == $start_date)
                                {{number_format( $loan = \App\BankLoanAdd::all()->sum('amount'),2)}}
                                    @endif
                                </td>

                                <td><strong>Bank Loan Refund </strong> </td>
                                <td>
                                    @if($today != $start_date)
                                    {{number_format($loan_final = \App\BankLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->sum('amount'),2)}}
                                @elseif($today == $start_date)
                                {{number_format($loan_final = \App\BankLoanExpense::all()->sum('amount'),2)}}
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th> Total </th>
                            <th> {{ number_format($ct+$invest+$loan ,2) }} </th>
                            <th >Total </th>
                            <th> {{number_format($ex+$refund_invest+$loan_final,2)}} </th>
                        </tr>
                        <tr class="text-center bg-dark text-white">
                            <th colspan="3"> Total Balance </th>
                            <th colspan="1" class="text-sm text-white"> {{number_format((($ct+$invest+$loan) -($ex+$refund_invest+$loan_final)),2)}} </th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
