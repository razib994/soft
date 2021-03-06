@extends('backend.layouts.master')
@section('title')
    Project Wise Client Report
@endsection
@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Project Wise Client Report </h1>

        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                {{--                <a href="{{url('admin/final-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{url('admin/final-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{route('admin.client-report-pdf')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Project Wise Client Report </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th> Sl</th>
                            <th> Project Name</th>
                            <th> Project Address </th>
                            <th> Date </th>
                            <th> Total Amount </th>

                        </tr>
                        </thead>

                        <tbody>
                        @php $af =0;  $a =''; @endphp
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td><a class="text-primary" style=" text-decoration:none;" href="{{route('projects.clients_Report', $project->id)}}"> <b>{{ $project->project_name }} </b></a> </td>
                                <td>{{ $project->project_address }}</td>
                                <td>{{ $project->date }}</td>
                                <td>{{ number_format($a = \App\ProjectPayment::all()->where('project_id',$project->id)->sum('amount'),2) }}</td>
                                    @php $af=$af+$a @endphp
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th> Sl</th>
                            <th> Project Name</th>
                            <th> Project Address </th>
                            <th> Date</th>
                            <th> {{ number_format($af, 2) }}</th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
