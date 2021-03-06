@extends('backend.layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Content Row -->
    
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-4 mt-5">
                <h2 class="text-primary"> Project Collection</h2>
            </div>
            <!-- Pending Requests Card Example -->
            @foreach($projects as $project)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <a href="{{route('projects.clients_Report', $project->id)}}" style="text-decoration: none">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    @if(Auth::guard('admin')->user()->can('role.view'))
                                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                            {{$project->project_name}} </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @php
                                            $total =0;
                                            $final='';
                                            $clients = \Illuminate\Support\Facades\DB::table('clients')->where('project_id',$project->id)->get() @endphp
                                            @foreach($clients as $client)
                                                @php $final = \App\ClientPayment::all()->where('client_id',$client->id)->sum('amount');
                                                 $total = $total+$final @endphp
                                            @endforeach

                                            {{number_format($total,2)}}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
