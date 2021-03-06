@extends('backend.layouts.master')
@section('title')
    Open Bank Amount
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create Open Bank Amount </h1>
            @if(Auth::guard('admin')->user()->can('bank.view'))
            <a href="{{ route('open_bank_amounts.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Open Bank Amount List </a>
                @endif
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Open Bank Amount Create </h6>
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
                <form action="{{route('open_bank_amounts.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="bank_id" class="col-sm-3 col-form-label"> Bank Name</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="bank_id">
                                <option value="0"> Select Your Bank </option>
                                @foreach($banks as $bank)
                                 <option value="{{ $bank->id }}"> {{ $bank->bank_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ac_no" class="col-sm-3 col-form-label"> A/C NO </label>
                        <div class="col-sm-6">
                            <input type="text"  class="form-control" id="ac_no" name="ac_no" placeholder="Enter Your Bank Name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="branch_name" class="col-sm-3 col-form-label"> Branch Name </label>
                        <div class="col-sm-6">
                            <input type="text"  class="form-control" id="branch_name" name="branch_name" placeholder="Enter Your Bank Name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label"> Amount </label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount"/>
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



