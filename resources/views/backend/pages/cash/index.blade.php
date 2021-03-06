@extends('backend.layouts.master')
@section('title')
    Cash Information
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
            <h1 class="h3 mb-0 text-gray-800">Cash Information</h1>
            @if(Auth::guard('admin')->user()->can('cash.create'))
            <a href="{{ route('cashes.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Cash Information Amount</a>
                @endif
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-md-6"></div>--}}
{{--            <div class="col-md-6 mb-2 text-right">--}}
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>--}}
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>--}}
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cash List </h6>
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
                        @php $st_total =0;$st=''; @endphp
                        @foreach($cashs as $cash)
                        <tr>
                            <td> {{ $cash->id  }} </td>
                            <td> <a href="{{route('admin.collection-report-cash')}}" style="text-decoration: none"> {{ $cash->cash_name  }} </a></td>

                                 <td>
                                     {{number_format($st = (\App\ClientPayment::where('payment_method','cash')->sum('amount') + \App\Cashopen::all()->sum('amount')  + $cash->amount + \Illuminate\Support\Facades\DB::table("widraws")->get()->sum("amount")+\App\InvestAdd::all()->where('payment_method','cash')->sum('amount') + \App\OtherLoanAdd::all()->where('payment_method','cash')->sum('amount')) - (\App\ProjectPayment::where('payment_method','cash')->sum('amount') + \App\InvestExpense::all()->where('payment_method','cash')->sum('amount')+ \App\OtherLoanExpense::all()->where('payment_method','cash')->sum('amount') +\Illuminate\Support\Facades\DB::table("deposits")->get()->sum("amount")),2)}}
                                @php $st_total = $st_total + $st  ;@endphp </td>
                            <td>

                                <form  action="{{route('cashes.destroy', $cash->id)}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('cash.edit'))
                                    <a href="{{route('cashes.edit', $cash->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                        @if(Auth::guard('admin')->user()->can('cash.delete'))
                                    @csrf
                                    @method('DELETE')
                                    <button type="
" onclick="return confirm('Are You Sure Deleted This Cash Information!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="2"> Total </th>
                            <th colspan="2"> {{ number_format($st,2) }} </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
