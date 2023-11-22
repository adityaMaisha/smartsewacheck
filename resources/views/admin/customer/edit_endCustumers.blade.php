@extends('admin.layout.master')
@section('style')
@endsection
@section('content')
    <div class="main-content side-content pt-0">
        <div class="main-container container-fluid">
            <div class="inner-body">

                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Edit End Customer Service</h2>
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

                <form action="{{ route('update.endCustService') }}" method="POST" id="update_service_endcust">
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
                                            <input class="form-control" placeholder="Service Name" type="text" name="service_name" id="service_name" value="{{ $end_cust_serv->service_name }}">
                                            <span class="text-danger ERROR__service_name"></span>
                                        </div>

                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Category </p>
                                            <div class="form-group ">
                                                <select name="service_category" id="service_category" class="form-control">
                                                    <option value="preventive health checkup" @php if($end_cust_serv->service_category == 'preventive health checkup'){echo 'selected';}@endphp>Preventive health checkup</option>
                                                    <option value="DHP" @php if($end_cust_serv->service_category == 'DHP'){echo 'selected';}@endphp>DHP</option>
                                                    <option value="Subscription" @php if($end_cust_serv->service_category == 'Subscription'){echo 'selected';}@endphp>Subscription</option>
                                                </select>
                                                <span class="text-danger ERROR__service_category"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Mode of delivery </p>
                                            <div class="form-group ">
                                                <select name="del_mode" id="del_mode" class="form-control select2">
                                                    <option value="At store" @php if($end_cust_serv->del_mode == 'At store'){echo 'selected';}@endphp>At store</option>
                                                    <option value="at home" @php if($end_cust_serv->del_mode == 'at home'){echo 'selected';}@endphp>at home</option>
                                                    <option value="digital" @php if($end_cust_serv->del_mode == 'digital'){echo 'selected';}@endphp>digital</option>
                                                </select>
                                                <span class="text-danger ERROR__del_mode"></span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm mg-b-20">


                                        <div class="col-lg">
                                            <p class="mg-b-10">Price <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Service Price" type="number" name="service_price" value="{{ $end_cust_serv->service_price }}">
                                            <span class="text-danger ERROR__service_price"></span>
                                        </div>


                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Disease <b class="text-danger">*</b></p>
                                            <select name="disease" id="disease" class="form-control">
                                                <option value="" selected>Select</option>
                                                <option value="Sugar"{{$end_cust_serv->disease=="Sugar"?'selected':''}}>Sugar</option>
                                                <option value="Not Applicable"{{$end_cust_serv->disease=="Not Applicable"?'selected':''}}>Not Applicable</option>
                                            </select>
                                            <span class="text-danger ERROR__disease"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Organs Attached <b class="text-danger">*</b></p>
                                            <select name="attach_organ" id="attach_organ" class="form-control">
                                                <option value="" selected>Select</option>
                                                <option value="Heart"{{$end_cust_serv->attach_organ=="Heart"?'selected':''}}>Heart</option>
                                                <option value="Not Applicable"{{$end_cust_serv->attach_organ=="Not Applicable"?'selected':''}}>Not Applicable</option>
                                            </select>
                                            <span class="text-danger ERROR__attach_organ"></span>
                                        </div>

                                    </div>

                                    <div class="row row-sm mg-b-20">

                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Time Consume <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Time Consume" type="text" name="time_consume" value="{{ $end_cust_serv->time_consume }}">
                                            <span class="text-danger ERROR__time_consume"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Servicable Pincodes <b class="text-danger">*</b></p>
                                            <select name="service_pincode" id="service_pincode" class="form-control">
                                                <option value="" selected>Select</option>
                                                <option value="110090"{{$end_cust_serv->service_pincode=="110090"?'selected':''}}>110090</option>
                                                <option value="110091"{{$end_cust_serv->service_pincode=="110091"?'selected':''}}>110091</option>
                                                <option value="110092"{{$end_cust_serv->service_pincode=="110092"?'selected':''}}>110092</option>
                                            </select>
                                            <span class="text-danger ERROR__service_pincode"></span>
                                        </div>

                                    </div>
                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Details <b class="text-danger">*</b></p>
                                            <textarea class="form-control" placeholder="Details" type="text" name="ser_details" id="ser_details" >{{ $end_cust_serv->ser_details  }}</textarea>
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
                                                    <option value="male" @php if($end_cust_serv->customer_gender == 'male'){echo 'selected';}@endphp>Male</option>
                                                    <option value="female" @php if($end_cust_serv->customer_gender == 'female'){echo 'selected';}@endphp>Female</option>
                                                </select>
                                                <span class="text-danger ERROR__customer_gender"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Age Group <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Age Group" type="text" name="ageGroup" value="{{ $end_cust_serv->ageGroup }}">
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
                                            <input class="form-control" type="datetime-local" name="startDateTime" value="{{ $end_cust_serv->startDateTime }}">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">End date & time <b class="text-danger">*</b></p>
                                            <input class="form-control" type="datetime-local" name="endDateTime" value="{{ $end_cust_serv->endDateTime }}">
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <input type="hidden" name="id" id="id" value="{{ $end_cust_serv->_id }}">
                    <div class="row mt-3 mb-4">
                        <div class="col-12 text-center">
                            <input type="submit" class="btn btn-primary my-2 btn-icon-text" style="color: white;"
                                value="&nbsp; Edit Service &nbsp;">
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


        $(document).on('submit', '#update_service_endcust', function(ev) {

            ev.preventDefault();
            var frm = $('#update_service_endcust');
            var form = $('#update_service_endcust')[0];
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
                    if(data.success==true){
                        window.location.href="/list-end-custumers";
                    }else{
                        python(data.message, 'Whoops!', 'red');
                        $.each(data.errors, function (field, message) {
                            $(".ERROR__" + field).html('<div class="text-danger">' + message + "</div>");
                        });
                    }
                    // if (data.success == true) {
                    //     python(data.message, 'Great');
                    //     window.location.href={{ route('list.end.custumers') }};
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
