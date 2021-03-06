@extends('backend.layouts.master')
@section('title')
    Items Update - {{ $items->items_name }}
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
            <h1 class="h3 mb-0 text-gray-800">  Edit Items </h1>
            <a href="{{ route('items.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Items </a>

        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Items  </h6>
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
                <form action="{{route('items.update', $items->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label"> Category Name</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="category_id">
                                <option> Selct Category </option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $items->category_id) selected @endif> {{ $category->category_name }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="items_name" class="col-sm-3 col-form-label"> Item Name </label>
                        <div class="col-sm-6">
                            <input type="text"  class="form-control" value="{{ $items->items_name }}" id="items_name" name="items_name" placeholder="Enter Your Category Name"/>
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


