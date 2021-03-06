@extends('backend.layouts.master')
@section('title')
    Items Create
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create Items </h1>
            @if(Auth::guard('admin')->user()->can('item-particular.view'))
            <a href="{{ route('items.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Items Particular List </a>
            @endif
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Items Create </h6>
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
                <form action="{{route('items.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-3 col-form-label"> Itme Name</label>
                        <div class="col-sm-6">
                            <select  class="form-control" id="category_id" name="category_id">
                                <option> Select Your Item </option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id  }}"> {{ $category->category_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="items_name" class="col-sm-3 col-form-label"> Itme Name</label>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" id="items_name" name="items_name" placeholder="Enter Your Category Name"/>
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



