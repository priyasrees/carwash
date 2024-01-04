@extends('layouts.app')

@section('title')
    Cars | List
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
    {{-- @if ($errors->any())
@foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        {{$error}}
    </div>
@endforeach

@endif --}}
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
                            <h4 class="mb-sm-0">Cars</h4>

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
                                        <h4 class="card-title mb-0">List
                                        </h4>
                                    </div>
                                    <div class="col-2 text-end">
                                        <a class="btn btn-primary add-btn" href="{{ route('cardetail.create') }}">
                                            <i class="ri-add-line align-bottom me-1"></i> Add</a>
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
                                            $('#success-alert').alert('close');
                                        }, 2000); // Adjust the delay (in milliseconds) based on your needs
                                    </script>
                                @endif
                                <div class="listjs-table" id="customerList">


                                    <div class="table-responsive">
                                        <table class="table align-middle table-bordered " id="customer_table"
                                            style="margin-top: 2em!important">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Car</th>
                                                    <th>Model</th>
                                                    <th>Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cardetail as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $value['car_name'] }}</td>
                                                        <td> {{ $value['car_model'] }}</td>
                                                        <td>
{{$value['car_type'] == "0" ? 'Hatchback' : ($value['car_type'] == "1" ? 'Sedan' : 'Suv')}}



                                                        </td>
                                                        <td>

                                                            <div class="d-flex gap-2">
                                                                {{-- <div class="view">
                <button class="btn btn-sm btn-success view-item-btn" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="View">
                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i></button>
            </div> --}}
                                                                <div class="edit">
                                                                    <a href="{{ route('cardetail.edit', $value['id']) }}"
                                                                        class="btn btn-sm btn-success edit-item-btn"
                                                                        data-index="{{ $key }}"
                                                                        data-id="{{ $value['id'] }}" title="Edit">
                                                                        <i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>
                                                                </div>
                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal" data-id="{{ $value['id'] }}"
                                                                        data-bs-target="#deleteRecordModal"
                                                                        data-bs-placement="top" title="Delete">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"
                                                                            style="color:white!important"></i>
                                                                    </button>
                                                                </div>
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
                                        colors="primary:#25a0e2,secondary:#00bd9d"
                                        style="width:100px;height:100px"></lord-icon>
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>Are you sure ?</h4>
                                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn w-sm btn-primary" id="delete-record">Yes, Delete
                                        It!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal -->

            </div>
            <!-- container-fluid -->
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#customer_table").DataTable();
            var recordIdToDelete;


            // Show modal when delete button is clicked
            $('.remove-item-btn').on('click', function() {
                recordIdToDelete = $(this).data('id');
                $('#deleteRecordModal').modal('show');
            });
            $('#delete-record').on('click', function() {
                $.ajax({
                    url: "{{ url('/cardetail') }}/" + recordIdToDelete,
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
