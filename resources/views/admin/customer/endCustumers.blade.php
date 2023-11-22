@extends('admin.layout.master')
@section('style')
@endsection
@section('content')
    <div class="main-content side-content pt-0">
        <div class="main-container container-fluid">
            <div class="inner-body">

                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">End Customers</h2>
                        {{-- <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Employee</li>
                        </ol> --}}
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            {{-- <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <a href="{{ route('list.employee') }}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
                            </button> --}}
                        </div>
                    </div>
                </div>

                <form action="{{ route('new.endCustService') }}" method="POST" id="service_endcust">
                    @csrf

                    <div class="row row-sm">
                        <div class="col-lg-12 col-md-12">
                            <div class="card custom-card">
                                <div class="mb-4 hny_tt">
                                    <h6 class="main-content-label mb-1">Service Details</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Service Name <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Service Name" type="text" name="service_name" id="service_name" >
                                            <span class="text-danger ERROR__service_name"></span>
                                        </div>

                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Category </p>
                                            <div class="form-group ">
                                                <select name="service_category" id="service_category" class="form-control">
                                                    <option value="preventive health checkup">Preventive health checkup</option>
                                                    <option value="DHP">DHP</option>
                                                    <option value="Subscription">Subscription</option>
                                                </select>
                                                <span class="text-danger ERROR__service_category"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Mode of delivery </p>
                                            <div class="form-group ">
                                                <select name="del_mode" id="del_mode" class="form-control select2">
                                                    <option value="At store">At store</option>
                                                    <option value="at home">at home</option>
                                                    <option value="digital">digital</option>
                                                </select>
                                                <span class="text-danger ERROR__del_mode"></span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm mg-b-20">


                                        <div class="col-lg">
                                            <p class="mg-b-10">Price <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Service Price" type="number" name="service_price" >
                                            <span class="text-danger ERROR__service_price"></span>
                                        </div>


                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Disease <b class="text-danger">*</b></p>
                                            <select name="disease" id="disease" class="form-control">
                                                <option value="" selected>Select</option>
                                                <option value="Sugar">Sugar</option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>
                                            <span class="text-danger ERROR__disease"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Organs Attached <b class="text-danger">*</b></p>
                                            <select name="attach_organ" id="attach_organ" class="form-control">
                                                <option value="" selected>Select</option>
                                                <option value="Heart">Heart</option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>
                                            <span class="text-danger ERROR__attach_organ"></span>
                                        </div>

                                    </div>

                                    <div class="row row-sm mg-b-20">

                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Time Consume <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Time Consume" type="text" name="time_consume" >
                                            <span class="text-danger ERROR__time_consume"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Servicable Pincodes <b class="text-danger">*</b></p>
                                            <select name="service_pincode" id="service_pincode" class="form-control">
                                                <option value="" selected>Select</option>
                                                <option value="110090">110090</option>
                                                <option value="110091">110091</option>
                                                <option value="110092">110092</option>
                                            </select>
                                            <span class="text-danger ERROR__service_pincode"></span>
                                        </div>

                                    </div>
                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Details <b class="text-danger">*</b></p>
                                            <textarea class="form-control" placeholder="Details" type="text" name="ser_details" id="ser_details" ></textarea>
                                            <span class="text-danger ERROR__ser_details"></span>
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
                                    <h6 class="main-content-label mb-1">Service for More Category</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg">
                                            <p class="mg-b-10">Gender</p>
                                            <div class="form-group">
                                                <select name="customer_gender" class="form-control select2">
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                                <span class="text-danger ERROR__customer_gender"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Age Group <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Age Group" type="text" name="ageGroup" >
                                            <span class="text-danger ERROR__ageGroup"></span>
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
                                            <input class="form-control" type="datetime-local" name="startDateTime" >
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">End date & time <b class="text-danger">*</b></p>
                                            <input class="form-control" type="datetime-local" name="endDateTime" >
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row mt-3 mb-4">
                        <div class="col-12 text-center">
                            <input type="submit" class="btn btn-primary my-2 btn-icon-text" style="color: white;"
                                value="&nbsp; Create Service &nbsp;">
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('submit', '#service_endcust', function(ev) {

            ev.preventDefault();
            var frm = $('#service_endcust');
            var form = $('#service_endcust')[0];
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
                    // console.log('success');
                    // console.log(data);
                    if(data.success==true){
                        window.location.href="/list-end-custumers";
                    }else{
                        python(data.message, 'Whoops!', 'red');
                        $.each(data.errors, function (field, message) {
                            $(".ERROR__" + field).html('<div class="text-danger">' + message + "</div>");
                        });
                    }
                    // if (data.success == true) {
                    //     // python(data.message, 'Great');
                    //     // window.location.href={{ route('list.end.custumers') }};
                    //     window.location.href="/list-end-custumers";
                    // }else{
                    //     python(data.message, 'Whoops!', 'red');
                    //     $.each(data.errors, function (field, message) {
                    //         $(".ERROR__" + field).html('<div class="text-danger">' + message + "</div>");
                    //     });
                    // }

                },
                error: function(err) {

                    //

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
