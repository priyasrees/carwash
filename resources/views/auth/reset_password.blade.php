@extends('layouts.auth.app')
@section('title')
    Forgot Password
@endsection
@section('content')

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="assets/images/logo-sm.png" alt="" height="40">
                                </a>
                            </div>
                            <p class="mt-3 fs-25 fw-medium">Reset Password</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Forgot Password?</h5>
                                    <p class="text-muted">Reset password</p>

                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
                                    </lord-icon>

                                </div>

                                <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                    Enter your email will be sent to you!
                                </div>
                                <div class="p-2">
                                    <form method="post" action="{{url('/send_passwordreset_mail')}}">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email"
                                            required id="email" placeholder="Enter Email" value="{{old('email')}}">
                                        </div>
@if($errors->has('mail_invalid'))
    <div class="alert alert-danger">
        {{$errors->first('mail_invalid')}}
    </div>
@endif
                                        <div class="text-center mt-4">
                                            <input type="submit" value="Send Reset Link" class="btn btn-success w-100" />
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Wait, I remember my password... <a href="{{url('signin')}}" class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        @include('layouts.auth.footer')
    </div>
    @endsection
