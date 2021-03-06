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
    <p> Bank Loan Add (<b>{{$f_month_s}} - {{$f_month}} </b>)  </p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Bank Name</th>
                            <th>Cheque No</th>
                            <th>Date</th>
                            <th style="text-align: right !important;">Amount</th>
                            <th>Payment Method</th>
                            <th>Note</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $in=''; $in_t = 0; @endphp
                        @foreach($bankloan_adds as $bankloan_add)
                            <tr>
                                <td> {{ $bankloan_add->id }}</td>
                                <td>@php $banks = \App\Bank::where('id',$bankloan_add->bank_id)->get();@endphp @foreach($banks as $bank) {{ $bank->bank_name }} @endforeach </td>
                                <td> {{ $bankloan_add->check_no }}</td>
                                <td> {{ $bankloan_add->date }}</td>
                                <td style="text-align: right !important;"> {{ number_format($in = $bankloan_add->amount,2) }} @php $in_t =$in_t+$in;  @endphp</td>
                                <td> @if($bankloan_add->payment_method =='check') Cheque @elseif($bankloan_add->payment_method =='cash') Cash @else Opening Balance @endif</td>
                                <td> {{ $bankloan_add->note }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4" class="text-right"> Total </th>
                            <th colspan="" style="text-align: right !important;"> {{number_format($in_t,2) }} </th>
                            <th colspan="2">  </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

