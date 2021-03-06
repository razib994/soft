@extends('backend.layouts.master')
@section('title')
    Users Update Deposit
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
            <h1 class="h3 mb-0 text-gray-800">  Edit Deposits</h1>
            <a href="{{ route('deposits.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Deposit </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Deposit </h6>
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
                <form action="{{route('deposits.update', $deposits->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                        <div class="form-group row">
                            <label for="bank_id" class="col-sm-3 col-form-label"> Bank Name</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="bank_id" name="bank_id">
                                    <option> Select Your Bank </option>
                                    @foreach($banks as $bank)
                                        <option value="{{$bank->id}}" @if($bank->id == $deposits->bank_id)selected @endif> {{$bank->bank_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="checkno" class="col-sm-3 col-form-label"> Check No </label>
                            <div class="col-sm-6">
                                <input type="text" value="{{$deposits->checkno}}" class="form-control" id="checkno" name="checkno" placeholder="Enter Your Check No"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-6">
                                <input type="date" value="{{$deposits->date}}" class="form-control" id="date" name="date" placeholder="Enter Your Date"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="branch_name" class="col-sm-3 col-form-label"> Branch Name </label>
                            <div class="col-sm-6">
                                <input type="text" value="{{$deposits->branch_name}}" class="form-control" id="branch_name" name="branch_name" placeholder="Branch Name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="check_image" class="col-sm-3 col-form-label"> Check Image </label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="check_image" name="check_image" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="depositers_name" class="col-sm-3 col-form-label"> Depositer Name </label>
                            <div class="col-sm-6">
                                <input type="text" value="{{$deposits->depositers_name}}" class="form-control" id="depositers_name" name="depositers_name" placeholder="Enter Your Widrawer Name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-sm-3 col-form-label"> Amount </label>
                            <div class="col-sm-6">
                                <input type="number" value="{{$deposits->amount}}" class="form-control" id="amount" name="amount" placeholder="Amount"/>
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

