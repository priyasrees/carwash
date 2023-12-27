@extends('layouts.app')

@section('title')Package | List
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

    #package_table td:nth-child(5) {
        white-space: normal !important;
        max-width: 200px;
        /* Set your desired fixed width */
        overflow: auto;
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
                        <h4 class="mb-sm-0">Package</h4>

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
                                    <a class="btn btn-primary add-btn" href="{{route('packages.create')}}">
                                        <i class="ri-add-line align-bottom me-1"></i> Add</a>
                                </div>
                            </div>



                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                @if(session()->has('message'))
                                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <script>
                                    setTimeout(function() {
                                        $('#success-alert').hide();
                                    }, 2000);

                                </script>
                                @endif

                                <div class="table-responsive">
                                    <table class="table align-middle table-bordered " id="package_table" style="margin-top: 2em!important">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sno</th>
                                                <th>Package</th>
                                                <th>Amount</th>
                                                <th>Valid</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($package as $key => $value)

                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$value['package_name']}}</td>
                                                <td>{{$value['package_amount']}}</td>
                                                {{-- <td>
                                                    @php
                                                    $carService = \App\Models\Carservice::find($value['car_service']);
                                                    @endphp
                                                    {{$carService->car_service_name}}
                                                </td> --}}
                                                <td>
                                                    {{$value['validity'] == 0 ? ($value['valid_days'] == 1 ? $value['valid_days'].' Month' : $value['valid_days'].' Months') : ($value['valid_days'] == 1 ? $value['valid_days'].' Year' : $value['valid_days'].' Years')}}
                                                </td>


                                                <td>

                                                    <div class="d-flex gap-2">
                                                        {{-- <div class="view">
                                                        <button class="btn btn-sm btn-success view-item-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i></button>
                                                    </div> --}}
                                                        <div class="edit">
                                                            <a href="{{route('packages.edit',$value['id'])}}" class="btn btn-sm btn-success edit-item-btn" data-index="{{ $key }}" data-id="{{$value['id']}}" title="Edit">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a>
                                                        </div>
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-id="{{$value['id']}}" data-bs-target="#deleteRecordModal" data-bs-placement="top" title="Delete">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted" style="color:white!important"></i> </button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-2 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#25a0e2,secondary:#00bd9d" style="width:100px;height:100px"></lord-icon>
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

        </div>
        <!-- container-fluid -->
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#package_table").DataTable();
        var recordIdToDelete;


        // Show modal when delete button is clicked
        $('.remove-item-btn').on('click', function() {
            recordIdToDelete = $(this).data('id');
            $('#deleteRecordModal').modal('show');
        });
        $('#delete-record').on('click', function() {
            $.ajax({
                url: "{{ url('/packages') }}/" + recordIdToDelete
                , type: 'DELETE'
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    $('#deleteRecordModal').modal('hide');
                    alert("Record Deleted");
                    window.location.reload();

                }
                , error: function(error) {
                    // Handle error
                    console.error('Error deleting record:', error);
                }
            });
        });

    });

</script>
@endsection

