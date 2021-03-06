@extends('backend.layouts.master')
@section('title')
    Projects Create
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create Projects</h1>
            <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Projects List </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Projects Create </h6>
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
                <form action="{{route('projects.store')}}" method="post">
                    @csrf
                        <div class="form-group row">
                            <label for="project_name" class="col-sm-3 col-form-label"> Project Name</label>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" id="project_name" name="project_name" placeholder="Enter Your Project Name"/>
                            </div>
                        </div>

                    <div class="form-group row">
                        <label for="project_address" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="project_address"  name="project_address" placeholder="Enter Your Project Address"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label"> Date</label>
                        <div class="col-sm-6">
                            <input type="date"  class="form-control" id="date" name="date" />
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



