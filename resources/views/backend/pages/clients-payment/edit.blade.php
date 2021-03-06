@extends('backend.layouts.master')
@section('title')
    Clients Collection Amount Update - {{ $clients->client_name }}
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
            <h1 class="h3 mb-0 text-gray-800">  Edit Clients Collection Amount</h1>
            <a href="{{ route('clients.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Clients Collection Amount </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Clients Collection Amount - {{ $clients->client_name }} </h6>
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
                <form action="{{route('clients.payments.update', ['id' => $clients->id, 'client_id' => $clientspayments->id])}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="hidden" value="{{ $clients->id }}" class="form-control" id="client_id" name="client_id" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-6">
                            <input type="date" value="{{ $clientspayments->date }}" class="form-control" id="date" name="date" placeholder="Enter Your Date"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{ $clientspayments->amount }}" id="amount" name="amount" placeholder="Enter Your Amount"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bank_id" class="col-sm-3 col-form-label"> Bank Name </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="bank_id" name="bank_id">
                                <option value="0" selected> Select Your Bank </option>
                                @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}" @if($bank->id == $clientspayments->bank_id) selected @endif>  {{  $bank->bank_name }}  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_no" class="col-sm-3 col-form-label">Cheque NO</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$clientspayments->check_no}}" class="form-control" id="check_no" name="check_no" placeholder="Enter Your Cheque NO"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_method" class="col-sm-3 col-form-label"> Payment Method </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option selected disabled> Select Your Payment Method </option>
                                <option value="cash" @if($clientspayments->payment_method =='cash') selected @endif> Cash </option>
                                <option value="check" @if($clientspayments->payment_method =='check') selected @endif> Cheque </option>
                                <option value="open" @if($clientspayments->payment_method =='open') selected @endif> Opening Balance </option>
                                <option value="refund" @if($clientspayments->payment_method =='refund') selected @endif> Refund </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_file" class="col-sm-3 col-form-label"> Cheque Image </label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="check_file" name="check_file" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note" class="col-sm-3 col-form-label">Note </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="note" name="note" > {{ $clientspayments->note }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="submits" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-success" id="submits" name="submit" value="Update"/>
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

