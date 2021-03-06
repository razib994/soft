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
                 $f_month =  date('F, Y', strtotime($end_date));
                 $f_month_s =  date('F, Y', strtotime($start_date));
            }
        @endphp
        <h1> Theme Engineer Ltd. </h1>
        <p> Balance Sheet (<b>{{$start_date}} - {{$end_date}} </b>)  </p>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cash Expenditure</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                            <thead>
                            <tr>
                                <th colspan="3" class="text-center"> Expenditure </th>
                            </tr>
                            <tr>
                                <th> Date </th>
                                <th> Item Name </th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $project_amount =''; $pro_t_amount = 0;
                                if($today != $start_date){
                                $projectPayments = \Illuminate\Support\Facades\DB::table('project_payments')->where('payment_method','cash')->whereBetween('date',[$start_date, $end_date])->get();
                                } elseif($today == $start_date) {
                                $projectPayments = \Illuminate\Support\Facades\DB::table('project_payments')->where('payment_method','cash')->get();
                                }
                            @endphp
                            @foreach($projectPayments as $projectPayment)
                                <tr>
                                    <td>{{ $projectPayment->date }} </td>
                                    <td> @php $items = \App\Item::where('id',$projectPayment->item_name )->get() @endphp @foreach($items as $item) {{ $item->items_name }} @endforeach </td>

                                    <td class="text-right"> {{  number_format($project_amount = $projectPayment->amount, 2) }}
                                        @php $pro_t_amount = $pro_t_amount + $project_amount; @endphp

                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2"> Total </th>
                                <th style="text-align: right;"> {{ number_format($pro_t_amount,2) }} </th>
                                <!--<th> </th>-->
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
                    <h6 class="m-0 font-weight-bold text-primary">Cash Collection</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                            <thead>
                            <tr>
                                <th colspan="3" class="text-center">Collection</th>
                            </tr>
                            <tr>

                                <th> Date </th>
                                <th> Client Name </th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $client_amount =''; $t_amount = 0;
                                if($today != $start_date){
                                $clientsPayment = \Illuminate\Support\Facades\DB::table('client_payments')->where('payment_method','cash')->whereBetween('date',[$start_date, $end_date])->get();
                                }elseif($today == $start_date) {
                                $clientsPayment = \Illuminate\Support\Facades\DB::table('client_payments')->where('payment_method','cash')->get();
                                }
                            @endphp
                            @foreach($clientsPayment as $clientPayment)
                                <tr>
                                    <td>{{ $clientPayment->date }}</td>
                                    <td> @php $client = \App\Client::where('id',$clientPayment->client_id )->get() @endphp @foreach($client as $client) {{ $client->client_name }} @endforeach </td>

                                    <td class="text-right">{{   number_format($client_amount = $clientPayment->amount, 2) }}
                                        @php $t_amount = $t_amount+$client_amount; @endphp
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="3"> Opening Cash </th>
                            </tr>
                            @php $client_amounts =''; $t_amounts = 0;
                                if($today != $start_date){
                                $cashes= \Illuminate\Support\Facades\DB::table('cashes')->whereBetween('created_at',[$start_date, $end_date])->get();
                                } elseif($today == $start_date) {
                                $cashes= \Illuminate\Support\Facades\DB::table('cashes')->get();
                                }
                            @endphp
                            @foreach($cashes as $cash)
                                <tr>
                                    <td>{{$cash->id }}</td>
                                    <td> {{ $cash->cash_name }} </td>

                                    <td class="text-right">{{   number_format($client_amounts = $cash->amount, 2) }}
                                        @php $t_amounts = $t_amounts+$client_amounts; @endphp
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2"> Invest Money </th>
                                <th class="text-right"> @if($today != $start_date)
                                        {{number_format($investadd = (\App\InvestAdd::all()->where('payment_method','cash')->whereBetween('date',[$start_date, $end_date])->sum('amount')) - (\App\InvestExpense::all()->where('payment_method','cash')->whereBetween('date',[$start_date, $end_date])->sum('amount')),2)}}
                                    @elseif($today == $start_date)
                                        {{number_format($investadd = (\App\InvestAdd::all()->where('payment_method','cash')->sum('amount')) - (\App\InvestExpense::all()->where('payment_method','cash')->sum('amount')),2)}}
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"> Loan </th>
                                <th class="text-right"> @if($today != $start_date)
                                        {{number_format($loanadd = \App\OtherLoanAdd::all()->where('payment_method','cash')->whereBetween('date',[$start_date, $end_date])->sum('amount')-\App\OtherLoanExpense::all()->where('payment_method','cash')->whereBetween('date',[$start_date, $end_date])->sum('amount') ,2)}}
                                    @elseif($today == $start_date)
                                        {{number_format($loanadd = \App\OtherLoanAdd::all()->where('payment_method','cash')->sum('amount')-\App\OtherLoanExpense::all()->where('payment_method','cash')->sum('amount') ,2)}}
                                    @endif
                                </th>
                            </tr>

                            <tr>
                                <th colspan="3"> Withdraw </th>
                            </tr>
                            @php $client_amountsd =''; $t_amountsd = 0;
                                if($today != $start_date) {
                                $widthras = \Illuminate\Support\Facades\DB::table('widraws')->whereBetween('date',[$start_date, $end_date])->get();
                                } elseif($today == $start_date) {
                                $widthras = \Illuminate\Support\Facades\DB::table('widraws')->get();
                                }
                            @endphp
                            @foreach($widthras as $withdraw)
                                <tr>
                                    <td>{{ $withdraw->date }}</td>
                                    <td>{{$withdraw->branch_name}} </td>

                                    <td class="text-right">{{   number_format($client_amountsd = $withdraw->amount, 2) }}
                                        @php $t_amountsd = $t_amountsd+$client_amountsd; @endphp
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="3"> Deposit </th>
                            </tr>
                            @php $client_deposit =''; $t_deposit = 0;
                                if($today != $start_date) {
                                $deposits = \Illuminate\Support\Facades\DB::table('deposits')->whereBetween('date',[$start_date, $end_date])->get();
                                }elseif($today == $start_date) {
                                $deposits = \Illuminate\Support\Facades\DB::table('deposits')->get();
                                }
                            @endphp
                            @foreach($deposits as $deposit)
                                <tr>
                                    <td>{{ $deposit->date }}</td>
                                    <td>{{$deposit->branch_name}} </td>

                                    <td style="text-align: right;">{{   number_format($client_deposit = $deposit->amount, 2) }}
                                        @php $t_deposit = $t_deposit+$client_deposit; @endphp
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2"> Total </th>
                                <th class="text-right"> {{ number_format(($t_amount+$loanadd+$t_amounts+$investadd+$t_amountsd)-$t_deposit ,2) }} </th>
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
                        <th style="text-align: right;">{{number_format((($t_amount+$loanadd+$t_amounts+$t_amountsd+$investadd)-$t_deposit) - $pro_t_amount,2)}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>

