@extends('backend.layouts.master')
@section('title')
    Clients Update - {{ $clients->client_name }}
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
            <h1 class="h3 mb-0 text-gray-800">  Edit Clients</h1>
            <a href="{{ route('clients.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Clients </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Clients - {{ $clients->client_name }} </h6>
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
                <form action="{{route('clients.update', $clients->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="project_id" class="col-sm-3 col-form-label"> Project Name </label>
                        <div class="col-sm-6">
                            <select class="form-control" name="project_id">
                                <option> Selct Category </option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" @if ($project->id == $clients->project_id) selected @endif> {{ $project->project_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="client_name" class="col-sm-3 col-form-label">Client Name </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="client_name" value="{{ $clients->client_name }}" name="client_name" placeholder="Enter Your Client Name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{ $clients->phone }}" id="phone" name="phone" placeholder="Enter Your Phone Number"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label"> Address </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address">
                           {{ $clients->address }}
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="floor" class="col-sm-3 col-form-label">Floor</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{ $clients->floor }}" id="floor" name="floor" placeholder="Enter Your Floor"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apartment" class="col-sm-3 col-form-label">Apartment</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{ $clients->apartment }}" id="apartment" name="apartment" placeholder="Enter Your Apartment"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control"  value="{{ $clients->amount }}" id="amount" name="amount" placeholder="Enter Your Amount"/>
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

