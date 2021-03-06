@extends('backend.layouts.master')
@section('title')
    Profession List
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
            <h1 class="h3 mb-0 text-gray-800">Profession List </h1>
            <a href="{{ url('admin/categories/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Profession </a>
        </div>

        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profession List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Profession Name</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Profession Name</th>
                            <th width="10%">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($professionals as $professional)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $professional->profession_name  }} </td>
                            <td>
                                <form action="{{route('professionals.destroy', $professional->id)}}" method="POST">
                                    @if(Auth::guard('admin')->user()->can('visitor.edit'))
                                    <a href="{{route('professionals.edit', $professional->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                     @endif
                                    @if(Auth::guard('admin')->user()->can('visitor.delete'))
                                        @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This Profession!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                        @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
