@extends('layouts.app')

@section('title')Packages | Add
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
                        <h4 class="mb-sm-0">Packages</h4>

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
                                <i class="ri-add-line align-bottom me-1"></i>Add
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

                            @if($errors->has('package_name'))
                            <div class="alert alert-danger">
                                {{ $errors->first('package_name') }}
                            </div>
                            @endif
                            <form method="post" action="{{route('packages.store')}}" autocomplete="off">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <label for="package_name" class="form-label">Package<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="package_name" id="package_name" class="form-control"
                                            required value="{{ old('package_name') ?? '' }}"
                                            placeholder="Enter Package Name">

                                    </div>
                                    <div class="col-lg-4">
                                        <label for="package_amount" class="form-label">Amount<span
                                                class="text-danger">*</span></label>
                                        <input type="number" min="0" name="package_amount" id="package_amount"
                                            class="form-control" required value="{{ old('package_amount') ?? '' }}"
                                            placeholder="Enter Package Amount">
                                        @if($errors->has('package_amount'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('package_amount') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Valid Through</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select class="form-control"  name="validity" required>
                                                    <option value="" {{ old('validity') == '' ? 'selected' : '' }}>Select</option>
                                                    <option value="0" {{ old('validity') == '0' ? 'selected' : '' }}>Months</option>
                                                    <option value="1" {{ old('validity') == '1' ? 'selected' : '' }}>Year</option>
                                                                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control" value="{{old('valid_days')}}" name="valid_days"
                                                    placeholder="Enter the validity days" min="0" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label class="form-label">Car Service<span class="text-danger">*</span></label>
                                        <select class="form-control" required name="car_service">
                                            <option value="">Select</option>
                                            @foreach($carservice as $key => $value)
                                            <option value="{{$value['id']}}" {{ old('car_service') == $key ? 'selected' : '' }}>
                                                {{$value['car_service_name']}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
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