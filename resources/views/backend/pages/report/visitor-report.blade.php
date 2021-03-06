@extends('backend.layouts.master')
@section('title')
    Visitors List
@endsection
@section('content')

    <div class="container-fluid">
        @if (Session::has('message'))
            <div class="alert alert-success">
                <div>
                    <p>{{ Session::get('message') }}</p>
                </div>
            </div>
    @endif
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Visitors List </h1>
            @if(Auth::guard('admin')->user()->can('visitor.create'))
            <a href="{{ url('admin/visitors/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Visitors </a>
                @endif
        </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 mb-2 text-right">
            <a href="{{ url('admin/export-csv-visitor') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>
            <a href="{{ url('admin/export-excel-visitor') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
            <a href="{{ url('admin/export-pdf-visitor') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
        </div>
    </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Visitors List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Visitors Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Remark/Details Infromation</th>
                            <th>Contact Person Set </th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Visitors Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Remark/Details Infromation</th>
                            <th>Contact Person Set </th>
                            <th width="10%">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($visitors as $visitor)
                        <tr>
                            <td> {{ $visitor->id  }} </td>
                            <td> {{ $visitor->name  }} </td>
                            <td> {{ $visitor->email  }} </td>
                            <td> {{ $visitor->phone  }}  </td>
                            <td> {{ $visitor->address  }} </td>
                            <td> {{ $visitor->date  }} </td>
                            <td> {{ $visitor->remark  }} </td>
                            <td> {{ $visitor->contact_person  }}  </td>
                            <td>
                                <form action="{{route('visitors.destroy', $visitor->id)}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('visitor.edit'))
                                    <a href="{{route('visitors.edit', $visitor->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('visitor.delete'))
                                     @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This User!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                    @endif
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
