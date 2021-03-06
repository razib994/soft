@extends('backend.layouts.master')
@section('title')
   Open Cash Information
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
            <h1 class="h3 mb-0 text-gray-800">Open Cash Information</h1>
            @if(Auth::guard('admin')->user()->can('cash.create'))
            <a href="{{ route('open_cash_amounts.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Open Cash Information Amount</a>
                @endif
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>
                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Open Cash Information List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Cash Name </th>
                            <th>Amount</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = 1;  @endphp
                        @foreach($opencashs as $opencash)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $opencash->purpose_name  }} </td>
                            <td>  {{ $opencash->amount }}

                            <td>

                                <form  action="{{route('open_cash_amounts.destroy', $opencash->id)}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('cash.edit'))
                                    <a href="{{route('open_cash_amounts.edit', $opencash->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                        @if(Auth::guard('admin')->user()->can('cash.delete'))
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Open Cash Amount Information!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="2"> Total </th>
                            <th colspan="2">  </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
