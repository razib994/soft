@extends('backend.layouts.master')
@section('title')
    Payment List
@endsection
@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Payment</h1>

        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>
                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Payment List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        <tr>
                            <td>asdf</td>
                            <td>asd</td>
                            <td>asdf</td>
                            <td>
                            asdf
                            </td>
                            <td>


{{--                                <form action="{{route('users.destroy', $user->id)}}" method="POST">--}}
{{--                                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" onclick="return confirm('Are You Sure Deleted This User!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>--}}
{{--                                </form>--}}
                            </td>
                        </tr>
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
