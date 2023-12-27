@extends('layouts.app')

@section('title')Car Service | List
@endsection
<style>
    * {
        font-family: 'Poppins', 'Helvetica', sans-serif;
        font-size: medium;
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

{{-- @if($errors->any())
@foreach($errors->all() as $error)
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
                        <h4 class="mb-sm-0">Car Service</h4>

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
                            @if(session()->has('message'))
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                    <table class="table align-middle table-bordered " id="customer_table" style="margin-top: 2em!important">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sno</th>
                                                <th>Car Service</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                     <tbody>
@foreach($carservice as $key => $value)
<tr>
    <td>{{$key+1}}</td>
    <td>{{$value['car_service_name']}}</td>
    <td> {{$value['description']}}</td>
    <td>

        <div class="d-flex gap-2">
            {{-- <div class="view">
                <button class="btn btn-sm btn-success view-item-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i></button>
            </div> --}}
            <div class="edit">
                <button class="btn btn-sm btn-success edit-item-btn" data-index="{{ $key }}" data-id="{{$value['id']}}" data-bs-toggle="modal" data-bs-target="#showModal" data-bs-placement="top" title="Edit">
                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i></button>
            </div>
            <div class="remove">
                <button class="btn btn-sm btn-danger remove-item-btn"
                 data-bs-toggle="modal" data-id="{{$value['id']}}" data-bs-target="#deleteRecordModal" data-bs-placement="top" title="Delete">
                 <i class="ri-delete-bin-fill align-bottom me-2 text-muted" style="color:white!important"></i> </button>
            </div>
        </div>
    </td>
</tr>
@endforeach


                                     </tbody>
                                    </table>
                                    <input type="hidden" id="clickedIndex" name="clickedIndex" value="{{ old('clickedIndex') }}">
                                    <input type="hidden" id="editMode" name="editMode" value="{{ old('editMode') }}">

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

<div class="modal fade" id="showModal" tabindex="-1" @if($errors->has('car_service')) style="display: block;" @endif aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ session('id') ? 'Edit Car Service' : 'Add Car Service' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="tablelist-form needs-validation validate-me" action="{{ route('carservices.store') }}" autocomplete="off" method="POST" novalidate>
                @csrf
                <div class="modal-body">
                    @if($errors->has('car_service'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('car_service') }}
                            @if(session('id'))
                                @php
                                    $carService = \App\Models\Carservice::find(session('id'));
                                @endphp
                            @endif
                        </div>
                    @endif

                    <div class="mb-3 form-group has-validation">
                        <label for="customername-field" class="form-label">Car Service</label>
                        <input type="hidden" id="id-field" name="id" value="0" />
                        <input type="text" id="car_service" name="car_service_name" class="form-control validate-me" placeholder="Enter Car Service" required value="{{ isset($carService) ? $carService->car_service_name : old('car_service_name') }}" />
                        <div class="invalid-feedback">Required</div>
                    </div>

                    <div class="mb-3">
                        <label for="email-field" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Enter description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">{{ isset($carService) ? 'Edit' : 'Add' }} Service</button>
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
        @if($errors->has('car_service'))
            $('#showModal').modal('show');
        @endif
// Reset validation when modal is closed
$('#showModal').on('hide.bs.modal', function () {
    form.find('.validate-me').removeClass('was-validated');
    form.find('.validate-me .invalid-feedback').hide();
});

// Reset validation when modal is opened
$('#showModal').on('show.bs.modal', function () {
    var modalForm = $(this).find('.tablelist-form');
    // Clear input values
    modalForm.find('.form-control').val("");
    $('.alert.alert-danger', modalForm).hide();
    // Reset validation state
    modalForm.removeClass('was-validated');
    modalForm.find('.form-control').removeClass('is-valid is-invalid');
    modalForm.find('.invalid-feedback').hide();
});

        $("#customer_table").DataTable();

        var form = $('.tablelist-form');

       form.on('submit', function (event) {
    var validateFields = form.find('.validate-me');
    var isValid = true;

    validateFields.each(function () {
        if (!this.checkValidity()) {
            isValid = false;
            var feedbackElem = $(this).siblings('.invalid-feedback');
            if (feedbackElem.length > 0) {

                feedbackElem.show();
            }
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else {

            // If the field is not empty, apply 'was-validated' class
            if ($(this).val().trim() !== '') {
                $(this).addClass('is-valid').removeClass('is-invalid');
                $(this).addClass('was-validated');
                var feedbackElem = $(this).siblings('.invalid-feedback');
            if (feedbackElem.length > 0) {
                feedbackElem.hide();
            }
            }
        }
    });

    if (!isValid) {
        event.preventDefault();
        event.stopPropagation();
    }
});
var recordIdToDelete;        var recordIdToShow;


// Show modal when delete button is clicked
$('.remove-item-btn').on('click', function () {
    recordIdToDelete = $(this).data('id');
    $('#deleteRecordModal').modal('show');
});
$('#delete-record').on('click', function () {
            $.ajax({
                url: "{{ url('/cardetail') }}/" + recordIdToDelete,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#deleteRecordModal').modal('hide');
                    alert("Record Deleted");
                    window.location.reload();

                },
                error: function (error) {
                    // Handle error
                    console.error('Error deleting record:', error);
                }
            });
        });
       $(".edit-item-btn").click(function (e) {

    e.preventDefault();
            $('#clickedIndex').val(clickedIndex);
            $('#editMode').val(editMode);
    recordIdToShow = $(this).data('id');
$.ajax({
    type: "get",
    url: "{{ route('carservices.show', ':carservices') }}".replace(':carservices', recordIdToShow),
    dataType: "json",
    success: function (response) {
$("#car_service").val(response.carservice.car_service_name);
$("#description").val(response.carservice.description);
$("#exampleModalLabel").text("Edit Service");
$("#add-btn").text("Edit Service");
$("#id-field").val(response.carservice.id);
    }
});


});

    });
</script>
@endsection
