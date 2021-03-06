@extends('backend.layouts.master')
@section('title')
    Categories Update - - {{ $categories->category_name }}
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
            <h1 class="h3 mb-0 text-gray-800">  Edit Categories </h1>
            @if(Auth::guard('admin')->user()->can('category.view'))
            <a href="{{ route('categories.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Category </a>
            @endif

        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Categories - {{  $categories->category_name }} </h6>
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
                <form action="{{route('categories.update', $categories->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label"> Category Name</label>
                        <div class="col-sm-6">
                            <input type="text"  class="form-control" value="{{ $categories->category_name }}" id="category_name" name="category_name" placeholder="Enter Your Category Name"/>
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="submits" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-success" id="update" name="update" value="Update"/>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection


