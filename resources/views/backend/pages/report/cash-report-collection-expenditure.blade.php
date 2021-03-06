@extends('backend.layouts.master')
@section('title')
    Expenditure & Collection Cash Report
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cash Report</h1>
           <div class="row">
               @php
                   $today =  date("Y-m-d");
               @endphp
                    <div class="col-md-12">
                        <form action="{{url('admin/collection-report-cash')}}" method="get">
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
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                {{--                <a href="{{url('admin/final-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{url('admin/final-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{route('admin.cash-pdf',[$start_date, $end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">

                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    @if(Auth::guard('admin')->user()->can('role.view'))
                                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                            Expenditure </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @if($today != $start_date)
                                            {{  number_format($project_amount=\Illuminate\Support\Facades\DB::table('project_payments')->whereBetween('date',[$start_date,$end_date])->where('payment_method','cash')->sum('amount'), 2) }}
                                            @elseif($today == $start_date)
                                                {{  number_format($project_amount=\Illuminate\Support\Facades\DB::table('project_payments')->where('payment_method','cash')->sum('amount'), 2) }}
                                                @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    @if(Auth::guard('admin')->user()->can('role.view'))
                                        <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                                            Collection </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @if($today != $start_date)
                                            {{ number_format(  ((\Illuminate\Support\Facades\DB::table('client_payments')->whereBetween('date',[$start_date,$end_date])->where('payment_method','cash')->sum('amount') + \Illuminate\Support\Facades\DB::table('cashes')->whereBetween('created_at',[$start_date,$end_date])->sum('amount')+\App\OtherLoanAdd::all()->whereBetween('date',[$start_date,$end_date])->where('payment_method','cash')->sum('amount')) + \Illuminate\Support\Facades\DB::table('widraws')->whereBetween('date',[$start_date,$end_date])->sum('amount')+\App\InvestAdd::all()->whereBetween('date',[$start_date,$end_date])->where('payment_method','cash')->sum('amount'))- (\Illuminate\Support\Facades\DB::table('deposits')->whereBetween('date',[$start_date,$end_date])->sum('amount')+ \App\OtherLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->where('payment_method','cash')->sum('amount') +\App\InvestExpense::all()->whereBetween('date',[$start_date,$end_date])->where('payment_method','cash')->sum('amount')),2)  }}
                                            @elseif($today == $start_date)
                                            {{ number_format(  ((\Illuminate\Support\Facades\DB::table('client_payments')->where('payment_method','cash')->sum('amount') + \Illuminate\Support\Facades\DB::table('cashes')->sum('amount')+\App\OtherLoanAdd::all()->where('payment_method','cash')->sum('amount')) + \Illuminate\Support\Facades\DB::table('widraws')->sum('amount')+\App\InvestAdd::all()->where('payment_method','cash')->sum('amount'))- (\Illuminate\Support\Facades\DB::table('deposits')->sum('amount')+ \App\OtherLoanExpense::all()->where('payment_method','cash')->sum('amount') +\App\InvestExpense::all()->where('payment_method','cash')->sum('amount')),2)  }}
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cash Expenditure</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th colspan="4" class="text-center"> Expenditure </th>
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
                                    <th class="text-right"> {{ number_format($pro_t_amount,2) }} </th>
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
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th colspan="4" class="text-center">Collection</th>
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

                                        <td class="text-right">{{   number_format($client_deposit = $deposit->amount, 2) }}
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">Balance</th>
                            <th class="text-center">{{number_format((($t_amount+$loanadd+$t_amounts+$t_amountsd+$investadd)-$t_deposit) - $pro_t_amount,2)}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>





    </div>
    <!-- /.container-fluid -->
@endsection
