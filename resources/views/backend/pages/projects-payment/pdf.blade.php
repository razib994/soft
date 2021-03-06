    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2>Theme Engineer Ltd.</h2>
            <h5> Expenditure Summary Sheet <br>({{ $project->project_name }}  {{$project->project_address}}) ( @if($start_date != '') {{ $start_date }} @else {{ $start_date }} @endif - @if($end_date != '') {{ $end_date }} @else {{ $end_date }} @endif </h5>
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
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" cellpadding="0" id="dataTable" width="100%" cellspacing="0" border="1">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Category Name </th>
                                    <th> Item Name </th>
                                    <th> Date </th>
                                    <th style="text-align: right !important;">Amount</th>
                                    <th> Payment Method </th>
                                    <th> Note </th>

                                </tr>
                                </thead>


                                <tbody>
                                @php
                                    $i=1;
                                    $t =0;
                                    $a ='';
                                @endphp
                                @foreach($project_payments as $projectPayment)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                        @php $category =  \App\Category::where('id',$projectPayment->category_id )->get(); @endphp @foreach($category as $cat) {{ $cat->category_name }} @endforeach
                                        <!--{{ $projectPayment->category_id }} -->
                                        </td>
                                        <td> @php $items = \App\Item::where('id',$projectPayment->item_name )->get() @endphp @foreach($items as $item) {{ $item->items_name }} @endforeach </td>
                                        <td>{{ $projectPayment->date }}</td>
                                        <td style="text-align: right !important;">
                                                {{ number_format($to = $projectPayment->amount, 2) }}
                                            @php
                                                $fi_to = $fi_to + $to;
                                            @endphp

                                        </td>
                                        <td> @if( $projectPayment->payment_method == 'check') Cheque @elseif($projectPayment->payment_method == 'open') Opening Balance @else Cash @endif</td>
                                        <td>{{  $projectPayment->note }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="4">Total</th>
                                    <th colspan="3" style="text-align: right !important;"><strong class="text-danger"> {{ number_format( $fi_to,2) }} </strong></th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


