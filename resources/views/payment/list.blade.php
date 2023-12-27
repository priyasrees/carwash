@extends('layouts.app')

@section('title')Payment | List
@endsection
<style>
    *{
        font-family: 'Poppins', 'Helvetica', sans-serif;
        font-size: 14px;

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
                        <h4 class="mb-sm-0">Payment</h4>

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
                            <h4 class="card-title mb-0">List</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">

                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                {{-- <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th> --}}
                                                <th class="sort" data-sort="customer_name">Sno</th>
                                                <th class="sort" data-sort="email">Customer</th>
                                                <th class="sort" data-sort="phone">Payment</th>
                                                <th class="sort" data-sort="date">Payment Date</th>
                                                <th class="sort" data-sort="status">Payment Type</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
<tr>
<td>1</td>
<td>Priya</td>
<td>15000</td>
<td>12.11.2023</td>
<td>Cash</td>
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

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="javascrpit:void(0)">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0);">
                                            Next
                                        </a>
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
@endsection