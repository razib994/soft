    <div class="container-fluid">
        <h1> Theme Engineer Ltd. </h1>
        <p> Item Particular </p>
        <!-- DataTales Example -->
        <style>
            tr th {
                font-size: 11px;
            }
            tr td {
                font-size: 11px;
            }
        </style>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Category Name</th>
                            <th>Item Particular Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($items as $item)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $item->category->category_name  }} </td>
                            <td> {{ $item->items_name }} </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
