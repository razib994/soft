    <div class="container-fluid">
        <h4> Theme Engineer Ltd. </h4>
        <p> Other Loan  </p>
        <!-- DataTales Example -->
        <style>
            tr th {
                font-size: 11px;
            }
            tr td {
                font-size: 11px;
            }
        </style>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th> Name </th>
                            <th>Date </th>
                            <th>Amount</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = ''; $it = 0;@endphp
                        @foreach($othersloans as $othersloan)
                            <tr>
                                <td> {{ $othersloan->id }}</td>
                                <td> {{ $othersloan->purpose_name }}</td>
                                <td> {{ $othersloan->date }}</td>
                                <td class="text-right">{{ number_format($i = ($othersloan->amount + \App\OtherLoanAdd::all()->where('id',$othersloan->id)->sum('amount'))-\App\OtherLoanExpense::all()->where('id',$othersloan->id)->sum('amount'),2) }} @php $it =$it +$i; @endphp</td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3" class="text-right"> Total </th>
                            <th colspan="" class="text-right"> {{number_format($it,2)}} </th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
