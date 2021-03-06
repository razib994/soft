@extends('backend.layouts.master')
@section('title')
     Loan
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Loan Information</h1>
            @if(Auth::guard('admin')->user()->can('bank.create'))
            <a href="{{ route('othersloans.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i>  Loan Amount</a>
                @endif
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
{{--                <a href="{{ url('admin/bank-export-csv') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{ url('admin/bank-export-excel') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{ url('admin/otherloan-export-pdf') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Loan List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th> Name </th>
                            <th>Date </th>
                            <th>Amount</th>
                            <th width="10%">Action</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = ''; $it = 0;@endphp
                        @foreach($othersloans as $othersloan)
                        <tr>
                            <td> {{ $othersloan->id }}</td>
                            <td> {{ $othersloan->purpose_name }}</td>
                            <td> {{ $othersloan->date }}</td>
                            <td class="text-right">{{ number_format($i = (\App\OtherLoanAdd::all()->where('investor_id',$othersloan->id)->sum('amount'))-(\App\OtherLoanExpense::all()->where('investor_id',$othersloan->id)->sum('amount')),2) }} @php $it =$it +$i; @endphp</td>
                            <td>
                                <form  action="{{route('othersloans.destroy', $othersloan->id)}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('bank.edit'))
                                    <a href="{{route('othersloans.edit', $othersloan->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('bank.delete'))
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Other Loan!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                        @endif
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('othersloan.loanadd', $othersloan->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add </a>
                                <a href="{{ route('othersloans.loanexpense', $othersloan->id) }}" class="btn btn-danger btn-sm"> <i class="fa fa-minus"></i> Refund </a>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3" class="text-right"> Total </th>
                            <th colspan="" class="text-right"> {{number_format($it,2)}} </th>
                            <th>  </th>
                            <th>  </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
