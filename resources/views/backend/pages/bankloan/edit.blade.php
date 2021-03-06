@extends('backend.layouts.master')
@section('title')
    Bank Loan Update
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
            <h1 class="h3 mb-0 text-gray-800">  Edit Bank Loan</h1>
            <a href="{{ route('bankloans.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Bank Loan</a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Bank Loan  </h6>
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
                <form action="{{route('bankloans.update', $bankloans->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="investor_name" class="col-sm-3 col-form-label"> Investor Name</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$bankloans->investor_name}}"  class="form-control" id="investor_name" name="investor_name" placeholder="Enter Your Investor Name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label"> Date </label>
                        <div class="col-sm-6">
                            <input type="date" value="{{$bankloans->date}}" class="form-control" id="date" name="date" placeholder="Date"/>
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

