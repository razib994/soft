@extends('backend.layouts.master')
@section('title')
    Bank Transfer Create
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create  Bank Transfer </h1>
            @if(Auth::guard('admin')->user()->can('bank.view'))
            <a href="{{ route('bank_transfers.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i>  Bank Transfer List </a>
                @endif
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Bank Transfer Create </h6>
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
                <form action="{{route('bank_transfers.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="form_bank_id" class="col-sm-3 col-form-label"> From Bank Transfer Name</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="form_bank_id" name="form_bank_id">
                                <option> Select Your Bank </option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}"> {{$bank->bank_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="to_bank_id" class="col-sm-3 col-form-label"> To Bank Transfer Name</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="to_bank_id" name="to_bank_id">
                                <option> Select Your Bank </option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}"> {{$bank->bank_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label"> Date </label>
                        <div class="col-sm-6">
                            <input type="date"  class="form-control" id="date" name="date" placeholder="Enter Date"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label"> Amount </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount"/>
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



