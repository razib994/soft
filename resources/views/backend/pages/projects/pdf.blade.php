    <div class="container-fluid">
        <h1> Theme Engineer Ltd. </h1>
        <p> Project Name </p>
        <!-- DataTales Example -->
        <style>
            tr th {
                font-size: 12px;
            }
            tr td {
                font-size: 12px;
            }
        </style>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <td> <strong>Sl</strong> </td>
                            <td> <strong>Project Name</strong></td>
                            <td> <strong>Project Address</strong> </td>
                            <td> <strong>Date</strong> </td>
                            <td style="text-align: right !important;"> <strong>Amount</strong> </td>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $project->project_name }}  </td>
                            <td>{{ $project->project_address }}</td>
                            <td>{{ $project->date }}</td>
                            <td style="text-align: right !important;">{{ number_format(\App\ProjectPayment::all()->where('project_id',$project->id)->sum('amount'),2) }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

