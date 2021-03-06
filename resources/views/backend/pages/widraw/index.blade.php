@extends('backend.layouts.master')
@section('title')
    Withdraw Amount List
@endsection
@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Withdraw Amount</h1>
            @if(Auth::guard('admin')->user()->can('withdraw.create'))
            <a href="{{ route('widraws.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Withdraw Amount</a>
                @endif
            <form action="{{route('widraws.index')}}"  method="get">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="date" class="form-control " required name="start_date" id="start_date" placeholder="Start Date">
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" required name="end_date" id="end_date" placeholder="End Date">

                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Report</button>
                    </div>
                </div>
            </form>
        </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 mb-2 text-right">
{{--            <a href="{{url('admin/withdraw-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
            <a href="{{url('admin/withdraw-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
<a href="{{route('admin.withdraw-pdf',[$start_date, $end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
        </div>
    </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Withdraw List </h6>
                <p>Withdraw Report From <strong>{{ $start_date }}</strong> to <strong>{{ $end_date }}</strong></p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Bank Name </th>
                            <th>Check No </th>
                            <th>Date</th>
                            <th>Branch Name </th>
                            <th> Check Image </th>
                            <th> Withdraw Name </th>
                            <th> Amount </th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $total = 0;  $t =''; @endphp
                        @foreach($widraws as $widraw)
                            <tr>
                                <td> {{ $widraw->id }} </td>
                                <td> {{ $widraw->bank->bank_name }} </td>
                                <td> {{ $widraw->checkno }} </td>
                                <td> {{ $widraw->date }} </td>
                                <td> {{ $widraw->branch_name }} </td>
                                <td> <img src="{{ $widraw->check_image }}" /> </td>
                                <td> {{ $widraw->widraw_name }} </td>
                                <td> {{ number_format($t = $widraw->amount, 2) }} </td>
                                @php $total = $total + $t;@endphp
                                <td>

                                    <form  action="{{route('widraws.destroy', $widraw->id)}}" method="POST">
                                        @if(Auth::guard('admin')->user()->can('withdraw.edit'))
                                        <a href="{{route('widraws.edit', $widraw->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                        @endif
                                            @if(Auth::guard('admin')->user()->can('withdraw.delete'))
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are You Sure Deleted This Withdraw!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="7" class="text-right">Total</th>
                            <th colspan="2"> {{ number_format($total, 2) }} </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
