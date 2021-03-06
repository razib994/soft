@extends('backend.layouts.master')
@section('title')
    Clients Create
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create Clients</h1>
            <a href="{{ route('clients.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Clients List </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clients Create </h6>
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
                <form action="{{route('clients.store')}}" method="post">
                    @csrf
                        <div class="form-group row">
                            <label for="project_id" class="col-sm-3 col-form-label"> Project Name </label>
                            <div class="col-sm-6">
                                <select class="form-control" id="project_id" name="project_id">
                                    <option > Select Your Project </option>
                                    @foreach($projects as $project)
                                    <option value="{{ $project->id }}">  {{  $project->project_name }}  </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="client_name" class="col-sm-3 col-form-label">Client Name </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Enter Your Client Name"/>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label"> Address </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address"> </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="floor" class="col-sm-3 col-form-label">Floor</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="floor" name="floor" placeholder="Enter Your Floor"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apartment" class="col-sm-3 col-form-label">Apartment</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="apartment" name="apartment" placeholder="Enter Your Apartment"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Your Amount"/>
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



