@extends('backend.layouts.master')
@section('title')
    Admins Update - {{ $admin->name }}
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
            <h1 class="h3 mb-0 text-gray-800">  Edit Admins</h1>
            <a href="{{ route('admins.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Admins </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Admin - {{ $admin->name }} </h6>
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
                <form action="{{route('admins.update', $admin->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"> Name</label>
                        <div class="col-sm-6">
                            <input type="text"  class="form-control" id="name" name="name" value="{{ $admin->name }}" placeholder="Enter Your Name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" value="{{ $admin->email }}" id="email" name="email" placeholder="Enter Your Email"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{ $admin->username }}" id="username" name="username" placeholder="Enter Your Username"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your password"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Your Confirmation Password"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="roles" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-6">
                            <select name="roles[]" id="roles" class="select2 form-control" multiple>
                                @foreach($roles as $role)
                                    <option value="{{$role->name}}" {{$admin->hasRole($role->name) ? 'selected' : ''}}> {{$role->name}} </option>
                                @endforeach
                            </select>
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

