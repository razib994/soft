@extends('backend.layouts.master')
@section('title')
     Loan Refund List
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Loan Refund List ()</h1>
            @if(Auth::guard('admin')->user()->can('bank.create'))
            <a href="{{ route('othersloans.created', $othersloans->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i>  Loan Refund</a>
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
                <h6 class="m-0 font-weight-bold text-primary"> Loan Refund List </h6>
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

                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Note</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $in=''; $in_t = 0; @endphp
                        @foreach($otheradds as $otheradd)
                        <tr>
                            <td> {{ $otheradd->id }}</td>
                            <td>@php $banks = \App\Bank::where('id',$otheradd->bank_id)->get();@endphp @foreach($banks as $bank) {{ $bank->bank_name }} @endforeach </td>
                            <td> {{ $otheradd->check_no }}</td>
                            <td> {{ $otheradd->date }}</td>
                            <td class="text-right"> {{ number_format($in = $otheradd->amount,2) }} @php $in_t =$in_t+$in;  @endphp</td>
                            <td> @if($otheradd->payment_method =='check') Cheque @elseif($otheradd->payment_method =='cash') Cash @else Opening Balance @endif</td>
                            <td> {{ $otheradd->note }}</td>

                            <td>
                                <form  action="{{route('othersloans.loanexpense.destroy', ['id' => $othersloans->id, 'investor_id' =>$otheradd->id ])}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('bank.edit'))
                                    <a href="{{route('othersloans.loanexpense.edit',  ['id' => $othersloans->id, 'investor_id' =>$otheradd->id ])}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('bank.delete'))
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Other Loan Expense!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                        @endif
                                </form>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="5" class="text-right"> Total </th>
                            <th colspan="" class="text-right"> {{number_format($in_t,2) }} </th>
                            <th colspan="3">  </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
