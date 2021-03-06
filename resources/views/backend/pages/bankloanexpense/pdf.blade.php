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
    <p> Bank Loan Expense (<b>{{$f_month_s}} - {{$f_month}} </b>)  </p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Bank Loan Refund List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Bank Name</th>
                            <th>Cheque No</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Note</th>

                        </tr>
                        </thead>

                        <tbody>
                        @php $in=''; $in_t = 0; @endphp
                        @foreach($bankloandexpense as $bankloandexpenses)
                            <tr>
                                <td> {{ $bankloandexpenses->id }}</td>
                                <td>@php $banks = \App\Bank::where('id',$bankloandexpenses->bank_id)->get();@endphp @foreach($banks as $bank) {{ $bank->bank_name }} @endforeach </td>
                                <td> {{ $bankloandexpenses->check_no }}</td>
                                <td> {{ $bankloandexpenses->date }}</td>
                                <td class="text-right"> {{ number_format($in = $bankloandexpenses->amount,2) }} @php $in_t =$in_t+$in;  @endphp</td>
                                <td> @if($bankloandexpenses->payment_method =='check') Cheque @elseif($bankloandexpenses->payment_method =='cash') Cash @else Opening Balance @endif</td>
                                <td> {{ $bankloandexpenses->note }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4" class="text-right"> Total </th>
                            <th colspan="" class="text-right"> {{number_format($in_t,2) }} </th>
                            <th colspan="2">  </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
