@extends('backend.layouts.master')
@section('title')
    Project Information
@endsection
@section('content')

    <div class="container-fluid">
    {{--        @if (Session::has('message'))--}}
    {{--            <div class="alert alert-success">--}}
    {{--                <div>--}}
    {{--                    <p>{{ Session::get('message') }}</p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--    @endif--}}
    <!-- Page Heading -->
        {{--        <div class="d-sm-flex align-items-center justify-content-between mb-4">--}}
        {{--            <h1 class="h3 mb-0 text-gray-800">{{ $project->project_name }} </h1>--}}
        {{--            <a href="{{ route('projects.payments', $project->id)}}" class="d-none d-sm-inline-block float-right btn btn-sm btn-success shadow-sm"><i--}}
        {{--                    class="fas fa-eye fa-sm text-white-50"></i> Projects Payment Details List </a>--}}
        {{--            <a href="{{ route('projects.created', $project->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i--}}
        {{--                    class="fas fa-plus fa-sm text-white-50"></i> Create Project Amount </a>--}}
        {{--        </div>--}}
        <div class="row">
            <div class="col-md-6"><h1 class="h3 mb-0 text-gray-800">{{ $project->project_name }}  </h1></div>
            <div class="col-md-6 mb-2 text-right">
{{--                <form>--}}
{{--                    <div class="form-row align-items-center">--}}
{{--                        <div class="col-auto">--}}
{{--                            <input type="date" class="form-control " id="inlineFormInput" placeholder="Jane Doe">--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <input type="date" class="form-control" id="inlineFormInputGroup" placeholder="Username">--}}

{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <button type="submit" class="btn btn-primary">Report</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{ route('admin.client_pdfs',$project->id) }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
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
                <table class="table table-striped table-bordered">

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
@endsection
