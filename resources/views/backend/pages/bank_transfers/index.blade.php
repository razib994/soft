@extends('backend.layouts.master')
@section('title')
    Bank Transfer
@endsection
@section('content')

    <div class="container-fluid">
    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bank Transfer</h1>
            @if(Auth::guard('admin')->user()->can('bank.create'))
            <a href="{{ route('bank_transfers.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Bank Transfer Amount</a>
                @endif
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
{{--                <a href="{{ url('admin/bank-export-csv') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{ url('admin/bank-export-excel') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{ url('admin/bank_transfer-export-pdf') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Bank Transfer List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>From Bank Name </th>
                            <th>To Bank Name </th>
                            <th> Date </th>
                            <th>Amount</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $st_total = 0; $st=''; @endphp
                        @foreach($bank_transfers as $bank_transfer)
                        <tr>
                            <td> {{ $bank_transfer->id  }} </td>
                            <td> @foreach($banks as $bank) @if($bank->id == $bank_transfer->form_bank_id) {{$bank->bank_name}} @endif @endforeach </td>
                            <td> @foreach($banks as $bank) @if($bank->id == $bank_transfer->to_bank_id) {{$bank->bank_name}} @endif @endforeach </td>
                            <td> {{ $bank_transfer->date  }} </td>
                            <td class="text-right">{{ $bank_transfer->amount  }}</td>
                            <td>
                                <form  action="{{route('bank_transfers.destroy', $bank_transfer->id)}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('bank.edit'))
                                    <a href="{{route('bank_transfers.edit', $bank_transfer->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('bank.delete'))
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Bank Information!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                        @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4" class="text-right"> Total </th>
                            <th colspan="" class="text-right"> {{ number_format($st_total,2) }} </th>
                            <th>  </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
