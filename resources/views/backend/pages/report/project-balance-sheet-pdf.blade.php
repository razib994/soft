<h4> Theme Engineer Ltd. </h4>
<p> Project Balance Sheet</p>
<div class="container-fluid">
    <style>
        th {
            font-size: 11px;
        }
        td {
            font-size: 11px;
        }
    </style>

        @php
            $today =  date("Y-m-d");
        @endphp
        <!-- DataTales Example -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                            <thead>
                            <tr>
                                <th> Sl</th>
                                <th> Project Name</th>
                                <th> E. This Month </th>
                                <th> E. upto Prev Month </th>
                                <th> E. Upto Date </th>
                                <th> C. This Month </th>
                                <th> upto prev.Month </th>
                                <th> C. Upto Date </th>
                                <th> Refund </th>
                                <th> Net Colloection </th>
                                <th width="20%">Balance</th>
                            </tr>
                            </thead>
                            <?php $up_e_m= '';
                            $up_e_m_value = 0; $up_e_t ='';
                            $up_e_t_value =0; $ref =0; $refund ='';
                            $cthis =''; $client_p =is_numeric (0);
                            $new =0;
                            $new_collection ='';
                            $t_main =''; $t_mains= is_numeric (0);
                            $refunds=''; $refund = 0; $u_final=0; $u_t_final=0; $u_ex_final=0;

                            ?>

                            <tbody>
                            @php

                                $main_up_e_m=0; $main_up_e_t=0; $cm=0; $cu=0; $cud = 0; $f_refunds =0; $net_finaled =0; $net_balnce =0;
                            @endphp
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td><a class="text-primary" style=" text-decoration:none;" href="{{route('projects.indivisual_Report', $project->id)}}"> <b>{{ $project->project_name }} ({{ $project->project_address }}) </b></a> </td>

                                    <td style="text-align: right;">
                                        @if( $today != $start_date )

                                            {{ number_format($up_e_m = \App\ProjectPayment::where('project_id',$project->id)->whereBetween('date',[$start_date,$end_date])->sum('amount'),2) }}
                                        @elseif($today = $start_date)
                                            {{ number_format($up_e_m = \App\ProjectPayment::where('project_id',$project->id)->sum('amount'),2) }}
                                        @endif
                                        @php $u_final = $u_final+$up_e_m;@endphp

                                    </td>
                                    <td style="text-align: right;">
                                        @if( $today != $start_date )

                                            {{ number_format($up_e_t = \App\ProjectPayment::where('project_id',$project->id)->whereDate('date','<=',$start_date)->sum('amount'),2) }}
                                        @elseif($today = $start_date)
                                            {{ number_format($up_e_t = \App\ProjectPayment::where('project_id',$project->id)->sum('amount'),2) }}

                                        @endif
                                        @php $u_t_final = $u_t_final+$up_e_t;@endphp
                                    </td>
                                    <td style="text-align: right;">
                                        @if( $today != $start_date )
                                            {{ number_format($final_net = $up_e_m + $up_e_t,2) }}
                                        @elseif($today = $start_date)
                                            {{ number_format($final_net =$up_e_m ,2) }}
                                        @endif

                                        @php $u_ex_final = $u_ex_final+$final_net;@endphp
                                    </td>



                                    <td style="text-align: right;">
                                        @if( $today != $start_date )

                                            @php $c1='';  $clients = \Illuminate\Support\Facades\DB::table('clients')->where('project_id',$project->id)->get(); $c_f=0; @endphp @foreach($clients as $client) @php $c1=(\App\ClientPayment::where('client_id', $client->id)->whereBetween('date',[$start_date,$end_date])->sum('amount') ); @endphp  @php $c_f = $c_f+$c1; @endphp @endforeach {{number_format($c_f,2)}}
                                        @elseif($today = $start_date)
                                            @php $c1='';  $clients = \Illuminate\Support\Facades\DB::table('clients')->where('project_id',$project->id)->get(); $c_f=0; @endphp @foreach($clients as $client) @php $c1=(\App\ClientPayment::where('client_id', $client->id)->sum('amount')); @endphp  @php $c_f = $c_f+$c1; @endphp @endforeach {{number_format($c_f,2)}}

                                        @endif
                                        @php $cm = $cm+$c_f;@endphp
                                    </td>
                                    <td style="text-align: right;">
                                        @if( $today != $start_date )

                                            @php $c2='';  $clients = \Illuminate\Support\Facades\DB::table('clients')->where('project_id',$project->id)->get(); $c2_f=0; @endphp @foreach($clients as $client) @php $c2=(\App\ClientPayment::where('client_id', $client->id)->whereDate('date','<=',$start_date)->sum('amount') ); @endphp  @php $c2_f = $c2_f+$c2; @endphp @endforeach {{number_format($c2_f,2)}}
                                        @elseif($today = $start_date)
                                            @php $c2='';  $clients = \Illuminate\Support\Facades\DB::table('clients')->where('project_id',$project->id)->get(); $c2_f=0; @endphp @foreach($clients as $client) @php $c2=(\App\ClientPayment::where('client_id', $client->id)->sum('amount')); @endphp  @php $c2_f = $c2_f+$c2; @endphp @endforeach {{number_format($c2_f,2)}}

                                        @endif

                                        @php $cu = $cu+$c2_f;@endphp
                                    </td>
                                    <td style="text-align: right;">
                                        {{number_format($c2_f  + $c_f,2)}}
                                        @php $cud = $cud+($c2_f  + $c_f);@endphp
                                    </td>
                                    <td style="text-align: right;">
                                        @if( $today != $start_date )
                                            @php $r1='';  $clients = \Illuminate\Support\Facades\DB::table('clients')->where('project_id',$project->id)->get(); $r_f=0; @endphp @foreach($clients as $client) @php $r1=(\App\ClientPayment::where('client_id', $client->id)->whereBetween('date',[$start_date,$end_date])->where('payment_method', 'refund')->sum('amount') ); @endphp  @php $r_f = $r_f+$r1; @endphp @endforeach {{number_format($r_f,2) }}
                                        @elseif($today = $start_date)
                                            @php $r1='';  $clients = \Illuminate\Support\Facades\DB::table('clients')->where('project_id',$project->id)->get(); $r_f=0; @endphp @foreach($clients as $client) @php $r1=(\App\ClientPayment::where('client_id', $client->id)->where('payment_method', 'refund')->sum('amount')); @endphp  @php $r_f = $r_f+$r1; @endphp @endforeach {{number_format($r_f,2) }}
                                        @endif
                                        @php $f_refunds = $f_refunds+$r_f;@endphp
                                    </td>
                                    <td style="text-align: right;">{{number_format(($c2_f  + $c_f)-$r_f,2)}} @php $net_finaled = $net_finaled+(($c2_f  + $c_f)-$r_f);@endphp</td>
                                    <td style="text-align: right;">{{number_format((($c2_f  + $c_f)-$r_f) -$up_e_t,2)}} @php $net_balnce = $net_balnce+((($c2_f  + $c_f)-$r_f) -$up_e_t);@endphp</td>


                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2" class="text-right text-danger"> <b>Total</b> </td>
                                <td style="text-align: right;"><strong>{{number_format($u_final,2)}} </strong></td>
                                <td style="text-align: right;"><strong>{{number_format($u_t_final,2)}} </strong></td>

                                <td style="text-align: right;"><strong>{{ number_format($u_ex_final,2) }}</strong></td>
                                <td style="text-align: right;"><strong>{{ number_format($cm,2) }}</strong></td>
                                <td style="text-align: right;"><strong>{{ number_format($cu,2) }}</strong></td>
                                <td style="text-align: right;"><strong>{{ number_format($cud,2) }}</strong></td>
                                <td style="text-align: right;"><strong>{{ number_format($f_refunds,2) }}</strong></td>
                                <td style="text-align: right;"><strong>{{ number_format($net_finaled,2) }}</strong></td>
                                <td style="text-align: right;"><strong>{{ number_format($net_balnce,2) }}</strong></td>

                            </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>


