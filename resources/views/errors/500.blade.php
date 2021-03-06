@extends('errors.layout')

@section('title')
    500
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid mt-5">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="500">500</div>
            <p class="lead text-gray-800 mb-5">Internal Server Error! </p>
            <a href="{{ url('/admin') }}">&larr; Back to Dashboard</a>
        </div>

    </div>
    <!-- /.container-fluid -->


    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
@endsection

