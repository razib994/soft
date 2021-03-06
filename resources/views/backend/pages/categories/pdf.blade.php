<div class="container-fluid">
    <h1> Theme Engineer Ltd. </h1>
    <p> Category List </p>
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
                <div class="table-responsive table-bordered">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <td class="text-left"> <strong>Sl</strong></td>
                            <td class="text-left"> <strong>Category Name</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach($categories as $category)
                            <tr>
                                <td> {{ $i++ }} </td>
                                <td> {{ $category->category_name  }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

