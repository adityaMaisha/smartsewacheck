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
    .end_cust{
        display: none;
    }
</style>
@endsection @section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">


            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Business Client Service</h2>
                    {{-- <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Path Lab List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Path Lab Vendor</li>
                    </ol> --}}
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ url()->previous() }}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <form action="{{route('update.businessClientslist',encrypt($editData->_id))}}" method="POST" enctype="multipart/form-data" id="formData">
                @csrf

                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Service Details</h6>
                            </div>
                            <div class="alert alert-danger d-none" id="errorMessage"></div>
                            <div class="card-body">

                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Service Name <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Service Name" type="text" name="service_name" id="service_name" value="{{$editData->service_name}}">
                                        <span class="text-danger ERROR__employee_first_name"></span>
                                    </div>

                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">State </p>
                                        <div class="form-group ">
                                            <select name="bus_client_state" id="bus_client_state" class="form-control">
                                                <option value="" selected>Select State</option>
                                                <option value="Delhi"{{$editData->bus_client_state=="Delhi"?'selected':''}}>Delhi</option>
                                            </select>
                                            <span class="text-danger ERROR__bus_client_state"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">City </p>
                                        <div class="form-group ">
                                            <select name="bus_client_city" id="bus_client_city" class="form-control">
                                                <option value="" selected>Select City</option>
                                                <option value="New Delhi"{{$editData->bus_client_city=="New Delhi"?'selected':''}}>New Delhi</option>
                                            </select>
                                            <span class="text-danger ERROR__bus_client_city"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Category </p>
                                        <div class="form-group ">
                                            <select name="service_category" id="service_category" class="form-control select2">
                                                <option value="preventive health checkup"{{$editData->service_category=="preventive health checkup"?'selected':''}}>Preventive health checkup</option>
                                                <option value="DHP"{{$editData->service_category=="DHP"?'selected':''}}>DHP</option>
                                                <option value="Subscription"{{$editData->service_category=="Subscription"?'selected':''}}>Subscription</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Mode of delivery </p>
                                        <div class="form-group ">
                                            <select name="del_mode" id="del_mode" class="form-control">
                                                <option value="At store"{{$editData->del_mode=="At store"?'selected':''}}>At store</option>
                                                <option value="at home"{{$editData->del_mode=="at home"?'selected':''}}>at home</option>
                                                <option value="digital"{{$editData->del_mode=="digital"?'selected':''}}>digital</option>
                                            </select>
                                            <span class="text-danger ERROR__del_mode"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">servicable pin codes <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="servicable pin codes" type="text" name="ser_pin_code" id="ser_pin_code" value="{{$editData->ser_pin_code}}">
                                        <span class="text-danger ERROR__ser_pin_code"></span>
                                    </div>
                                </div>
                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Time cosume per customer </p>
                                        <div class="form-group ">
                                            <select name="time_consume_customer" id="time_consume_customer" class="form-control select2">
                                                <option value="minutes"{{$editData->time_consume_customer=="minutes"?'selected':''}}>minutes</option>
                                                <option value="seconds"{{$editData->time_consume_customer=="seconds"?'selected':''}}>seconds</option>
                                            </select>
                                            <span class="text-danger ERROR__time_consume_customer"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Number of customer can be engaged/day <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Number of customer can be engaged/day" type="text" name="cust_eng_day" value="{{$editData->cust_eng_day}}">
                                        <span class="text-danger ERROR__cust_eng_day"></span>
                                    </div>
                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Per customer cost <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Per customer cost" type="text" name="per_cust_cost" value="{{$editData->per_cust_cost}}">
                                        <span class="text-danger ERROR__per_cust_cost"></span>
                                    </div>

                                    <div class="col-lg-12 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Details <b class="text-danger">*</b></p>
                                        <textarea class="form-control" placeholder="Details" type="text" name="description">{{$editData->description}}</textarea>
                                        <span class="text-danger ERROR__employee_last_name"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Select Customer</h6>
                            </div>
                            <div class="card-body">
                                <div class="row row-sm">
                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Select Vendor Type <b class="text-danger">*</b></p>
                                        <div class="form-group ">
                                            <select name="bus_client_customer_vendor" id="bus_client_customer_vendor" class="form-control">
                                                <option value="" selected>Select</option>
                                                <option value="Hospital & Others"{{$editData->bus_client_customer_vendor=="Hospital & Others"?'selected':''}}>Hospital & Others</option>
                                                <option value="Doctor & Others"{{$editData->bus_client_customer_vendor=="Doctor & Others"?'selected':''}}>Doctor & Others</option>
                                            </select>
                                            <span class="text-danger ERROR__bus_client_customer_vendor"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Select Vendor Name <b class="text-danger">*</b></p>
                                        <div class="form-group ">
                                            <select name="bus_client_customer_vendorname" id="bus_client_customer_vendorname" class="form-control">
                                                <option value="" selected>Select</option>
                                                <option value="AIMS"{{$editData->bus_client_customer_vendorname=="AIMS"?'selected':''}}>AIMS</option>
                                                <option value="MAX"{{$editData->bus_client_customer_vendorname=="MAX"?'selected':''}}>MAX</option>
                                            </select>
                                            <span class="text-danger ERROR__bus_client_customer_vendorname"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Use For The End Customer<b class="text-danger">*</b></p>
                                        <div class="form-group ">
                                            <select name="is_end_cust" id="is_end_cust" class="form-control">
                                                <option value="" selected>Select</option>
                                                <option value="Yes"{{$editData->is_end_cust=="Yes"?'selected':''}}>Yes</option>
                                                <option value="No"{{$editData->is_end_cust=="No"?'selected':''}}>No</option>
                                            </select>
                                            <span class="text-danger ERROR__is_end_cust"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Activation time</h6>
                            </div>
                            <div class="card-body">

                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Start date & time <b class="text-danger">*</b></p>
                                        <input class="form-control" type="datetime-local" name="startDateTime" value="{{$editData->startDateTime}}">
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">End date & time <b class="text-danger">*</b></p>
                                        <input class="form-control" type="datetime-local" name="endDateTime" value="{{$editData->endDateTime}}">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Row -->
                <div class="row mt-3 mb-4">
                    <div class="col-12 text-center">
                        <input type="submit" class="btn btn-primary my-2 btn-icon-text" style="color: white;"
                            value="&nbsp; Edit Business Client Service &nbsp;">
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

