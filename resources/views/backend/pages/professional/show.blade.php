@extends('backend.layouts.master')
@section('title')
    {{ $profession->profession_name }} Visitors List
@endsection
@section('content')
    <style>
        th {
            font-size: 14px;
        }
        td {
            font-size: 14px;
        }
    </style>
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
            <h1 class="h3 mb-0 text-gray-800">{{ $profession->profession_name }} Visitors List </h1>
            @if(Auth::guard('admin')->user()->can('visitor.create'))
                <a href="{{ url('admin/visitors/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> Create Visitors </a>
            @endif
            <form action="{{url('admin/profession-view',$profession->id)}}"  method="get">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="date" class="form-control " required name="start_date" id="start_date" placeholder="Start Date">
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" required name="end_date" id="end_date" placeholder="End Date">

                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Report</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                <a href="{{ url('admin/visitors') }}" class="btn btn-warning btn-sm"><i class="fas fa-backward " aria-hidden="true"></i> back</a>
                <a href="#" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{route('admin.profession',[$profession->id,$start_date, $end_date])}}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> {{ $profession->profession_name }} Visitors List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th> Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Profession</th>
                            <th>Land Description</th>
                            <th>Details</th>
                            <th>Personal Information</th>
                            <th>Date</th>
                            <th>Remark</th>
                            <th>Report</th>
                            <th>Contact Person Set </th>
                            <th>File </th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i=1; @endphp
                        @foreach($visitors as $visitor)
                            <tr>
                                <td> {{ $i++ }} </td>
                                <td> {{ $visitor->name  }} </td>
                                <td> {{ $visitor->email  }} </td>
                                <td> {{ $visitor->phone  }}  </td>
                                <td> @php $profesions = \App\Professional::where('id',$visitor->profession_id )->get();  @endphp @foreach($profesions as $pro) {{$pro->profession_name}} @endforeach  </td>
                                <td> <b class="text-danger">Land Loacation:</b> {{ $visitor->area  }} </td>
                                <td> <b class="text-danger">Land Area: </b>{{ $visitor->land  }}<b class="text-danger"> Width:</b>{{ $visitor->width  }} <b class="text-danger">Length: </b>{{ $visitor->height  }} <b class="text-danger">Storey:</b> {{ $visitor->store  }} <b class="text-danger">Demand:</b> {{ $visitor->demand  }}</td>
                                <td><b class="text-danger"> <b class="text-danger"> Organization:</b> {{ $visitor->organization  }} <b class="text-danger">Address:</b> {{ $visitor->address }}</td>
                                <td> {{ $visitor->date  }} </td>
                                <td> {{ $visitor->remark  }} </td>
                                <td> {{ $visitor->report  }} </td>
                                <td> {{ $visitor->contact_person  }}  </td>
                                <td> FILE: <a href="https://accounts.neezerbari.com/public/admin/{{ $visitor->check_file  }}" class="btn btn-primary btn-sm"> {{ $visitor->check_file  }} </a>  <br>
                                    PDF:<a href="https://accounts.neezerbari.com/public/admin/{{ $visitor->check_file_one  }}" class="btn btn-primary btn-sm"> {{ $visitor->check_file_one  }} </a> <br/>
                                    Excel/Word:  <a href="https://accounts.neezerbari.com/public/admin/{{ $visitor->check_file_two  }}" class="btn btn-primary btn-sm"> {{ $visitor->check_file_two  }} </a> </td>
                                <td>
                                    <form action="{{route('visitors.destroy', $visitor->id)}}" method="POST">
                                        @if(Auth::guard('admin')->user()->can('visitor.edit'))
                                            <a href="{{route('visitors.edit', $visitor->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                        @endif
                                        @if(Auth::guard('admin')->user()->can('visitor.delete'))
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are You Sure Deleted This Visitor!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
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
