<style>
    tr th {
        font-size: 11px;
    }
    tr td {
        font-size: 11px;
    }
</style>
<div class="container-fluid">
    @php
        $final_date ='';
        $today =  date("Y-m-d");
        if($today == $start_date) {
            echo '';
        }else {
            $final_date = $start_date.'-'.$end_date;
        }


        $f_month =  date('F, Y', strtotime($end_date));
        $f_month_s =  date('F, Y', strtotime($start_date));
    @endphp
    <h1> Theme Engineer Ltd. </h1>
    <p> Bank Information (<b>{{$f_month_s}} - {{$f_month}} </b>)  </p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Bank Name </th>
                                <th>Amount</th>

                            </tr>
                            </thead>

                            <tbody>
                            @php $st_total = 0; $st=''; @endphp
                            @foreach($banks as $bank)
                                <tr>
                                    <td> {{ $bank->id  }} </td>
                                    <td><a href="{{ route('admin.bank-report', $bank->id) }}" style="text-decoration: none"> <strong>{{ $bank->bank_name  }} ( {{ $bank->branch_name  }} )</strong><br> {{ $bank->ac_no  }} (Amount (Open) - <b>{{ $bank->amount }}</b>) </a></td>
                                    <td style="text-align: right !important;">
                                        @if($today!=$start_date)
                                            {{number_format($st = (\App\ClientPayment::where('bank_id', $bank->id)->where('payment_method','check')->wherebetween('date',[$start_date,$end_date])->sum('amount')+ \App\OtherLoanAdd::all()->where('bank_id',$bank->id)->wherebetween('date',[$start_date,$end_date])->where('payment_method','check')->sum('amount') +\App\BankLoanAdd::all()->where('bank_id',$bank->id)->wherebetween('date',[$start_date,$end_date])->where('payment_method','check')->sum('amount') +\App\InvestAdd::all()->wherebetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')  + \App\Deposit::where('bank_id', $bank->id)->wherebetween('date',[$start_date,$end_date])->sum('amount') + \App\Bank::all()->wherebetween('date',[$start_date,$end_date])->sum('amount')) + \App\BankTransfer::all()->wherebetween('date',[$start_date,$end_date])->where('to_bank_id', $bank->id)->sum('amount') - (\App\ProjectPayment::where('bank_id', $bank->id)->wherebetween('date',[$start_date,$end_date])->where('payment_method','check')->sum('amount')
                                            + \App\Widraw::where('bank_id', $bank->id)->wherebetween('date',[$start_date,$end_date])->sum('amount') + \App\InvestExpense::all()->wherebetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+\App\OtherLoanExpense::all()->wherebetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\BankLoanExpense::all()->wherebetween('date',[$start_date,$end_date])->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\BankTransfer::all()->wherebetween('date',[$start_date,$end_date])->where('form_bank_id', $bank->id)->sum('amount')), 2)}}
                                        @elseif($today=$start_date)
                                            {{number_format($st = (\App\ClientPayment::where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\OtherLoanAdd::all()->where('bank_id',$bank->id)->where('payment_method','check')->sum('amount') +\App\BankLoanAdd::all()->where('bank_id',$bank->id)->where('payment_method','check')->sum('amount') +\App\InvestAdd::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')  + \App\Deposit::where('bank_id', $bank->id)->sum('amount') + $bank->amount) + \App\BankTransfer::all()->where('to_bank_id', $bank->id)->sum('amount') - (\App\ProjectPayment::where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')
                                           + \App\Widraw::where('bank_id', $bank->id)->sum('amount') + \App\InvestExpense::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+\App\OtherLoanExpense::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\BankLoanExpense::all()->where('bank_id', $bank->id)->where('payment_method','check')->sum('amount')+ \App\BankTransfer::all()->where('form_bank_id', $bank->id)->sum('amount')), 2)}}
                                        @endif
                                        @php $st_total = $st_total + $st  ;@endphp
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2" class="text-right"> Total </th>
                                <th colspan="" style="text-align: right !important;"> {{ number_format($st_total,2) }} </th>

                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

