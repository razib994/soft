@extends('backend.layouts.master')
@section('title')
   Bank Loan Add Update
@endsection
@section('content')
    <div class="container-fluid">
        @if (Session::has('message'))
            <div class="alert alert-success">
                <div>
                    <p>{{ Session::get('message') }}</p>
                </div>
            </div>
    @endif
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Edit Bank Loan Add </h1>
            <a href="{{ route('bankloans.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Bank Loan Add </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Bank Loan Add </h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('bankloans.bankloanadd.update',['id'=>$bankloans->id, 'investor_id'=>$bankloan_add->id])}}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="investor_id" value="{{$bankloans->id}}">
                    <div class="form-group row">
                        <label for="bank_id" class="col-sm-3 col-form-label"> Bank Name</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="bank_id">
                                <option value="0"> Select Your Bank </option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}" @if($bankloan_add->bank_id == $bank->id) selected @endif > {{$bank->bank_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_no" class="col-sm-3 col-form-label"> Cheque No </label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$bankloan_add->check_no}}" class="form-control" id="check_no" name="check_no" placeholder="Cheque No"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label"> Date </label>
                        <div class="col-sm-6">
                            <input type="date" value="{{$bankloan_add->date}}" class="form-control" id="date" name="date" placeholder="Date"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_method" class="col-sm-3 col-form-label"> Payment Method </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option selected disabled> Select Your Payment Method </option>
{{--                                <option value="cash" @if($bankloan_add->payment_method =='cash') selected @endif>  Cash </option>--}}
                                <option value="check" @if($bankloan_add->payment_method =='check') selected @endif> Cheque </option>
                              <option value="open" @if($bankloan_add->payment_method =='open') selected @endif> Opening Balance </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label"> Amount </label>
                        <div class="col-sm-6">
                            <input type="number" value="{{$bankloan_add->amount}}" class="form-control" id="amount" name="amount" placeholder="Amount"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-sm-3 col-form-label not"> Note </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="note" name="note" > {{$bankloan_add->note}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="submits" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-success" id="submits" name="submit" value="Submit"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection

