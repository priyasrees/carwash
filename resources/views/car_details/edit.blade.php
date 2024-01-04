@extends('layouts.app')

@section('title')Car  | Modify
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
                        <h4 class="mb-sm-0">Car Detail</h4>

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
                            @if($errors->has('error'))
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


                            <form method="post" action="{{route('cardetail.update',$cardetail->id)}}"
                                 autocomplete="off">
                                @method('put')
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <label for="car_name" class="form-label">Car<span class="text-danger">*</span></label>
                                        <input type="text" name="car_name" id="car_name" class="form-control" required  value="{{ $cardetail->car_name }}">
                                        @if($errors->has('car_name'))
                            <div class="alert alert-danger">
                                {{ $errors->first('car_name') }}
                            </div>
                            @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="car_name" class="form-label">Car Model<span class="text-danger">*</span></label>
                                        <input type="text" name="car_model" id="car_model" class="form-control" required  value="{{ $cardetail->car_model }}">
                                        @if($errors->has('car_model'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('car_model') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="car_type" class="form-label">Type<span class="text-danger">*</span></label>
                                        <select class="form-control" name="car_type" required>
                                            <option value="">Select</option>
                                            <option value="0" {{ $cardetail->car_type == "0"? 'selected':'' }}>Hatchback</option>
                                            <option value="1" {{ $cardetail->car_type == "1" ? 'selected':'' }}>Sedan</option>
                                            <option value="2" {{ $cardetail->car_type == "2" ? 'selected' :'' }}>Suv</option>
                                        </select>
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