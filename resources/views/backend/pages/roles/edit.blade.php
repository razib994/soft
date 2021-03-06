@extends('backend.layouts.master')
@section('title')
    Edit Role
@endsection
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Edit Role</h1>
            @if(Auth::guard('admin')->user()->can('role.view'))
            <a href="{{ route('roles.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Role List </a>
                @endif
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Role Update </h6>
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
                <form action="{{route('roles.update', $role->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$role->name}}" name="name" placeholder="Enter Roles Name!" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-12 col-form-label"><strong>Role Permissions</strong></label>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input"  id="checkedPermissionAll"  value="1" {{ App\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkedPermissionAll">All</label>
                            </div>
                        </label>
                        <div class="col-sm-10">

                        </div>
                    </div>
                    @php
                        $i=1;
                    @endphp

                    @foreach($permissions_group as $group)
                        @php
                            $permissions = App\User::getpermissionsByGroupName($group->name);
                            $j = 1;
                        @endphp
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input"  id="{{ $i }}Management"  value="{{$group->name}}" onclick="checkPermissionByGroup('role-{{ $i  }}-management-checkbox', this)" {{ App\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkedPermission">{{ $group->name }}</label>
                                </div>
                            </label>
                            <div class="col-sm-10 role-{{ $i }}-management-checkbox">

                                @foreach($permissions as $permission)
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox','{{ $i }}Management',{{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkedPermission{{$permission->id}}" value="{{$permission->name}}">
                                        <label class="form-check-label" for="checkedPermission{{$permission->id}}">{{ $permission->name }}</label>
                                    </div>
                                    @php
                                        $j++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-success btn sm" value="Update" name="update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('backend.pages.roles.partials.scripts')
@endsection
