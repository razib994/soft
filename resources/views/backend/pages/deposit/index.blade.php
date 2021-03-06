@extends('backend.layouts.master')
@section('title')
    Deposit Amount List
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
            <h1 class="h3 mb-0 text-gray-800">Deposit Amount</h1>
            <a href="{{ route('deposits.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Deposit Amount</a>
            <form action="{{route('deposits.index')}}"  method="get">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="date" class="form-control" required name="start_date" id="start_date" placeholder="Start Date">
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
                <a href="{{url('admin/deposit-csv')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>
                <a href="{{url('admin/deposit-excel')}}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{route('admin.deposit-pdf', [$start_date,$end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Deposit List </h6>
                <p>Deposit Report From <strong>{{ $start_date }}</strong> to <strong>{{ $end_date }}</strong></p>
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
                            <th> Deposit Name </th>
                            <th> Amount </th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total = 0;  $t =''; @endphp
                    @foreach($deposits as $deposit)
                        <tr>
                            <td> {{ $deposit->id }} </td>
                            <td> {{ $deposit->bank->bank_name }} </td>
                            <td> {{ $deposit->checkno }} </td>
                            <td> {{ $deposit->date }} </td>
                            <td> {{ $deposit->branch_name }} </td>
                            <td> <img src="{{ $deposit->check_image }}" /> </td>
                            <td> {{ $deposit->depositers_name }} </td>
                            <td> {{ number_format($t = $deposit->amount, 2) }} </td>
                            @php $total = $total + $t;@endphp
                            <td>


                                <form  action="{{route('deposits.destroy', $deposit->id)}}" method="POST">
                                    <a href="{{route('deposits.edit', $deposit->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Deposit!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Bank Name </th>
                            <th>Check No </th>
                            <th>Date</th>
                            <th>Branch Name </th>
                            <th> Check Image </th>
                            <th> Deposit Name </th>
                            <th> {{ number_format($total, 2) }} </th>
                            <th width="10%">Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
