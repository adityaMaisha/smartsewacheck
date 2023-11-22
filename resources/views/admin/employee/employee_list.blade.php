@extends('admin.layout.master')
@section('style')
<style>
    .form-check-input:checked {
    background-color: #093a81;
    border-color: #093a81;
}
input.form-check-input:focus {
    box-shadow: none;
}
</style>
@endsection
@section('content')
    <div class="main-content side-content pt-0">
        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Employees</h2>

                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">

                            {{-- <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                                <i class="fa fa-filter me-2"></i> Filter
                            </button> --}}

                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <a href="{{ route('new.employee') }}" style="color: white;"> <i class="fa fa-add me-2"></i> Add New Employee</a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="table-responsive" id="htmlBody"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->

            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function getRecords() {
    $.ajax({
        type: "POST",
        url: "{{ route('list.employee') }}",
        success: function (data) {
            if (data.success == true) {
                $("#htmlBody").html(data.data);
            } else {
                $("#htmlBody").html(data.data);
            }
        },
        error: function (err) {
            //
        },
        complete: function () {
            $("#dataTable").dataTable();
        },
    });
}

$(function () {
    getRecords();
});

function ItemStatusToggle($uid) {
    $.ajax({
        type: "GET",
        url: "{{ route('action.employee') }}",
        dataType: "json",
        data: { uid: $uid },
        beforeSend: function () {
            $("body").css("pointer-events", "none");
        },
        success: function (data) {
            if (data.success == true) {
                python("Changes saved!", "Great");
            } else {
                python("Changes failed", "Whoops!", "red");
            }
        },
        error: function (err) {
            //
        },
        complete: function () {
            $("body").css("pointer-events", "auto");
        },
    });
}

function ItemRemove($uid) {
    Swal.fire({
        title: "Are you sure?",
        text: "Are you sure you want to remove this item? Click 'Yes' to confirm, or 'No' to keep the item.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        confirmButtonColor: "#2778c4",
        cancelButtonText: "No, cancel!",
        reverseButtons: true,
        allowOutsideClick: false,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "{{ route('action.employee') }}",
                dataType: "json",
                data: { uid: $uid },
                beforeSend: function () {
                    $("body").css("pointer-events", "none");
                },
                success: function (data) {
                    if (data.success == true) {
                        python("Item Removed!", "Great");
                    } else {
                        python("Remove failed", "Whoops!", "red");
                    }
                },
                error: function (err) {
                    //
                },
                complete: function () {
                    $(function () {
                        getRecords();
                        $("body").css("pointer-events", "auto");
                    });
                },
            });
        }
    });
}
</script>
@endsection
