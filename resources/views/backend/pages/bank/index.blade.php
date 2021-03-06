@extends('backend.layouts.master')
@section('title')
    Bank Information
@endsection
@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bank Information</h1>
            @if(Auth::guard('admin')->user()->can('bank.create'))
            <a href="{{ route('banks.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Bank Information Amount</a>
                @endif
            <form action="{{ url("admin/banks") }}" method="get">
                <div class="row">
                    <div class="col-md-5">
                        <input type="date" name="start_date" required class="form-control"/>
                    </div>
                    <div class="col-md-5">
                        <input type="date" name="end_date" required class="form-control"/>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary"> Report </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
{{--                <a href="{{ url('admin/bank-export-csv') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{ url('admin/bank-export-excel') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{ route('admin.bank-export-pdf',[$start_date, $end_date]) }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
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
                <h6 class="m-0 font-weight-bold text-primary">Bank List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Bank Name </th>
                            <th>Amount</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $st_total = 0; $st=''; @endphp
                        @foreach($banks as $bank)
                        <tr>
                            <td> {{ $bank->id  }} </td>
                            <td><a href="{{ route('admin.bank-report', $bank->id) }}" style="text-decoration: none"> <strong>{{ $bank->bank_name  }} ( {{ $bank->branch_name  }} )</strong><br> {{ $bank->ac_no  }} (Amount (Open) - <b>{{ $bank->amount }}</b>) </a></td>
                            <td class="text-right">
                                @if($today!=$start_date)
                                {{number_format($st = (\App\ClientPayment::where('bank_id', $bank->id)->where('payment_method','check')->wherebetween('date',[$start_date,$end_date])->sum('amount')+ \App\OtherLoanAdd::all()->where('bank_id',$bank->id)->wherebetween('date',[$start_date,$end_date])->where('payment_method','check')->sum('amount') +\App\BankLoanAdd::all()->where('bank_id',$bank->id)->wherebetween('date',[$start_date,$end_date])->where('payment_method','check')->sum('amount') +\App\InvestAdd::all()->wherebetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')  + \App\Deposit::where('bank_id', $bank->id)->wherebetween('date',[$start_date,$end_date])->sum('amount') + \App\Bank::all()->wherebetween('date',[$start_date,$end_date])->sum('amount')) + \App\BankTransfer::all()->wherebetween('date',[$start_date,$end_date])->where('to_bank_id', $bank->id)->sum('amount') - (\App\ProjectPayment::where('bank_id', $bank->id)->wherebetween('date',[$start_date,$end_date])->where('payment_method','check')->sum('amount')
                                + \App\Widraw::where('bank_id', $bank->id)->wherebetween('date',[$start_date,$end_date])->sum('amount') + \App\InvestExpense::all()->wherebetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+\App\OtherLoanExpense::all()->wherebetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\BankLoanExpense::all()->wherebetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\BankTransfer::all()->wherebetween('date',[$start_date,$end_date])->where('form_bank_id', $bank->id)->sum('amount')), 2)}}
                                @elseif($today=$start_date)
                                {{number_format($st = (\App\ClientPayment::where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\OtherLoanAdd::all()->where('bank_id',$bank->id)->where('payment_method','check')->sum('amount') +\App\BankLoanAdd::all()->where('bank_id',$bank->id)->where('payment_method','check')->sum('amount') +\App\InvestAdd::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')  + \App\Deposit::where('bank_id', $bank->id)->sum('amount') + $bank->amount) + \App\BankTransfer::all()->where('to_bank_id', $bank->id)->sum('amount') - (\App\ProjectPayment::where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')
                               + \App\Widraw::where('bank_id', $bank->id)->sum('amount') + \App\InvestExpense::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+\App\OtherLoanExpense::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\BankLoanExpense::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\BankTransfer::all()->where('form_bank_id', $bank->id)->sum('amount')), 2)}}
                               @endif
                                @php $st_total = $st_total + $st  ;@endphp
                            </td>
                            <td>
                                <form  action="{{route('banks.destroy', $bank->id)}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('bank.edit'))
                                    <a href="{{route('banks.edit', $bank->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('bank.delete'))
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Bank Information!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                        @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="2" class="text-right"> Total </th>
                            <th colspan="" class="text-right"> {{ number_format($st_total,2) }} </th>
                            <th>  </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
