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
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <td>Sl</td>
                            <td><strong>Project Name</strong></td>
                            <td><strong>Client Name</strong> </td>
                            <td><strong>Phone</strong></td>
                            <td><strong>Address </strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $i++  }}</td>
{{--                            <td>{{ $client->project->project_name }}</td>--}}
                            <td>{{ $client->project->project_name }}</td>
                            <td>{{ $client->client_name  }}</td>
                            <td>{{ $client->phone  }}</td>
                            <td>{{ $client->address  }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

