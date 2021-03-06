<div class="container-fluid">
    @php
        $final_date ='';
        $today =  date("Y-m-d");
        if($today == $start_date) {
            echo '';
        }else {
            $final_date = $start_date.'-'.$end_date;
             $f_month =  date('F, Y', strtotime($end_date));
             $f_month_s =  date('F, Y', strtotime($start_date));
        }
    @endphp
    <h1> Theme Engineer Ltd. </h1>
    <p> Balance Sheet (<b>{{$start_date}} - {{$end_date}} </b>)  </p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
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

