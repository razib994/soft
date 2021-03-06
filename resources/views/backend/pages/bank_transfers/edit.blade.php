@extends('backend.layouts.master')
@section('title')
    Bank Transfer  Update
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
            <h1 class="h3 mb-0 text-gray-800">  Edit  Bank Transfer  </h1>
            <a href="{{ route('bank_transfers.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All  Bank Transfer </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit  Bank Transfer </h6>
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
                <form action="{{route('bank_transfers.update', $bank_transfers->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="form_bank_id" class="col-sm-3 col-form-label"> From Bank Transfer Name</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="form_bank_id" name="form_bank_id">
                                <option> Select Your Bank </option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}" @if($bank->id ==$bank_transfers->form_bank_id) selected @endif >  {{$bank->bank_name}}  </option>
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
                                    <option value="{{$bank->id}}"  @if($bank->id ==$bank_transfers->to_bank_id) selected @endif> {{$bank->bank_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label"> Date </label>
                        <div class="col-sm-6">
                            <input type="date"  value="{{$bank_transfers->date}}" class="form-control" id="date" name="date" placeholder="Enter Date"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label"> Amount </label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$bank_transfers->amount}}" class="form-control" id="amount" name="amount" placeholder="Amount"/>
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

