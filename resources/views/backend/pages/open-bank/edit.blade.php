@extends('backend.layouts.master')
@section('title')
    Open Bank Amount Update - {{ $open_bank->bank->bank_name }}
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
            <h1 class="h3 mb-0 text-gray-800">  Edit Open Bank Amount </h1>
            <a href="{{ route('open_bank_amounts.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Open Bank Amount</a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Open Bank - {{ $open_bank->bank->bank_name }} </h6>
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
                <form action="{{route('open_bank_amounts.update', $open_bank->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="bank_name" class="col-sm-3 col-form-label"> Bank Name</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="bank_id">
                                <option value="0"> Select Your Bank </option>
                                @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}" @if($bank->id == $open_bank->id) selected @endif> {{ $bank->bank_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ac_no" class="col-sm-3 col-form-label"> A/C NO </label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$open_bank->ac_no}}"  class="form-control" id="ac_no" name="ac_no" placeholder="Enter Your Bank Name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="branch_name" class="col-sm-3 col-form-label"> Branch Name </label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$open_bank->branch_name}}"  class="form-control" id="branch_name" name="branch_name" placeholder="Enter Your Bank Name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label"> Amount </label>
                        <div class="col-sm-6">
                            <input type="number" value="{{$open_bank->amount}}" class="form-control" id="amount" name="amount" placeholder="Amount"/>
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



