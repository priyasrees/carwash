@extends('layouts.app')

@section('title')Car Service | Edit
@endsection
<style>
    * {
        font-family: 'Poppins', 'Helvetica', sans-serif;
        font-size:14px;

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
                        <h4 class="mb-sm-0">Car Service</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">List</li>
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
                                <i class="ri-edit-line align-bottom me-1"></i>Modify
                            </h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">

                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            @if($errors->has('car_service_name'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('car_service_name') }}

                            </div>
                            @endif
                            <form action="{{route('carservices.update',$carservice->id)}}" method="post" autocomplete="off">
                                @method('PUT')
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <label for="car_service" class="form-label">Car Service<span class="text-danger">*</span></label>
                                        <input type="text" name="car_service_name" id="car_service" class="form-control {{$errors->has('car_service')?'invalid-feedback':''}}" required
                                         value="{{ isset($carservice)?$carservice->car_service_name:old('car_service_name') }}">
                                        @if($errors->has('car_service'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('car_service') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="car_service" class="form-label">
                                            Description</label>
                                        <textarea class="form-control" name="description">{{isset($carservice)?$carservice->description:old('description')}}</textarea>

                                    </div>

                                </div>
                                <div class="row">
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