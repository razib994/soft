
    <div class="container-fluid">
        <h2> Theme Engineer Ltd. </h2>
        <p class="m-0 font-weight-bold text-primary">Project Wise Client Report </p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th> Sl</th>
                            <th> Project Name</th>
                            <th> Project Address </th>
                            <th> Date </th>
                            <th> Total Amount </th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $af =0;  $a =''; @endphp
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td><a class="text-primary" style=" text-decoration:none;" href="{{route('projects.clients_Report', $project->id)}}"> <b>{{ $project->project_name }} </b></a> </td>
                                <td>{{ $project->project_address }}</td>
                                <td>{{ $project->date }}</td>
                                <td>{{ number_format($a = \App\ProjectPayment::all()->where('project_id',$project->id)->sum('amount'),2) }}</td>
                                @php $af=$af+$a @endphp
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th> </th>
                            <th> </th>
                            <th> </th>
                            <th> </th>
                            <th> {{ number_format($af, 2) }}</th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
