@extends('backend.layouts.master')
@section('title')
    Investor Information
@endsection
@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Investor </h1>
            <a href="{{ route('investmoneys.investmoneyadd', $invest->id)}}" class="d-none d-sm-inline-block float-right btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Investor Add List </a>
            <a href="{{ route('investmoneys.created', $invest->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Investor Add Amount </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="m-0 font-weight-bold text-primary">Investor Information </h6>
                    </div>
                    <div class="col-md-9">

                    </div>
                </div>


            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>

                    <tr>
                        <th scope="row" class="text-left"> Name : </th>
                        <td>{{ $invest->purpose_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Phone : </th>
                        <td>{{ $invest->date }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Address : </th>
                        <td>{{ $invest->amount }}</td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
