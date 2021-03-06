@extends('backend.layouts.master')
@section('title')
    Project List
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
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Projects</h1>
            @if(Auth::guard('admin')->user()->can('project.create'))
            <a href="{{ route('projects.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Projects </a>
            @endif
        </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 mb-2 text-right">
{{--            <a href="{{url('admin/export-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
            <a href="{{url('admin/export-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
            <a href="{{url('admin/project-pdf')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
        </div>
    </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Projects List </h6>
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
                            <th> Amount </th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th> Sl</th>
                            <th> Project Name</th>
                            <th> Project Address </th>
                            <th> Date </th>
                            <th style="text-align: right !important;"> Amount </th>
                            <th width="20%">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a class="text-primary" style=" text-decoration:none;" href="{{route('projects.indivisual_Report', $project->id)}}"> <b>{{ $project->project_name }} </b></a> </td>
                            <td>{{ $project->project_address }}</td>
                            <td>{{ $project->date }}</td>
                            <td style="text-align: right !important;">{{ number_format(\App\ProjectPayment::all()->where('project_id',$project->id)->sum('amount'),2) }}</td>
                            <td>

                                <form action="{{route('projects.destroy', $project->id)}}" method="POST">
                                    <a href="{{route('projects.show', $project->id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> Add </a>
                                    <a href="{{route('projects.edit', $project->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Project!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
