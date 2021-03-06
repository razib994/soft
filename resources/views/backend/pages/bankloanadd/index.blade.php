@extends('backend.layouts.master')
@section('title')
     Bank Loan Add List
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Bank Loan Add List </h1>
            @if(Auth::guard('admin')->user()->can('bank.create'))
            <a href="{{ route('bankloans.created', $bankloans->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i>  Create Bank Loan Add</a>
                @endif
            <form action="{{ route('bankloans.bankloanadd', $bankloans->id) }}" method="get">
                <div class="row">
                    <div class="col-md-5">
                        <input type="date" name="start_date" required class="form-control"/>
                    </div>
                    <div class="col-md-5">
                        <input type="date" name="end_date" required class="form-control"/>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary"> Report </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
{{--                <a href="{{ url('admin/bank-export-csv') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{ url('admin/bank-export-excel') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{ url('admin/bank-loan-add',['id'=>$bankloans->id,$start_date, $end_date]) }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Loan Add List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Bank Name</th>
                            <th>Cheque No</th>
                            <th>Date</th>

                            <th style="text-align: right !important;">Amount</th>
                            <th>Payment Method</th>
                            <th>Note</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $in=''; $in_t = 0; @endphp
                        @foreach($bankloan_adds as $bankloan_add)
                        <tr>
                            <td> {{ $bankloan_add->id }}</td>
                            <td>@php $banks = \App\Bank::where('id',$bankloan_add->bank_id)->get();@endphp @foreach($banks as $bank) {{ $bank->bank_name }} @endforeach </td>
                            <td> {{ $bankloan_add->check_no }}</td>
                            <td> {{ $bankloan_add->date }}</td>
                            <td class="text-right"> {{ number_format($in = $bankloan_add->amount,2) }} @php $in_t =$in_t+$in;  @endphp</td>
                            <td> @if($bankloan_add->payment_method =='check') Cheque @elseif($bankloan_add->payment_method =='cash') Cash @else Opening Balance @endif</td>
                            <td> {{ $bankloan_add->note }}</td>

                            <td>
                                <form  action="{{route('bankloans.bankloanadd.destroy', ['id' => $bankloans->id, 'investor_id' =>$bankloan_add->id ])}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('bank.edit'))
                                    <a href="{{route('bankloans.bankloanadd.edit',  ['id' => $bankloans->id, 'investor_id' =>$bankloan_add->id ])}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('bank.delete'))
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Bank Loan!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                        @endif
                                </form>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4" class="text-right"> Total </th>
                            <th colspan="" class="text-right"> {{number_format($in_t,2) }} </th>
                            <th colspan="4">  </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
