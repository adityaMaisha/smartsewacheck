@extends('admin.layout.master') @section('style')
<style>
    .main-wrapper .page-wrapper .page-content {
        flex-grow: 1;
        padding: 25px;
        margin-top: 60px;
        background: #fff;
    }

    form small {
        color: #666;
        font-size: 10px;
    }

    .select2-container .select2-selection--single,
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 4px;
    }

    .form-control,
    .select2-container--default .select2-search--dropdown .select2-search__field,
    .typeahead.tt-hint,
    .typeahead.tt-input {
        display: block;
        width: 100%;
        height: 45px;
        padding: 0.469rem 0.8rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #000;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e9ecef;
        appearance: none;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .pass2,
    .pass2 {
        position: relative;
    }

    .toggle-password,
    .toggle-password1 {
        position: absolute;
        right: 15px;
        top: 45px;
        font-size: 14px;
        color: #757575;
        cursor: pointer;
    }

    div#ErrMsg {
        font-size: 10px;
        font-weight: 500;
        color: red;
        margin-top: 0;
        margin-bottom: 10px;
    }
    input:checked+label.payment-cards {
        border-color: var(--primary-bg-color) !important;
        position: relative !important;
        display: block !important;
        border-width: 1px;
        color: var(--primary-bg-color);
    }
    .payment-type input:checked+label:before {
        content: "\f00c";
        z-index: 999;
        position: absolute;
        right: -16px;
        top: -13px;
        padding: 0px 12px;
        font-size: 11px;
        color: #ffffff;
        font-weight: bold;
        background-color: #093a81;
        border-radius: 50%;
        font-family: "Font Awesome 6 Free";
    }
    .payment-type input {
        display: none;
    }
    .payment-type label {
        height: fit-content;
        border: 1px solid #093a81;
        background-color: #f0f0f0;
        padding: 0px !important;
        font-size: 10px;
        line-height: 33px;
        max-width: 150px !important;
    }
    .quotes{
        display: none;
    }
</style>
@endsection @section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <form action="{{ route('new.customer') }}" method="POST" enctype="multipart/form-data" id="htmlForm">
                @csrf

                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Add New customer</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('list.customers') }}">Customers</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Product customer</li>
                        </ol>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <a href="{{ route('list.customers') }}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Customer Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row row-sm mg-b-20">
                                    <div class="col-md-4">
                                        <p class="mg-b-10">First Name <b class="text-danger">*</b></p>
                                        <input
                                            class="form-control"
                                            placeholder="First Name"
                                            type="text"
                                            name="first_name"
                                            required
                                            pattern="[a-zA-Z ]*"
                                            title="Only Alphabet with Space Allow"
                                            onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"
                                        />
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Middle Name</p>
                                        <input
                                            class="form-control"
                                            placeholder="Middle Name"
                                            type="text"
                                            name="middle_name"
                                            pattern="[a-zA-Z ]*"
                                            title="Only Alphabet with Space Allow"
                                            onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"
                                        />
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Last Name</p>
                                        <input
                                            class="form-control"
                                            placeholder="Last Name"
                                            type="text"
                                            name="last_name"
                                            pattern="[a-zA-Z ]*"
                                            title="Only Alphabet with Space Allow"
                                            onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"
                                        />
                                    </div>

                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Gender <b class="text-danger">*</b></p>
                                        <div class="form-group">
                                            <select name="gender" class="form-control select2" required>
                                                <option value="">Default Select</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <span class="text-danger ERROR__gender"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mt-3 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">Date of birth</p>
                                        <div class="mg-b-20">
                                            <div class="input-group">
                                                <div class="input-group-text border-end-0">
                                                    <i class="fe fe-calendar lh--9 op-6"></i>
                                                </div>
                                                <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" name="date_of_birth" />
                                            </div>
                                            <span class="text-danger ERROR__date_of_birth"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mt-3 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Blood Group</p>
                                        <div class="form-group">
                                            <select name="blood_group" class="form-control select2">
                                                <option value="">Select Blood Group</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Email Address <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Email Address" type="text" required name="email_address" readonly onfocus="this.removeAttribute('readonly');" />
                                        <span class="text-danger ERROR__email_address"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Mobile Number <b class="text-danger">*</b></p>
                                        <input
                                            class="form-control"
                                            type="text"
                                            required
                                            name="mobile_number"
                                            readonly
                                            onfocus="this.removeAttribute('readonly');"
                                            pattern="[0-9]{10}"
                                            title="Please enter exactly 10 digits"
                                            placeholder="10 Digit Mobile Number"
                                            onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"
                                            maxlength="10"
                                        />
                                        <span class="text-danger ERROR__mobile_number"></span>
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Login Password <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Login Password" type="password" required name="login_password" />
                                        <span class="text-danger ERROR__login_password"></span>
                                    </div>

                                    <div class="col-lg-6 mt-3">
                                        <p class="mg-b-10">Address <b class="text-danger">*</b></p>
                                        <textarea class="form-control" name="address" id="" cols="3" rows="3" placeholder="Enter Full Address"></textarea>
                                        <span class="text-danger ERROR__address"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <p class="mg-b-10">Pin <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Pin Code" type="number" required name="pin_code" />
                                        <span class="text-danger ERROR__pin_code"></span>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <div class="payment-type">
                                            <input class="form-check-input" type="checkbox" id="is_eco" onclick="is_eco()">
                                            <label class="paypal-label payment-cards four col" for="is_eco"><span class="">Is Economically Weaker?</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info mg-b-0 quotes" role="alert">
                                    <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
                                    </button>
                                    <strong>Some Quotes for Economical Weaker</strong> 
                                </div>
                                <div class="row mt-3 mb-4">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary my-2 btn-icon-text">Add New customer <i class="fa fa-add"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    function is_eco()
    {
        var eco_text = $('#is_eco').val();
        if ($("input[type=checkbox]").prop(":checked"))
        {
            $('.quotes').css('display','block');
        }else{
            $('.quotes').css('display','none');
        }
    }

    $(document).on("submit", "#htmlForm", function (ev) {
        ev.preventDefault();
        var frm = $("#htmlForm");
        var form = $("#htmlForm")[0];
        var data = new FormData(form);

        $.ajax({
            type: frm.attr("method"),
            url: frm.attr("action"),
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            async: false,
            cache: false,
            data: data,
            beforeSend: function () {
                $('span[class*="ERROR__"]').html("");
                $("body").css("pointer-events", "none");
            },
            success: function (data) {
                if (data.success == true) {
                    python(data.message, "Great");
                    setTimeout(function() {
                        location.href = "{{ route('list.customers') }}";
                    }, 1000);
                } else {
                    python(data.message, "Whoops!", "red");
                    $.each(data.errors, function (field, message) {
                        $(".ERROR__" + field).html('<div class="text-danger">' + message + "</div>");
                    });
                }
            },
            error: function (err) {
                //
            },
            complete: function (data) {
                $(function () {
                    htmlError();
                    $("body").css("pointer-events", "auto");
                });
            },
        });
    });
</script>
@endsection
