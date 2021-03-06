<style>
    tr th {
        font-size: 11px;
    }
    tr td {
        font-size: 11px;
    }
</style>
<div class="container-fluid">
        <!-- DataTales Example -->
        <h4> Theme Engineer Ltd. </h4>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <p>Withdraw Report From <strong>{{ $start_date }}</strong> to <strong>{{ $end_date }}</strong></p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
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
