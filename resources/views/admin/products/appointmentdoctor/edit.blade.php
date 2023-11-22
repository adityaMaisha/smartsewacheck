@extends('admin.layout.master')
@section('style')
@endsection
@section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <form enctype="multipart/form-data" id="appointform">
                @csrf

                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Edit Appointment With Doctor</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('products.appointmentdoctor.index') }}">Appointment With Doctor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Appointment With Doctor</li>
                        </ol>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <a href="{{ route('products.appointmentdoctor.index') }}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
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
                                <h6 class="main-content-label mb-1">Appointment With Doctor Information</h6>
                            </div>
                            <div class="alert alert-danger d-none" id="formerror"></div>
                            <div class="card-body">
                                <div class="row row-sm mg-b-20">
                                    <div class="col-md-4">
                                        <p class="mg-b-10">Doctor Name <b class="text-danger">*</b></p>
                                        <select name="dr_name" class="form-control select2" >
                                            <option value="">Default Select</option>
                                            <option value="Dr. Sk singh" {{$editData->dr_name=="Dr. Sk singh"?'selected':''}}>Dr. Sk singh</option>
                                            <option value="Dr. Devinder Patel"{{$editData->dr_name=="Dr. Devinder Patel"?'selected':''}}>Dr. Devinder Patel</option>
                                            <option value="Dr. Yash Chopra"{{$editData->dr_name=="Dr. Yash Chopra"?'selected':''}}>Dr. Yash Chopra</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mg-b-10">Appointment Time<b class="text-danger">*</b></p>
                                        <div class="custom-file">
                                            <input type="time" class="form-control" name="appointment_time" value="{{$editData->appointment_time}}"/>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mg-b-10">Consultation Fee<b class="text-danger">*</b></p>
                                        <div class="custom-file">
                                            <input type="text" class="form-control" name="consultation_fee" value="{{$editData->consultation_fee}}"/>
                                          </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Discount Fee<b class="text-danger">*</b></p>
                                        <div class="custom-file">
                                            <input type="text" class="form-control" name="discount_fee" value="{{$editData->consultation_fee}}"/>
                                          </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <p class="mg-b-10">Doctor Availability<b class="text-danger">*</b></p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="availability[]" value="online_prescription" {{in_array('online_prescription',$editData->availability)?"checked":""}}>
                                            <label class="form-check-label" for="inlineCheckbox1">Online Prescription</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="availability[]" value="available_for_hospital_visit" {{in_array('available_for_hospital_visit',$editData->availability)?"checked":""}}>
                                            <label class="form-check-label" for="inlineCheckbox2">Available For Hospital Visit</label>
                                          </div>
                                    </div>






                                    {{-- <div class="col-md-4">
                                        <p class="mg-b-10">Packages Code <b class="text-danger">*</b></p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: LP-00"
                                            type="text"
                                            name="first_name"

                                            pattern="[a-zA-Z ]*"
                                            title="Only Alphabet with Space Allow"
                                            onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"
                                        />
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Provider ID</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: AHDPL-000"
                                            type="text"
                                            name="middle_name"
                                            pattern="[a-zA-Z ]*"
                                            title="Only Alphabet with Space Allow"
                                            onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"
                                        />
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Package Name</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Full Body Health Check- Basic"
                                            type="text"
                                            name="last_name"
                                            pattern="[a-zA-Z ]*"
                                            title="Only Alphabet with Space Allow"
                                            onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"
                                        />
                                    </div>

                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Category <b class="text-danger">*</b></p>
                                        <div class="form-group">
                                            <select name="gender" class="form-control select2" >
                                                <option value="">Default Select</option>
                                                <option value="pathalogy">pathalogy</option>
                                                <option value="Blood Sample">Blood Sample</option>
                                                <option value="Blood, Urine Sample">Blood, Urine Sample</option>
                                            </select>
                                            <span class="text-danger ERROR__gender"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <p class="mg-b-10">Base Price</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: 999"
                                            type="text"
                                            name="last_name"
                                        />
                                    </div>


                                    <div class="col-md-4">
                                        <p class="mg-b-10">Discount</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Upto 15%"
                                            type="text"
                                            name="last_name"
                                        />
                                    </div>


                                    <div class="col-md-4">
                                        <p class="mg-b-10">Sample Type</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Serum (3 mL) W B-ED TA (2mL), N a-F (2mL),Urine (30mL)"
                                            type="text"
                                            name="last_name"
                                        />
                                    </div>


                                    <div class="col-md-4">
                                        <p class="mg-b-10">Method</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Spectrophotometry, Microscopy, C.C, W G"
                                            type="text"
                                            name="last_name"
                                        />
                                    </div>



                                    <div class="col-md-4">
                                        <p class="mg-b-10">Result Time</p>
                                        <div class="form-group">
                                            <select name="blood_group" class="form-control select2">
                                                <option value="A+">Same day</option>
                                                <option value="A-">Next Day</option>
                                                <option value="B+">Same day, N</option>
                                                <option value="B-">same day, Th</option>
                                                <option value="O+">RI</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <p class="mg-b-10">Age Group</p>
                                        <div class="form-group">
                                            <select name="blood_group" class="form-control select2">
                                                <option value="A+">0-100</option>
                                                <option value="A-">10-100</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Gender</p>
                                        <div class="form-group">
                                            <select name="blood_group" class="form-control select2">
                                                <option value="A+">Male</option>
                                                <option value="A-">Female</option>
                                                <option value="A-">Both</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <p class="mg-b-10">organs</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Liver,Heart,Kidney,Urinary System,Blood,Gall Bladder, Pancrease"
                                            type="text"
                                            name="last_name"
                                        />
                                    </div>


                                    <div class="col-md-4">
                                        <p class="mg-b-10">Tags</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Full body profile,Vitamin D, Vitamin B12"
                                            type="text"
                                            name="last_name"
                                        />
                                    </div>


                                    <div class="col-md-4">
                                        <p class="mg-b-10">Attached vitals</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Attached vitals"
                                            type="text"
                                            name="last_name"
                                        />
                                    </div>



                                    <div class="col-md-4">
                                        <p class="mg-b-10">for organ unlock</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Liver,Heart,Kidney,Urinary System,Blood,Gall Bladder, Pancrease"
                                            type="text"
                                            name="last_name"
                                        />
                                    </div>



                                    <div class="col-lg-4 mt-3 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Number of attacheed vitals</p>
                                        <div class="form-group">
                                            <select name="blood_group" class="form-control select2">
                                                <option value="A+">True</option>
                                                <option value="A-">False</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <p class="mg-b-10">Description</p>
                                        <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                                    </div> --}}

                                </div>

                                <div class="row mt-3 mb-4">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary my-2 btn-icon-text">Edit Appointment With Doctor <i class="fa fa-add"></i></button>
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
@endsection
@section('script')
<script>
    $('#appointform').submit(function(e){
        e.preventDefault();
        let formid = "<?php print_r(encrypt($editData->_id)) ?>";
        $.ajax({
            url:`/products/appointmentdoctor/update/${formid}`,
            type:'POST',
            data:new FormData(document.getElementById('appointform')),
            contentType:false,
            processData:false,
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            datatype:'json',
            success:function(res){
                // console.log('success');
                // console.log(res);
                window.location.href='/products/appointmentdoctor';
            },
            error:function(res){
                console.log('error');
                console.log(res);
                if(res.status == 422){
                    let errors = Object.entries(res.responseJSON.errors)[0][1];
                    $('#formerror').text(errors);
                    if($('#formerror').hasClass('d-none')){
                        $('#formerror').removeClass('d-none');
                    }
                    $('html,body').animate({scrollTop:0},'slow');
                    setTimeout(() => {
                        $('#formerror').addClass('d-none');
                        $('#formerror').text('');
                    }, 4000);
                }
            }
        });
    })
</script>
@endsection
