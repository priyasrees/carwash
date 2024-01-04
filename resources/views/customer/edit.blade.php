@extends('layouts.app')

@section('title')
Customer | Modify
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
                            <h4 class="mb-sm-0">Car Details</h4>

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


                                <form method="post" action="{{ route('customers.update',$customer->id) }}" autocomplete="off">
                                    @method('put')
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <label for="customer" class="form-label">Customer<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="customer" id="customer" class="form-control"
                                                required value="{{ $customer->customer }}">
                                            @if ($errors->has('customer'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('customer') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="email" class="form-label">Email<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                required value="{{ $customer->email }}">
                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="mobile" class="form-label">Mobile No<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" min="0" title="Accept Only Number" name="mobile" id="mobile" class="form-control"
                                                required value="{{ $customer->mobile }}">
                                            @if ($errors->has('mobile'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('mobile') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 mt-3">
                                            <label for="address" class="form-label">Address <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="address" id="address" class="form-control"
                                                required>{{$customer->address}}</textarea>
                                            @if ($errors->has('address'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('address') }}
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
