<style>
    tr th {
        font-size: 10px;
    }
    tr td {
        font-size: 10px;
    }

</style>
<div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $project->project_name }} ({{ $project->project_address }})</h6>
                    </div>
                    <div class="col-md-9">

                    </div>
                </div>


            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" width="100%" cellspacing="0" border="1">

                    <thead>

                    <tr class="bg-success text-white">
                        <td> Sl </td>
                        <td> Name </td>
                        <td> Phone </td>
                        <td> Address </td>
                        <td> Floor </td>
                        <td> Apartment </td>
                        <td> Contact Amount </td>
                        <td> Pay Amount </td>
                        <td> Due Amount </td>
                    </tr>
                    </thead>

                    <tbody>
                    @php $tn=0; $net=''; $t_net=''; $t_a=0; $i=1; @endphp
                    @foreach($clients as $client)


                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> <a href="{{route('clients.payments', $client->id)}}" style="text-decoration:none; font-weight:bold;">{{ $client->client_name }} </a> </td>
                            <td> {{ $client->phone }}  </td>
                            <td> {{ $client->address }}  </td>
                            <td> {{ $client->floor }}  </td>
                            <td> {{ $client->apartment }}  </td>
                            <td style="text-align: right;"> {{ number_format( $t_net = $client->amount, 2) }}
                                @php
                                    $t_a = $t_a+$t_net;
                                @endphp
                            </td>
                            <td style="text-align: right;"> {{  number_format($net = \App\ClientPayment::all()->where('client_id',$client->id)->sum('amount'),2) }}
                                @php
                                    $tn = $tn+$net;
                                @endphp
                            </td>
                            <td style="text-align: right;"> {{ number_format($t_net - $net,2)  }}  </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <td colspan="6"> Total </td>
                    <td style="text-align: right;">
                        <strong class="text-danger" > {{ number_format($t_a,2)}} </strong>
                    </td>
                    <td style="text-align: right;">
                        <strong class="text-danger"> {{ number_format($tn,2)}} </strong>
                    </td>
                    <td style="text-align: right;">
                        <strong class="text-danger"> {{ number_format($t_a-$tn,2)}} </strong>
                    </td>


                    </tfoot>

                </table>
            </div>
        </div>
    </div>

