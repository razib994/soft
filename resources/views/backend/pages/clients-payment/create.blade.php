@extends('backend.layouts.master')
@section('title')
    Clients Amount Create
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create Clients Amount - {{ $client->client_name }}</h1>

        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clients Amount Collect</h6>
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
                <form action="{{route('clients.stored', $client->id)}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="hidden" value="{{ $client->id }}" class="form-control" id="client_id" name="client_id" />
                        </div>
                    </div>


                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="date" name="date" placeholder="Enter Your Date"/>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Your Amount"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bank_id" class="col-sm-3 col-form-label"> Bank Name </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="bank_id" name="bank_id">
                                <option value="0" > Select Your Bank </option>
                                @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}">  {{  $bank->bank_name }}  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_no" class="col-sm-3 col-form-label">Cheque NO</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="check_no" name="check_no" placeholder="Enter Your Cheque NO"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_method" class="col-sm-3 col-form-label"> Payment Method </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option selected disabled > Select Your Payment Method </option>
                                <option value="cash"> Cash </option>
                                <option value="check"> Cheque </option>
                                <option value="open"> Opening Balance </option>
                                <option value="refund"> Refund </option>
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
                            <textarea class="form-control" id="note" name="note" ></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="submits" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-primary" id="submits" name="submit" value="Submit"/>
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>

@endsection



