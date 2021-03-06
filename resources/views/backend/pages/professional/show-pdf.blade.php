    <style>
        th {
            font-size: 10px;
        }
        td {
            font-size: 10px;
        }
    </style>
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> {{ $profession->profession_name }} Visitors List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

