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
              $f_month =  date('F, Y', strtotime($end_date));
              $f_month_s =  date('F, Y', strtotime($start_date));
         }
     @endphp
     <h1> Theme Engineer Ltd. </h1>
     <p> Expenditure Summery (<b>{{$f_month_s}} - {{$f_month}} </b>)  </p>
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
                            <th> Cash Exp. </th>
                            <th> Bank Exp. </th>
                            <th width="20%">Total</th>
                        </tr>
                        </thead>
                        <?php $total = 0; $to = 0; $final =0; $fin=''; $ck=''; $ca='';

                        ?>

                        <tbody>

                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td><a class="text-primary" style=" text-decoration:none;" href="{{route('projects.indivisual_Report', $project->id)}}"> <b>{{ $project->project_name }} ({{ $project->project_address }}) </b></a> </td>
                                <td>
                                    @if($today != $start_date)
                                        {{  number_format($ca = \App\ProjectPayment::where('project_id', $project->id)->where('payment_method', 'cash')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2) }}
                                        <?php $total = $total + $ca ;?>
                                    @elseif($today == $start_date)
                                        {{  number_format($ca = \App\ProjectPayment::where('project_id', $project->id)->where('payment_method', 'cash')->sum('amount'),2) }}
                                        <?php $total = $total + $ca;?>
                                    @endif
                                </td>
                                <td>
                                    @if($today != $start_date)
                                        {{ number_format($ck = \App\ProjectPayment::where('project_id', $project->id)->where('payment_method', 'check')->whereBetween('date',[$start_date,$end_date])->sum('amount'),2) }}
                                        <?php $to = $to + $ck; ?>
                                    @elseif($today == $start_date)
                                        {{ number_format($ck =\App\ProjectPayment::where('project_id', $project->id)->where('payment_method', 'check')->sum('amount'),2) }}
                                        <?php $to = $to +$ck; ?>
                                    @endif

                                </td>
                                <td>
                                    {{  number_format($ca + $ck,2) }}

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th> </th>
                            <th></th>
                            <th> {{ number_format($total,2) }}</th>
                            <th> {{ number_format($to,2) }} </th>
                            <th width="20%">{{ number_format($total + $to,2)  }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


