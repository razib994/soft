@extends('backend.layouts.master')
@section('title')
    Withdraw Create
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create Withdraw </h1>
            @if(Auth::guard('admin')->user()->can('withdraw.view'))
            <a href="{{ route('widraws.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Withdraw List </a>
                @endif
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Withdraw Create </h6>
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
                <form action="{{route('widraws.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label for="bank_id" class="col-sm-3 col-form-label"> Bank Name</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="bank_id" name="bank_id">
                                    <option> Select Your Bank </option>
                                    @foreach($banks as $bank)
                                    <option value="{{$bank->id}}"> {{$bank->bank_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="checkno" class="col-sm-3 col-form-label"> Check No </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="checkno" name="checkno" placeholder="Enter Your Check No"/>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="date" name="date" placeholder="Enter Your Date"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="branch_name" class="col-sm-3 col-form-label"> Branch Name </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Branch Name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_image" class="col-sm-3 col-form-label"> Check Image </label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="check_image" name="check_image" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="widraw_name" class="col-sm-3 col-form-label"> Withdraw Name </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="widraw_name" name="widraw_name" placeholder="Enter Your Withdraw Name"/>
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



