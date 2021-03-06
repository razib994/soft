<style>
    tr td {
        font-size: 11px;
    }
    tr th {
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
        <p> Bank Report (<b>{{$f_month_s}} - {{$f_month}} </b>)  </p>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="h3 mb-0 text-gray-800">{{ $banks->bank_name }}</h4>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-6" >
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
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
            <br>
            <div class="col-md-6 col-lg-6 col-sm-6 " >
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
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

