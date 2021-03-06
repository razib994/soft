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
    <p> Bank Loan (<b>{{$f_month_s}} - {{$f_month}} </b>)  </p>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th> Name </th>
                            {{--                            <th>Date </th>--}}
                            <th>Amount </th>

                        </tr>
                        </thead>

                        <tbody>
                        @php $i = ''; $it = 0;@endphp
                        @foreach($bankloans as $bankloan)
                            <tr>
                                <td> {{ $bankloan->id }}</td>
                                <td  style="text-align: center !important;"> {{ $bankloan->investor_name }}</td>
                                {{--                            <td> {{ $bankloan->date }}</td>--}}
                                <td  style="text-align: right !important;">
                                    @if($today != $start_date)
                                        {{ number_format( $i = (\App\BankLoanAdd::all()->where('investor_id',$bankloan->id)->whereBetween('date',[$start_date,$end_date])->sum('amount')) - (\App\BankLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->where('investor_id',$bankloan->id)->sum('amount')) ,2) }}
                                    @elseif($today=$start_date)
                                        {{ number_format( $i = (\App\BankLoanAdd::all()->where('investor_id',$bankloan->id)->sum('amount')) - (\App\BankLoanExpense::all()->where('investor_id',$bankloan->id)->sum('amount')) ,2) }}
                                    @endif
                                </td>
                                @php $it = $i + $it ;@endphp

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="2" class="text-right"> Total </th>
                            <th colspan="" style="text-align: right !important;"> {{number_format($it,2)}} </th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


