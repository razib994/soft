@extends('frontend.layouts.master')
@section('title')
    Company Login - Admin Panel
@endsection
@section('content')
    <div class="container my-5 pt-5">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Company Login </h1>
                                    </div>
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger">
                                            <div>
                                                <p>{{ Session::get('error') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <form  class="user" method="POST" action="{{ route('admin.login.submit') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                   id="email"  name="email" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address...">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                   id="password"  name="password" aria-describedby="emailHelp"
                                                   placeholder="Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                                <a href="#" class="float-right" style="text-decoration: none;"> Forget Password </a>
                                            </div>

                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Login" name="submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
