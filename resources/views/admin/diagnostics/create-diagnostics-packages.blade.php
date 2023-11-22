@extends('admin.layout.master')
@section('style')
@endsection @section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <form enctype="multipart/form-data" id="packageForm">
                @csrf

                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Create New Packages</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('packages.list') }}">Packages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create New Packages</li>
                        </ol>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <a href="{{ route('packages.list') }}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
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
                                <h6 class="main-content-label mb-1">Packages Information</h6>
                            </div>
                            <div class="alert alert-danger d-none" id="formerror"></div>
                            <div class="card-body">
                                <div class="row row-sm mg-b-20">
                                    <div class="col-md-4">
                                        <p class="mg-b-10">Packages Code <b class="text-danger">*</b></p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: LP-00"
                                            type="text"
                                            name="lab_package"
                                        />
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Provider ID</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: AHDPL-000"
                                            type="text"
                                            name="providerid"
                                        />
                                    </div>

                                    <div class="col-md-4">
                                        <p class="mg-b-10">Package Name</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Full Body Health Check- Basic"
                                            type="text"
                                            name="name"
                                            pattern="[a-zA-Z ]*"
                                            title="Only Alphabet with Space Allow"
                                            onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"
                                        />
                                    </div>

                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Category <b class="text-danger">*</b></p>
                                        <div class="form-group">
                                            <select name="category" class="form-control select2" >
                                                <option value="">Default Select</option>
                                                <option value="pathalogy">pathalogy</option>
                                                <option value="Blood Sample">Blood Sample</option>
                                                <option value="Blood, Urine Sample">Blood, Urine Sample</option>
                                            </select>
                                            <span class="text-danger ERROR__gender"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Lab Tests <b class="text-danger">*</b></p>
                                        <div class="form-group">
                                            <select multiple="multiple js-example-basic-multiple" name="labtestid[]" class="form-control select2" >
                                                <option value="">Default Select</option>
                                                @foreach ($labtests as $labtest)
                                                    <option value="{{$labtest->_id}}">{{$labtest->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger ERROR__gender"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Base Price</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: 999"
                                            type="text"
                                            name="basePrice"
                                        />
                                    </div>


                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Discount</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Upto 15%"
                                            type="text"
                                            name="discount"
                                        />
                                    </div>


                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Sample Type</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Serum (3 mL) W B-ED TA (2mL), N a-F (2mL),Urine (30mL)"
                                            type="text"
                                            name="sample_type"
                                        />
                                    </div>


                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Method</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Spectrophotometry, Microscopy, C.C, W G"
                                            type="text"
                                            name="method"
                                        />
                                    </div>



                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Result Time</p>
                                        <div class="form-group">
                                            <select name="result_time" class="form-control select2">
                                                <option value="Same day">Same day</option>
                                                <option value="Next Day">Next Day</option>
                                                <option value="Same day, N">Same day, N</option>
                                                <option value="same day, Th">same day, Th</option>
                                                <option value="RI">RI</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Age Group</p>
                                        <div class="form-group">
                                            <select name="age_group" class="form-control select2">
                                                <option value="0-100">0-100</option>
                                                <option value="10-100">10-100</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Gender</p>
                                        <div class="form-group">
                                            <select name="gender" class="form-control select2">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Both">Both</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>



                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Organs</p>
                                        <select name="organs" class="form-control select2" >
                                            <option value="">Default Select</option>
                                            @foreach ($organs as $organ)
                                                <option value="{{$organ->_id}}">{{$organ->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>


                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Tags</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Full body profile,Vitamin D, Vitamin B12"
                                            type="text"
                                            name="tags"
                                        />
                                    </div>


                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">Attached vitals</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Attached vitals"
                                            type="text"
                                            name="attached_vitals"
                                        />
                                    </div>



                                    <div class="col-md-4 mt-3">
                                        <p class="mg-b-10">for organ unlock</p>
                                        <input
                                            class="form-control"
                                            placeholder="Example: Liver,Heart,Kidney,Urinary System,Blood,Gall Bladder, Pancrease"
                                            type="text"
                                            name="forOrgeanUnlock"
                                        />
                                    </div>



                                    <div class="col-lg-4 mt-3 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Number of attacheed vitals</p>
                                        <div class="form-group">
                                            <select name="numberOfAttachedVitals" class="form-control select2">
                                                <option value="True">True</option>
                                                <option value="False">False</option>
                                            </select>
                                            <span class="text-danger ERROR__blood_group"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-12 mt-3">
                                        <p class="mg-b-10">Description</p>
                                        <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                                    </div>

                                </div>

                                <div class="row mt-3 mb-4">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary my-2 btn-icon-text">Add New package <i class="fa fa-add"></i></button>
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
        $('#packageForm').submit(function(e){
            e.preventDefault();
            $.ajax({
                url:'/save-diagnostics-packages',
                type:'POST',
                data:new FormData(document.getElementById('packageForm')),
                contentType:false,
                processData:false,
                datatype:'json',
                success:function(res){
                    // console.log('success');
                    // console.log(res);
                window.location.href='/packages-list';
                },
                error:function(res){
                    // console.log('error');
                    // console.log(res);
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
            })
        })
    </script>
@endsection
