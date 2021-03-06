@extends('backend.layouts.master')
@section('title')
    Invest Money
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Invest Money Information</h1>
            @if(Auth::guard('admin')->user()->can('bank.create'))
            <a href="{{ route('investmoneys.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Invest Money Information Amount</a>
                @endif
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
{{--                <a href="{{ url('admin/bank-export-csv') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{ url('admin/bank-export-excel') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{ url('admin/bank-export-excel') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Invest Money List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Investor Name </th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th width="10%">Action</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($invests as $invest)
                        <tr>
                            <td> {{ $invest->id }}</td>
                            <td> {{ $invest->purpose_name }}</td>
                            <td> {{ $invest->date }}</td>
                            <td class="text-right">{{ number_format( ($invest->amount + \App\InvestAdd::where('investor_id',$invest->id)->sum('amount'))-\App\InvestExpense::where('investor_id',$invest->id)->sum('amount'),2) }}</td>
                            <td>
                                <form  action="{{route('investmoneys.destroy', $invest->id)}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('bank.edit'))
                                    <a href="{{route('investmoneys.edit', $invest->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('bank.delete'))
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Invest Money!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                        @endif
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('investmoneys.show', $invest->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add </a>
                                <a href="{{ route('investmoneysd.investmoneyexpense', $invest->id) }}" class="btn btn-danger btn-sm"> <i class="fa fa-minus"></i> Refund </a>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3" class="text-right"> Total </th>
                            <th colspan="" class="text-right">  </th>
                            <th>  </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
