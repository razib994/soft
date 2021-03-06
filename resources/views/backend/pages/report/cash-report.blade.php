@extends('backend.layouts.master')
@section('title')
    Cash Balance Sheet
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
            <h1 class="h3 mb-0 text-gray-800"> Cash Balance Sheet </h1>

        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                <a href="{{url('admin/export-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>
                <a href="{{url('admin/export-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{url('admin/export-pdf')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cash Balance Sheet </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th colspan="2">Income </th>
                            <th colspan="2"> Expense </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td> I. Particulars Name </td>
                            <td> Income Amount </td>

                            <td> E. Particulars Name </td>
                            <td> Expense Amount </td>
                        </tr>
                        <tr>
                            <td> Collection Form CLient </td>
                            <td> 600000 </td>

                            <td>Project Expenditure </td>
                            <td> 50000 </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="2">Total  - 600000 </th>
                            <th colspan="2"> Total  - 50000 </th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="4">Balance  - 10000 </th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
