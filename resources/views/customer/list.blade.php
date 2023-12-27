@extends('layouts.app')

@section('title')Customer | List
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
    /* font-stretch: normal; */
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
#customer_table td{
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
                        <h4 class="mb-sm-0">Customer</h4>

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
                                <div class="col-2 text-end">
                                            <button type="button" class="btn btn-primary add-btn"
                                            data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal">
                                            <i class="ri-add-line align-bottom me-1"></i> Add</button>
                                            {{-- <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> --}}

                                </div>
                            </div>



                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">


                                <div class="table-responsive">
                                    <table class="table align-middle table-bordered " id="customer_table" style="margin-top: 2em!important">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sno</th>
                                                <th>Customer</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                     <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh@gmail.com</td>
                                            <td>6156215826</td>
                                            <td>4/4512,Thillaivasal nagar vadapalani,chennai-Adayar-620215</td>
                                            <td>

                                                <div class="d-flex gap-2">
                                                    <div class="view">
                                                        <button class="btn btn-sm btn-success view-item-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i></button>
                                                    </div>
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal" data-bs-placement="top" title="Edit">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i></button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                         data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-bs-placement="top" title="Delete">
                                                         <i class="ri-delete-bin-fill align-bottom me-2 text-muted" style="color:white!important"></i> </button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" autocomplete="off">
                            <div class="modal-body">
                                <div class="mb-3" id="modal-id" style="display: none;">
                                    <label for="id-field" class="form-label">ID</label>
                                    <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Package Name</label>
                                    <input type="text" id="customername-field" class="form-control" placeholder="Enter Name" required />
                                    <div class="invalid-feedback">Please enter a package name.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Valid Through</label>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">

                                   <select class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="0">Months</option>
                                    <option value="1">Days</option>
                                   </select>
                                </div>
                                <div class="col-lg-9 col-md-6">
                                   <input type="number" min="0" max="10" class="form-control" name="days" required/>
                                </div>
                            </div>
                        </div>
                                <div class="mb-3">
                                    <label for="phone-field" class="form-label">Status</label>
                                    <select class="form-control" placeholder="Enter Phone no." required >
<option value="">Select</option>
<option value="0">Active</option>
<option value="1">InActive</option>

                                </select>
                                    {{-- <div class="invalid-feedback">Please enter a phone.</div> --}}
                                </div>

                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Comments</label>
                                    <textarea id="date-field" class="form-control"
                                    placeholder="" required ></textarea>
                                    <div class="invalid-feedback">Please select a date.</div>
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
        $("#customer_table").DataTable();
    });
    </script>
@endsection
