@extends('backend.layouts.master')
@section('title')
    Client List
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
            <h1 class="h3 mb-0 text-gray-800">Clients</h1>
            <a href="{{ route('clients.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Clients </a>
        </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 mb-2 text-right">
{{--            <a href="{{url('admin/export-csv-client')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
            <a href="{{url('admin/export-excel-client')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
            <a href="{{url('admin/pdf-client')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
        </div>
    </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clients List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Project Name</th>
                            <th>Client Name </th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Project Name</th>
                            <th>Client Name </th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th width="15%">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $i++  }}</td>
{{--                            <td>{{ $client->project->project_name }}</td>--}}
                            <td>{{ $client->project->project_name }}</td>
                            <td>{{ $client->client_name  }}</td>
                            <td>{{ $client->phone  }}</td>
                            <td>{{ $client->address  }}</td>
                            <td>
                                <form action="{{route('clients.destroy', $client->id)}}" method="POST">
                                    <a href="{{route('clients.show', $client->id)}}" class="btn btn-primary btn-sm mb-1"> <i class="fa fa-plus"></i> Add </a>
                                    <a href="{{route('clients.edit', $client->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Client Data!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
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
