<style>
    tr th {
        font-size: 9px;
    }
    tr td {
        font-size: 9px;
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
    <h3> Theme Engineer Ltd. </h3>
    <p style="margin-top:-10px;"> Project Expenditure (<b>{{$f_month_s}}  </b>)  </p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                    <thead>
                    <tr class="bg-success text-white">
                        <td> Item Name </td>
                        <td style="text-align: right !important;"> Cash </td>
                        <td style="text-align: right !important;"> Cheque </td>

                        <td style="text-align: right !important;"> Total </td>
                        <td style="text-align: right !important;"> Up to Prev Month </td>
                        <td style="text-align: right !important;"> Net Amount </td>
                    </tr>
                    </thead>
                    <?php $total = 0; $to = 0;
                    $net=0; $nets=''; $check=0;  $checks =''; $cashs = '';
                    $cash =0; $net=''; $t_nes =0; $opens=''; $privies=''; $t_pre=0; $opensd='';
                    $checks_date=''; $c_final=0; $cashs_date=''; $cash_f = 0;

                    ?>

                    <tbody>
                    @foreach($categories_main as $category_m)
                        <tr style="background: #eee;" >
                            <th colspan="6">
                                <strong >{{ $category_m->category_name }} </strong>
                            </th>
                        </tr>
                        <?php $items = \App\Item::where('category_id', $category_m->id)->get()?>
                        @foreach($items as $item)
                            <tr>
                                <td> {{ $item->items_name }}</td>
                                <td style="text-align: right !important;">
                                    @if($today!=$start_date)
                                        @php number_format($cashs_date = \App\ProjectPayment::where('item_name',$item->id)->whereDate('date','<',$start_date)->where('payment_method','cash')->where('project_id', $project->id)->sum('amount'),2) @endphp

                                        {{ number_format($cashs = \App\ProjectPayment::where('item_name',$item->id)->whereBetween('date',[$start_date,$end_date])->where('payment_method','cash')->where('project_id', $project->id)->sum('amount'),2) }}
                                    @elseif($today=$start_date)
                                        @php $cashs_date=0 @endphp
                                        {{ number_format($cashs = \App\ProjectPayment::where('item_name',$item->id)->where('payment_method','cash')->where('project_id', $project->id)->sum('amount'),2) }}

                                    @endif
                                </td>
                                <td style="text-align: right !important;">
                                    @if($today!=$start_date)
                                        @php number_format($checks_date = \App\ProjectPayment::where('item_name',$item->id)->whereDate('date','<',$start_date)->where('payment_method','check')->where('project_id', $project->id)->sum('amount'),2) @endphp

                                        {{  number_format($checks = \App\ProjectPayment::where('item_name',$item->id)->whereBetween('date',[$start_date,$end_date])->where('payment_method','check')->where('project_id', $project->id)->sum('amount'),2) }}
                                    @elseif($today=$start_date)
                                        @php $checks_date=0 @endphp
                                        {{  number_format($checks = \App\ProjectPayment::where('item_name',$item->id)->where('payment_method','check')->where('project_id', $project->id)->sum('amount'),2) }}
                                    @endif



                                </td>

                                <td style="text-align: right !important;">{{ number_format(($checks + $cashs),2) }}
                                    @if($today!=$start_date)
                                        @php  number_format($opens = \App\ProjectPayment::where('item_name',$item->id)->whereBetween('date',[$start_date,$end_date])->where('payment_method','open')->where('project_id', $project->id)->sum('amount'),2) @endphp
                                        @php  number_format($opensd = \App\ProjectPayment::where('item_name',$item->id)->whereDate('date','<=',$start_date)->where('payment_method','open')->where('project_id', $project->id)->sum('amount'),2) @endphp
                                    @elseif($today=$start_date)
                                        @php  number_format($opens = \App\ProjectPayment::where('item_name',$item->id)->where('payment_method','open')->where('project_id', $project->id)->sum('amount'),2) @endphp
                                    @endif
                                </td>
                                <td style="text-align: right !important;">



                                    {{ number_format($privies = \App\ProjectPayment::where('item_name',$item->id)->whereDate('date','<=',$start_date)->where('project_id', $project->id)->sum('amount'),2) }}

                                </td>
                                <td style="text-align: right !important;">
                                    @if($today!=$start_date)
                                        {{ number_format($net = (($checks+$cashs+ $opens)+$privies),2) }}
                                    @elseif($today=$start_date)
                                        {{ number_format($net = ($checks+$cashs+ $opens),2) }}
                                    @endif

                                </td>
                            </tr>

                            <?php

                            $check = $check + $checks;
                            $cash = $cash + $cashs;
                            $t_nes = $t_nes + $net;
                            $t_pre = $t_pre + $privies;
                            $c_final =$c_final + $checks_date;
                            $cash_f = $cash_f+$cashs_date;
                            ?>
                        @endforeach

                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th> Total </th>

                        <th style="text-align: right !important;"> {{ number_format(($cash),2) }} </th>
                        <th style="text-align: right !important;"> {{ number_format(($check),2) }} </th>
                        <th style="text-align: right !important;"> {{ number_format($check + $cash,2) }}</th>
                        <th style="text-align: right !important;"> {{ number_format($t_pre,2) }}</th>
                        <th style="text-align: right !important;"><strong> {{ number_format($t_nes,2) }}  </strong></th>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>

