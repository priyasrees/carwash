@extends('layouts.app')

@section('title')Order  | Order Details
@endsection
<style>
    *{
        font-family: 'Poppins', 'Helvetica', sans-serif;
        font-size:14px;

    }
    .auth-one-bg .bg-overlay, .btn-success{
        background: #FFDB58 !important;
        border: 1px solid yellow !important;
    }
    .fs-25{
        font-size: x-large;
        color: lightgoldenrodyellow;
    }
    .text-primary{
        color: #FFDB58 !important;
    }
    .btn-primary{
        background: #FFDB58 !important;
    border: 1px solid yellow !important;
    color: #635f5f!important;
    }
  .breadcrumb-item a{
    text-decoration: none;
    color: #FFDB58!important;
   }
  #package_table td:nth-child(5){
    white-space: normal!important;
    max-width: 200px; /* Set your desired fixed width */
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
                        <h4 class="mb-sm-0">Order Details</h4>

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
                                <div class="col-10"> <h4 class="card-title mb-0">List
                                    </h4>
                                </div>

                            </div>



                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">


                                <div class="table-responsive">
                                    <table class="table align-middle table-bordered " id="package_table" style="margin-top: 2em!important">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sno</th>
                                                <th>Customer</th>
                                                <th>Service</th>
                                                <th>Order Date</th>
                                                <th>Package</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                     <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>Raj</td>
                                            <td>Whole Car Clean Service</td>
                                            <td>25.12.2023</td>
                                            <td>Premium Package</td>
                                            <td>7800</td>
                                            <td>

                                                <div class="d-flex gap-2">
                                                    <div class="view">
                                                        <button class="btn btn-sm btn-success view-item-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i></button>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                     </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#25a0e2,secondary:#00bd9d" style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                                orders for you search.</p>
                                        </div>
                                    </div>
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

            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">Book A Car Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" autocomplete="off">
                            <div class="modal-body">
                                <div class="mb-3" id="modal-id" style="display: none;">
                                    <label for="id-field" class="form-label">ID</label>
                                    <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Select Car</label>
                                    <select class="form-control" required>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Select Car Service</label>
                                    <select class="form-control" required>
                                        <option value="">Select</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Package</label>
                                    <input type="text" id="package" class="form-control" placeholder="" disabled readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Amount</label>
                                    <input type="text" id="package_amount" class="form-control" placeholder="" disabled readonly />
                                </div>


                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Choose Service Date&Time</label>
                                    <input type="datetime-local" id="service_date" class="form-control" placeholder="" />
                                </div>

                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Location</label>
                                    <input type="text" id="customer_location" class="form-control" placeholder="" />

                                </div>



                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Add Customer</button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
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

    $(document).ready(function () {
        $("#package_table").DataTable();
    });
    </script>
@endsection
