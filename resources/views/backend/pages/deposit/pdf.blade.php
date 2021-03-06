 <h4>Theme Engneer Ltd.</h4>
 <p> Deposit Amount </p>

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
     
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Bank Name </th>
                            <th>Check No </th>
                            <th>Date</th>
                            <th>Branch Name </th>
                            <th> Check Image </th>
                            <th> Deposit Name </th>
                            <th> Amount </th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        @php $total = 0;  $t =''; @endphp
                    @foreach($deposits as $deposit)
                        <tr>
                            <td> {{ $deposit->id }} </td>
                            <td> {{ $deposit->bank->bank_name }} </td>
                            <td> {{ $deposit->checkno }} </td>
                            <td> {{ $deposit->date }} </td>
                            <td> {{ $deposit->branch_name }} </td>
                            <td> <img src="{{ $deposit->check_image }}" /> </td>
                            <td> {{ $deposit->depositers_name }} </td>
                            <td> {{ number_format($t = $deposit->amount, 2) }} </td>
                            @php $total = $total + $t;@endphp
                           
                        </tr>
                    @endforeach
                        </tbody>
                      
                    </table>
                </div>
            </div>
        </div>
    </div>
