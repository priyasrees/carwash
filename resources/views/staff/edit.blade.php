@extends('layouts.app')

@section('title')
Staff | Modify
@endsection
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

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
    .select2-container .select2-selection--multiple .select2-selection__choice{
        color:white!important;
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
                        <h4 class="mb-sm-0">Staff</h4>

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


                            {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif --}}


                        <form method="post" action="{{ route('staff.update',$staff->id) }}" autocomplete="off">
                         @method('put')
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-lg-4">
                                    <label for="staff" class="form-label">Staff<span class="text-danger">*</span></label>
                                    <input type="text" name="staff" id="staff"
                                    class="form-control" required value="{{ $staff->staff }}">
                                    @if ($errors->has('staff'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('staff') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="col-lg-4">
                                    <label for="mobile" class="form-label">Mobile No<span class="text-danger">*</span></label>
                                    <input type="number" min="0" title="Accept Only Number"
                                    name="mobile" id="mobile" class="form-control" required
                                    value="{{ $staff->mobile }}">
                                    @if ($errors->has('mobile'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('mobile') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" id="address" class="form-control" required>{{$staff->address}}</textarea>
                                    @if ($errors->has('address'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('address') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label for="address" class="form-label"> Customer <span class="text-danger">*</span></label>
                                    <select class="form-control" multiple="multiple" id="customer" name="customer_id[]">
                                        <option value="">Select</option>
                                        @foreach($customer as $key => $value)
                                        <option value="{{ $value['id'] }}" {{ $staff->customer_id == $value['id'] ? 'selected' : '' }}>
                                            {{ $value['customer'] }}
                                        </option>
                                    @endforeach
                                    </select>
                                    @if ($errors->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('error') }}
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
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
     //$('#customer').select2().select2('val', ['1','2'])
     $('#customer').select2();
     $('#customer').val([{{$staff->customer_id}}]).change();
</script>
@endsection

