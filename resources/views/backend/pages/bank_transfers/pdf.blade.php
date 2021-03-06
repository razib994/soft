    <div class="container-fluid">
        <h4> Theme Engineer Ltd. </h4>
        <p> Bank Transfer </p>
        <style>
            tr th {
                font-size: 11px;
            }
            tr td {
                font-size: 11px;
            }
        </style>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>From Bank Name </th>
                            <th>To Bank Name </th>
                            <th> Date </th>
                            <th>Amount</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $st_total = 0; $st=''; @endphp
                        @foreach($bank_transfers as $bank_transfer)
                            <tr>
                                <td> {{ $bank_transfer->id  }} </td>
                                <td> @foreach($banks as $bank) @if($bank->id == $bank_transfer->form_bank_id) {{$bank->bank_name}} @endif @endforeach </td>
                                <td> @foreach($banks as $bank) @if($bank->id == $bank_transfer->to_bank_id) {{$bank->bank_name}} @endif @endforeach </td>
                                <td> {{ $bank_transfer->date  }} </td>
                                <td class="text-right">{{ $bank_transfer->amount  }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4" class="text-right"> Total </th>
                            <th colspan="" class="text-right"> {{ number_format($st_total,2) }} </th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
