@extends('backend.layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <h2 class="text-success"> Project Expernditure</h2>
            </div>
            <!-- Pending Requests Card Example -->
            @foreach($projects as $project)
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{route('projects.indivisual_Report', $project->id)}}" style="text-decoration: none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                @if(Auth::guard('admin')->user()->can('role.view'))
                                    <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                                        {{$project->project_name}} </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format(\App\ProjectPayment::all()->where('project_id',$project->id)->sum('amount'),2) }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
        <!-- Content Row -->
        
    </div>
    <!-- /.container-fluid -->
@endsection
