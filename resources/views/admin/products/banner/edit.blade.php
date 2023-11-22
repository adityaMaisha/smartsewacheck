@extends('admin.layout.master')
@section('style')
@endsection
@section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <form enctype="multipart/form-data" id="bannerform">
                @csrf

                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Edit Banner</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('products.banner.index') }}">Banner</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Banner</li>
                        </ol>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <a href="{{ route('products.banner.index') }}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
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
                                <h6 class="main-content-label mb-1">Banner Information</h6>
                            </div>
                            <div class="alert alert-danger d-none" id="formerror"></div>
                            <div class="card-body">
                                <div class="row row-sm mg-b-20">
                                    <div class="col-md-4">
                                        <p class="mg-b-10">Banner Name <b class="text-danger">*</b></p>
                                        <input
                                            class="form-control"
                                            placeholder="Banner Name"
                                            type="text"
                                            name="banner_name"
                                            value="{{$editData->banner_name}}"
                                        />
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mg-b-10">Banner Image<b class="text-danger">*</b></p>
                                        <div class="custom-file">
                                            <input type="file" class="form-control" name="banner_image" accept="image/*"/>
                                            <a href="{{asset($editData->banner_image)}}" target="_blank">Click to preview</a>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mg-b-10">Category <b class="text-danger">*</b></p>
                                        <div class="form-group">
                                            <select name="category" class="form-control select2" >
                                                <option value="">Select Category</option>
                                                <option value="Package"{{$editData->category=="Package"?'selected':''}}>Packages</option>
                                                <option value="LabTest" {{$editData->category=="LabTest"?'selected':''}}>Lab Test</option>
                                                <option value="SmartHealthCheckupModel"{{$editData->category=="SmartHealthCheckupModel"?'selected':''}}>Smart Health Checkup</option>
                                            </select>
                                            <span class="text-danger ERROR__gender"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mg-b-10">Offers On <span id="offerOn"></span> <b class="text-danger">*</b></p>
                                        <div class="form-group">
                                            <select name="offer_on[]" multiple class="form-control select2">
                                            </select>
                                            <span class="text-danger ERROR__gender"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mg-b-10">Discount % <b class="text-danger">*</b></p>
                                        <input
                                            class="form-control"
                                            placeholder="Banner Name"
                                            type="text"
                                            name="discountper"
                                            value="{{$editData->discountper}}"
                                        />
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
                                        <button type="submit" class="btn btn-primary my-2 btn-icon-text">Edit Banner <i class="fa fa-add"></i></button>
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
    function loadoptions(){
        let value = "<?php print_r($editData->category)?>";
        let option = "{!! implode(',',$editData->offer_on) !!}";
        let selectedOption = option.split(',');
        $.ajax({
            url:'/products/banner/getlist',
            type:'post',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            data:{data:value},
            success:function(res){
                // console.log('success');
                // console.log(res);
                //
                let heading = "";
                if(value == "SmartHealthCheckupModel"){
                    heading = "Smart Health Checkup";
                }else if(value == "LabTest"){
                    heading = "Lab Test";
                }else{
                    heading = "Package";
                }
                $('#offerOn').text(heading);
                $('select[name="offer_on[]"]').empty();
                $.each(res.data,function(listIndex,listData){
                    // console.log(listData);
                    $('select[name="offer_on[]"]').append(`
                        <option value="${listData._id}"${selectedOption.includes(listData._id)?'selected':''}>${listData.name}</option>
                    `)
                });
            },
            error:function(res){
                console.log('error');
                console.log(res);
            }
        });
    }
    $('#bannerform').submit(function(e){
        e.preventDefault();
        let formid = "<?php print_r(encrypt($editData->_id)) ?>";
        $.ajax({
            url:`/products/banner/update/${formid}`,
            type:'POST',
            data:new FormData(document.getElementById('bannerform')),
            contentType:false,
            processData:false,
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            datatype:'json',
            success:function(res){
                // console.log('success');
                // console.log(res);
                window.location.href='/products/banner';
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
    });
    loadoptions();
</script>
@endsection
