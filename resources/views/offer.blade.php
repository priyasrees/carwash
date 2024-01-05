@extends('layouts.app')

@section('title')
    Dashboard
@endsection
<style>
    * {
        font-family: 'Poppins', 'Helvetica', sans-serif;
        font-size: 15px;

    }

    .auth-one-bg .bg-overlay,
    .btn-success {
        background: #FFDB58 !important;
        border: 1px solid yellow !important;
    }

    .fs-25 {
        font-size: x-large;
        /* font-stretch: normal; */

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
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                  <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Offer</h4>
{{--
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">List</li>
                            </ol>
                        </div> --}}

                    </div>
                </div>
            </div>
<div class="row">
    <div class="col-6">
        <label class="form-label" for="package">Package</label>
        <select class="form-control" id="package">
            <option value="">Select</option>

            @foreach($package as $key => $value)
<option value="{{$value->id}}">{{$value->package_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6">

<button type="button" name="search" class="btn btn-warning text-white mt-4">Search</button>
    </div>
</div>
<div class="row mt-4">
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
<td>aa</td>
<td>aa@gmail.com</td>
<td>7894561235</td>
<TD>ANNA NAGAR</TD>
<td>as</td>
</tr>
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

            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $("#customer_table").DataTable();

        });
        </script>
@endsection
