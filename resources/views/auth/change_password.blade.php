@extends('layouts.app')
@section('title')
    Change Password
@endsection
<style>
    * {
        font-family: 'Poppins', 'Helvetica', sans-serif;
        font-size: 14px;

    }

    .auth-one-bg .bg-overlay,
    .btn-success {
        background: #FFDB58 !important;
        border: 1px solid yellow !important;
    }

    .fs-25 {
        font-size: x-large;
        color: lightgoldenrodyellow;
    }

    .text-primary {
        color: #FFDB58 !important;
    }

    .btn-primary {
        background: #FFDB58 !important;
        border: 1px solid yellow !important;
        color: #635f5f !important;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #FFDB58 !important;
    }

    #customer_table td {
        white-space: normal !important;
        max-width: 200px;
        /* Set your desired fixed width */
        overflow: auto;
    }
</style>
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Change Password</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><a href="{{url('/')}}">Dashboard</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">
                                <i class="mdi mdi-lock me-1"></i>Reset Password
                            </h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">

                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            @if ($errors->has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('error') }}
                                </div>
                            @endif

                           {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif --}}
                            @if (session()->has('message'))
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show"
                                role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <script>
                                setTimeout(function() {
                                    $('#success-alert').alert('close');
                                }, 2000);
                            </script>
                             @endif
                            <form class="needs-validation"
                             novalidate method="post" action="{{ route('auth.reset_password') }}" autocomplete="off">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <label class="form-label" for="old_password">Old Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" name="old_password" required
                                            class="form-control pe-5 password-input @error('old_password') is-invalid @enderror"
                                             placeholder="Enter password" id="old_password" title="Password Must Have 8 alphanumericcharacters"
                                              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onpaste="return false"
                                              autocomplete="current-password" value="{{old('old_password')}}">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            @if ($errors->has('old_password'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('old_password') }}
                                            </div>
                                        @endif
                                        @if ($errors->has('wrong_password'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('wrong_password') }}
                                        </div>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label" for="new_password">New Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" name="new_password" required class="form-control pe-5
                                            password-input @error('new_password') is-invalid @enderror" value="{{old('new_password')}}"
                                             placeholder="Enter password" id="new_password" autocomplete="current-password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            @if ($errors->has('new_password'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('new_password') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label" for="confirm_password">Confirm Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" name="confirm_password" required class="form-control pe-5
                                             password-input @error('confirm_password') is-invalid @enderror"
                                             placeholder="Enter password" id="confirm_password" value="{{old('confirm_password')}}" autocomplete="current-password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            @if ($errors->has('confirm_password'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('confirm_password') }}
                                            </div>
                                        @endif
                                        @if ($errors->has('Mismatch'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('Mismatch') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <input type="submit" class="btn btn-outline-info btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>

    </div>
    <!-- container-fluid -->
</div>
@endsection