@endsection @section('script')
@section('script')
    <script>
        function open_end_customer(val)
        {
            if(val == "Yes")
            {
                $('.end_cust').css('display','block');
            }else{
                $('.end_cust').css('display','none');
            }
        }
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getDynamicStates() {

            var country_id = $('select#user_country').val();
            $.ajax({
                type: 'POST',
                url: "{{ route('states.ajax') }}",
                //dataType:'json',
                data: {
                    country_id: country_id
                },
                beforeSend: function() {

                    $('#user_state').html('');
                    $('#user_city').html('');

                },
                success: function(data) {


                    if (data.solve == true) {
                        $('#user_state').html(data.html_data);
                    }

                },
                error: function(err) {

                    var content_data = '<option value=""> Select State</option>';
                    $('#user_state').html(content_data);

                },
                complete: function() {

                    $(function() {
                        $('#user_state').select2();
                    });

                }
            });

        }


        function getDynamicCities() {

            var state_id = $('select#user_state').val();
            $.ajax({
                type: 'POST',
                url: "{{ route('cities.ajax') }}",
                //dataType:'json',
                data: {
                    state_id: state_id
                },
                beforeSend: function() {

                    $('#user_city').html('');

                },
                success: function(data) {

                    if (data.solve == true) {
                        $('#user_city').html(data.html_data);
                    }

                },
                error: function(err) {

                    var content_data = '<option value=""> Select City</option>';
                    $('#user_city').html(content_data);


                },
                complete: function() {

                    $(function() {
                        $('#user_city').select2();
                    });

                }
            });

        }


        // onLoad || onChange
        $(function() {
            $('#user_country').select2();
            // getDynamicStates();
            // getDynamicCities();
            $("select#user_country").change(getDynamicStates);
            $("select#user_state").change(getDynamicCities);
        });


        $(document).on('submit', '#formData', function(ev) {

            ev.preventDefault();
            var frm = $('#formData');
            var form = $('#formData')[0];
            var data = new FormData(form);

            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                data: data,
                beforeSend: function() {

                    $('span[class*="ERROR__"]').html("");
                    $('body').css('pointer-events', 'none');

                },
                success: function(data) {
                    window.location.href="/list-business-clients";
                    // if (data.success == true) {
                    //     python(data.message, 'Great');
                    // }else{
                    //     python(data.message, 'Whoops!', 'red');
                    //     $.each(data.errors, function (field, message) {
                    //         $(".ERROR__" + field).html('<div class="text-danger">' + message + "</div>");
                    //     });
                    // }

                },
                error: function(err) {

                    if(err.status==422){
                        const error = Object.entries(err.responseJSON.errors)[0][1];
                        $('#errorMessage').text(error);
                        if($('#errorMessage').hasClass('d-none')){
                            $('#errorMessage').removeClass('d-none');
                        }
                        $('html,body').animate({scrollTop:0},'slow');
                        setTimeout(() => {
                            $('#errorMessage').text('');
                            $('#errorMessage').addClass('d-none');
                        }, 4000);
                    }

                },
                complete: function(data) {

                    $(function() {
                        htmlError();
                        $('body').css('pointer-events', 'auto');
                    });

                }

            });

        });

    </script>
@endsection
