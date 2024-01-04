@extends('layouts.app')

@section('title')
    Assign Customer
@endsection
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

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
        /* font-stretch: normal; */
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

    .select2-container {
        z-index: 99999;
        /* Adjust the value accordingly */
    }

    .select2-dropdown {
        max-height: 200px;
        /* Adjust the value as needed */
        overflow-y: auto;
    }
</style>
@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Assign Customer To Staff</h4>

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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-10">
                                        <h4 class="card-title mb-0">Staff:{{ $get_customer_list->staff }}
                                        </h4>
                                    </div>
                                    <div class="col-2 text-end">
                                        <a class="btn btn-primary add-btn" href="{{ route('staff.assign_customer') }}">
                                            <i class="ri-down-arrow align-bottom me-1"></i> Back</a>
                                        {{-- <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> --}}

                                    </div>
                                </div>



                            </div><!-- end card header -->

                            <div class="card-body">
                                @if (session()->has('message'))
                                    <div id="success-alert" class="alert alert-success alert-dismissible fade show"
                                        role="alert">
                                        {{ session()->get('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <script>
                                        setTimeout(function() {
                                            // Close the modal
                                            // $('#myModal').modal('hide');
                                            // Close the alert
                                            $('#success-alert').hide();
                                        }, 3000); // Adjust the delay (in milliseconds)
                                    </script>
                                @endif
                                <div class="listjs-table" id="customerList">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-bordered " id="customer_table"
                                            style="margin-top: 2em!important">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Customer</th>
                                                    <th>Mobile</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $customer_id = [];
                                                @endphp
                                                @foreach ($customer as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $value['customer'] }}</td>
                                                        <td>{{ $value['mobile'] }}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="view">
                                                                    <button data-id="{{ $value['id'] }}"
                                                                        class="btn btn-sm btn-success view-item-btn text-dark reassign"
                                                                        data-bs-toggle="modal" data-bs-target="#showModal"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="ReAssign">
                                                                        <i
                                                                            class="mdi mid-account-switch align-bottom me-2 text-dark"></i>ReAssign</button>
                                                                </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
    </div>
    <!-- Assign Customer To Staff Modal -->

    <div class="modal fade" id="showModal" tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Assign Customer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form needs-validation validate-me" action="{{ url('assignstaff') }}"
                    autocomplete="off" method="POST" validate>
                    @csrf
                    <div class="modal-body">
                        @if ($errors->has('car_service'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('car_service') }}
                                @if (session('id'))
                                    @php
                                        $carService = \App\Models\Carservice::find(session('id'));
                                    @endphp
                                @endif
                            </div>
                        @endif

                        <div class="mb-3 form-group has-validation">
                            <label for="customername-field" class="form-label">Select Staff</label>
                            <input type="hidden" id="assigned_staff_id" name="assigned_staff_id"
                                value="{{ $id }}" />

                            <input type="hidden" id="customer_id" name="customer_id" value="0" />
                            <select class="form-control select2 staff" name="staff_id" id="staff" required>
                                <option value="">Select</option>
                                @foreach ($staff as $key => $value)
                                    <option value="{{ $value['id'] }}">{{ $value['staff'] }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Required</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Assign</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--end modal -->
    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#25a0e2,secondary:#00bd9d" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-primary" id="delete-record">Yes, Delete It!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0/dist/js/bootstrap-select.min.js"></script>

    <script>
        //    $('#staff').select2({
        //         placeholder: "Select Staff",
        //         theme: 'bootstrap-5'
        //     });




        $('.select2').each(function() {
            $(this).select2({
                theme: 'bootstrap-5',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: true,
                dropdownParent: $(this).parent(),
            });
        });
        $(document).ready(function() {

            $(".reassign").click(function(e) {
                e.preventDefault();
                // $('#select2-staff-container').select2('val', '');
                //    $("#staff").val(null).trigger('change');

                //$("#staff").select2("val","");
                $("#customer_id").val($(this).data('id'));
            });
            $("#customer_table").DataTable();
            var recordIdToDelete;
            // Show modal when delete button is clicked
            $('.remove-item-btn').on('click', function() {
                recordIdToDelete = $(this).data('id');
                $('#deleteRecordModal').modal('show');
            });
            $('#delete-record').on('click', function() {
                $.ajax({
                    url: "{{ url('/staff') }}/" + recordIdToDelete,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#deleteRecordModal').modal('hide');
                        alert("Record Deleted");
                        window.location.reload();

                    },
                    error: function(error) {
                        // Handle error
                        console.error('Error deleting record:', error);
                    }
                });
            });

        });
    </script>
@endsection
