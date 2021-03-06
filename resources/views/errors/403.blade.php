@extends('errors.layout')

@section('title')
    403
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid mt-5">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="403">403</div>
            <p class="text-gray-500 mb-0">{{ $exception->getMessage() }}</p>
            <a href="{{ url('/admin') }}">&larr; Back to Dashboard</a> &nbsp&nbsp&nbsp
            <a href="{{ url('/admin/login') }}"> Back to Login &rarr;</a>
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
