<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2>Theme Engineer Ltd.</h2>
        <h5>  Collection Amount <br>({{ $client->client_name }}) <br>
            @php
            $pros = \App\Project::where('id', $client->project_id)->get();
            @endphp
            @foreach($pros as $pro) {{ $pro->project_name }} @endforeach
                        ( @if($start_date != '') {{ $start_date }} @else {{ $start_date }} @endif - @if($end_date != '') {{ $end_date }} @else {{ $end_date }} @endif </h5>
    </div>
    <style>
        tr th {
            font-size: 11px;
        }
        tr td {
            font-size: 11px;
        }
    </style>

@php
    $today =  date("Y-m-d");
$fi_to=0; $to='';
@endphp
<!-- DataTales Example -->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th> Sl </th>
                            <th> Client Name </th>
                            <th> Date </th>
                            <th style="text-align: right !important;"> Amount </th>
                            <th> Payment Method </th>
                            <th> Note </th>

                        </tr>
                        </thead>


                        <tbody>
                        {{--                        @foreach($client->clientPayments as $clientPayment)--}}
                        @foreach($client_payments as $clientPayment)
                            <tr>
                                <td>{{ $clientPayment->id  }}</td>
                                <td>{{ $client->client_name  }}</td>
                                <td>{{ $clientPayment->date  }}</td>
                                <td style="text-align: right !important;">

                                        {{ number_format( $to = $clientPayment->amount, 2)  }}

                                    @php
                                        $fi_to = $fi_to + $to;
                                    @endphp
                                </td>
                                <td> @if( $clientPayment->payment_method == 'check') Cheque @elseif($clientPayment->payment_method == 'open') Opening Balance @elseif($clientPayment->payment_method == 'refund') Refund @else Cash @endif</td>
                                <td>{{ $clientPayment->note  }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3"> Total </th>
                            <th colspan="3" style="text-align: right !important;"> <strong class="text-danger">

                                    {{ number_format($fi_to,2)  }}
                                </strong></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

