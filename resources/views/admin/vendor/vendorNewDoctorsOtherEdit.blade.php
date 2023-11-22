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
    .other{
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
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Doctors And Other Vendor</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Edit Doctors Other Vendor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Doctors And Other Vendor</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{ route('vendor.list.doctors.other') }}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <form enctype="multipart/form-data" id="employeeFormData">
                @csrf

                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Vendor Detail</h6>
                            </div>
                            <div class="alert alert-danger d-none" id="errors"></div>
                            <div class="card-body">

                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Vendor Type <b class="text-danger">*</b></p>
                                        <select class="form-control select2" name="vendor_type" onchange="get_vendor(this.value)" >
                                            <option label="Select Vendor Type"></option>
                                            <option value="Doctor"{{$editData->vendor_type=="Doctor"?'selected':''}}>Doctor</option>
                                            <option value="Other" {{$editData->vendor_type=="Other"?'selected':''}}>Other</option>
                                        </select>
                                        <span class="text-danger ERROR__vendor_type"></span>
                                    </div>

                                    <div class="col-lg-4 other">
                                        <p class="mg-b-10">Other <b class="text-danger">*</b></p>
                                        <input class="form-control" type="text"
                                            name="other_vendor_doctor" placeholder="Enter Other Vendor" value="{{$editData->other_vendor_doctor?$editData->other_vendor_doctor:''}}">
                                        <span class="text-danger ERROR__other_vendor_doctor"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Salutation <b class="text-danger">*</b></p>
                                        <select class="form-control select2" name="salutation" >
                                            <option label="Select Vendor Type"></option>
                                            <option value="Dr" {{$editData->salutation=="Dr"?'selected':''}}>Dr</option>
                                            <option value="MD"{{$editData->salutation=="MD"?'selected':''}}>MD</option>
                                        </select>
                                        <span class="text-danger ERROR__salutation"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Name <b class="text-danger">*</b></p>
                                        <input class="form-control" type="text"
                                            name="vendor_name" placeholder="Enter Name" value="{{$editData->vendor_name}}">
                                        <span class="text-danger ERROR__vendor_name"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Date of birth <b class="text-danger">*</b></p>
                                        <div class="mg-b-20">
                                            <div class="input-group">
                                                <div class="input-group-text border-end-0">
                                                    <i class="fe fe-calendar lh--9 op-6"></i>
                                                </div>
                                                <input class="form-control fc-datepicker"
                                                    placeholder="MM/DD/YYYY" type="text" name="date_of_birth" value="{{$editData->date_of_birth}}">
                                            </div>
                                            <span class="text-danger ERROR__date_of_birth"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Address <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Address" type="text"
                                            name="address" value="{{$editData->address}}">
                                        <span class="text-danger ERROR__address"></span>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Care Type <b class="text-danger">*</b></p>
                                        <div class="form-check">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="home_care" name="care[]" {{in_array('home_care',$editData->care)?'checked':''}}>
                                                <label class="form-check-label" for="inlineCheckbox1">Home Care</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="critical_care" name="care[]" {{in_array('critical_care',$editData->care)?'checked':''}}>
                                                <label class="form-check-label" for="inlineCheckbox2">Critical Care</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Profile Picture <b class="text-danger">*</b></p>
                                        <div class="input-group file-browser">
                                            <input type="text" class="form-control border-end-0 browse-file"
                                                placeholder="Choose File" readonly="">
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary">
                                                    Browse <input type="file" style="display: none;"
                                                        name="employee_profile" accept="image/*">
                                                </span>
                                            </label>
                                        </div>
                                        <a href="{{asset($editData->employee_profile)}}" target="_blank" rel="noopener noreferrer">Click to Preview</a>
                                        <span class="text-danger ERROR__employee_profile"></span>
                                    </div>





                                </div>
                                <div class="row row-sm mg-b-20">

                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Email <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Enter Email" type="email"
                                            name="email_id" value="{{$editData->email_id}}">
                                            <span class="text-danger ERROR__email_id"></span>
                                    </div>
                                    <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Mobile <b class="text-danger">*</b></p>
                                        <input class="form-control" type="text" name="mobile_number" value="{{$editData->mobile_number}}" pattern="[0-9]{10}" title="Please enter exactly 10 digits" placeholder="10 Digit Mobile Number" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10">
                                            <span class="text-danger ERROR__mobile_number"></span>
                                    </div>
                                </div>

                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg">
                                        <p class="mg-b-10">Country <b class="text-danger">*</b></p>
                                        <div class="form-group ">
                                            <select name="country" class="form-control select2"
                                                id="user_country">
                                                <option value="">Select Employee Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" {{$editData->country==$country->id?'selected':''}}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger ERROR__country"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">State <b class="text-danger">*</b></p>
                                        <div class="form-group">
                                            <select name="state" class="form-control select2"
                                                id="user_state"></select>
                                                <span class="text-danger ERROR__state"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">City <b class="text-danger">*</b></p>
                                        <div class="form-group">
                                            <select name="city" class="form-control select2"
                                                id="user_city"></select>
                                                <span class="text-danger ERROR__city"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm mg-b-20">

                                    <div class="col-lg-12 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Short Brief <b class="text-danger">*</b></p>
                                        <textarea class="form-control" placeholder="Enter Short Brief" type="text"
                                            name="short_brief" >{{$editData->short_brief}}</textarea>
                                            <span class="text-danger ERROR__short_brief"></span>
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
                                <h6 class="main-content-label mb-1">Contact Person & Official Details</h6>
                            </div>
                            <div class="card-body">

                                <div class="row row-sm">
                                    <div class="col-lg-6">
                                        <p class="mg-b-10">Office Email <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Office Email" type="Email" readonly onfocus="this.removeAttribute('readonly');"
                                            name="office_email" value="{{$editData->office_email}}">
                                        <span class="text-danger ERROR__office_email"></span>
                                    </div>
                                </div>
                                <div class="row row-sm">
                                    <div class="col-lg-6 mt-3 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Contact Person Name <b class="text-danger">*</b></p>
                                        <input class="form-control" type="text" name="contact_person_name" placeholder="Enter Contact Person Name" value="{{$editData->contact_person_name}}">
                                            <span class="text-danger ERROR__contact_person_name"></span>
                                    </div>
                                    <div class="col-lg-6 mt-3 mg-t-10 mg-lg-t-0">
                                        <p class="mg-b-10">Contact Person Mobile <b class="text-danger">*</b></p>
                                        <input class="form-control" type="text" name="contact_per_mobile" value="{{$editData->contact_per_mobile}}" pattern="[0-9]{10}" title="Please enter exactly 10 digits" placeholder="10 Digit Mobile Number" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10">
                                            <span class="text-danger ERROR__contact_per_mobile"></span>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">

                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Certifications</h6>
                            </div>
                            <div class="card-body">

                                <div class="row row-sm mg-t-20">
                                    <div class="col-lg-4">
                                        <p class="mg-b-10 fw-bold">Adhaar Card No <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Adhaar Card No" type="text" value="{{$editData->adhaar_card_number}}"
                                            name="adhaar_card_number" pattern="[0-9]{12}" title="Please enter valid 12 digits" placeholder="12 Digit Adhaar Card Number" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="12">
                                            <span class="text-danger ERROR__adhaar_card_number"></span>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mg-b-10 fw-bold">PAN Card No <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Card No" type="text"
                                            name="pan_card_number" value="{{$editData->pan_card_number}}" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Enter Valid Pan Card Number ( Example: ABCTY1234D )">
                                            <span class="text-danger ERROR__pan_card_number"></span>
                                    </div>
                                    <div class="col-lg-6 col-md-4  mt-3">
                                        <p class="mg-b-10 fw-bold">GST Certificate <b class="text-danger">*</b></p>
                                        <input type="file" class="" accept="image/*" id="gst_certificate" data-height="200"
                                            name="gst_certificate" data-default-file="{{asset($editData->gst_certificate)}}">
                                            <span class="text-danger ERROR__gst_certificate"></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-6 col-md-4  mt-3">
                                        <p class="mg-b-10 fw-bold">Upload PAN Card <b class="text-danger">*</b></p>
                                        <input type="file" class="" accept="image/*" id="pan_card_attachment" data-height="200"
                                            name="upload_pan_card_attachment" data-default-file="{{asset($editData->upload_pan_card_attachment)}}">
                                            <span class="text-danger ERROR__upload_pan_card_attachment"></span>
                                    </div>

                                    <div class="col-lg-6 col-md-4 mt-3">
                                        <p class="mg-b-10 fw-bold"> Registration Certificate <b class="text-danger">*</b></p>
                                        <input type="file" class="" accept="image/*" id="registration_docs" data-height="200"
                                            name="registration_docs" data-default-file="{{asset($editData->registration_docs)}}">
                                            <span class="text-danger ERROR__registration_docs"></span>
                                    </div>

                                </div>
                                <div>
                                    <div class="col-lg-12 p-0">
                                        <p class="mg-b-10 fw-bold">Upload Other Documents <b class="text-danger">*</b></p>
                                        <input type="file" class="" accept="image/*" id="upload_other_documents" data-height="100"
                                            name="upload_other_documents" data-default-file="{{asset($editData->upload_other_documents)}}">
                                            <span class="text-danger ERROR__upload_other_documents"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->


                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Professional Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row row-sm mg-b-20">

                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Practice Category <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Practice Category" type="text" name="practice_category" list="practice_category_list" value="{{$editData->practice_category}}">
                                        <datalist id="practice_category_list">
                                            <option value="Allopathy">
                                            <option value="Homeopathy">
                                            <option value="Ayurveda">
                                        </datalist>
                                        <span class="text-danger ERROR__practice_category_list"></span>
                                    </div>

                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">Licence Number <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Licence Number" type="text" name="licence_number" value="{{$editData->licence_number}}">
                                        <span class="text-danger ERROR__licence_number"></span>
                                    </div>
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">Registration State <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Registration State" type="text" name="registration_state" value="{{$editData->registration_state}}">
                                            <span class="text-danger ERROR__registration_state"></span>
                                    </div>
                                </div>
                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Qualification <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Qualification"  type="text" name="qualification"  value="{{$editData->qualification}}">
                                            <span class="text-danger ERROR__qualification"></span>
                                    </div>
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">Specialization <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Specialization"  name="specialization" type="text" value="{{$editData->specialization}}">
                                            <span class="text-danger ERROR__specialization"></span>
                                    </div>
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">Department <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Department" type="text"  name="department" value="{{$editData->department}}">
                                            <span class="text-danger ERROR__department"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->


                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Practice Details</h6>
                            </div>
                            <div class="card-body">

                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Available for home Visit <b class="text-danger">*</b></p>
                                        <select class="form-control select2" name="available_for_home_visit" >
                                            <option label="Available for home Visit"></option>
                                            <option value="yes"{{$editData->available_for_home_visit=="yes"?'selected':''}}>Yes</option>
                                            <option value="no"{{$editData->available_for_home_visit=="no"?'selected':''}}>No</option>
                                        </select>
                                        <span class="text-danger ERROR__available_for_home_visit"></span>
                                    </div>

                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">If yes time slots</p>
                                        <input class="form-control" placeholder="If yes time slots" type="text" name="if_yes_time_slots" value="{{$editData->if_yes_time_slots?$editData->if_yes_time_slots:''}}">
                                    </div>

                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">Video Call time slot</p>
                                        <input class="form-control" placeholder="Video Call time slot" type="text" name="video_call_time_slot" value="{{$editData->video_call_time_slot?$editData->video_call_time_slot:''}}">
                                    </div>

                                    {{-- <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <button class="remove" type="button">Remove</button>
                                    </div> --}}
                                </div>


                                <span id="practiceDetailsSection">
                                    @foreach ($editData->location as $key=>$loca)
                                        <div class="row row-sm mg-b-20">
                                            <div class="col-lg-5 mg-t-20 mg-lg-t-0">
                                                <p class="mg-b-10">Location <b class="text-danger">*</b></p>
                                                <input class="form-control" placeholder="Location" type="text" name="location[]" value="{{$loca}}">
                                            </div>

                                            <div class="col-lg-5 mg-t-20 mg-lg-t-0">
                                                <p class="mg-b-10">Visiting Hours <b class="text-danger">*</b></p>
                                                <input class="form-control" placeholder="Visiting Hours" type="text" name="visiting_hours[]" value="{{$editData->visiting_hours[$key]}}">
                                            </div>
                                            @if ($key>0)
                                                {{-- <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                                    <button class="remove" type="button">Remove</button>
                                                </div> --}}
                                                <div class="col-2 mg-t-20 mg-lg-t-0">
                                                    <p class="mg-b-10">&nbsp;</p>
                                                    <button class="remove btn btn-danger" type="button">Remove</button>
                                                </div>
                                            @endif

                                        </div>
                                    @endforeach
                                </span>
                                <div class="row row-sm mg-b-20">
                                    <div class="col-12">
                                        <button class="add-more btn btn-primary" type="button">Add One More Location</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->


                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Coordinator Details Bank Detials</h6>
                            </div>
                            <div class="card-body">

                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">Bank Name <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Bank Name" type="text"
                                            name="employee_bank_name" value="{{$editData->employee_bank_name}}">
                                            <span class="text-danger ERROR__employee_bank_name"></span>
                                    </div>
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">Account Holder Name <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="First Name" type="text"
                                            name="bank_account_holder_name" value="{{$editData->bank_account_holder_name}}">
                                            <span class="text-danger ERROR__bank_account_holder_name"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Account Type <b class="text-danger">*</b></p>
                                        <select class="form-control select2" name="bank_account_type" >
                                            <option label="Account Type"></option>
                                            <option value="saving" {{$editData->bank_account_type="saving"?'selected':''}}>Saving</option>
                                            <option value="current"{{$editData->bank_account_type="current"?'selected':''}}>Current</option>
                                        </select>
                                        <span class="text-danger ERROR__bank_account_type"></span>
                                    </div>
                                </div>
                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Account Number <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Account Number"
                                            type="text" name="bank_account_number" value="{{$editData->bank_account_number}}">
                                            <span class="text-danger ERROR__bank_account_number"></span>
                                    </div>
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">IFSC Code <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="IFSC Code" type="text"
                                            name="bank_ifsc_code" value="{{$editData->bank_ifsc_code}}">
                                            <span class="text-danger ERROR__bank_ifsc_code"></span>
                                    </div>
                                </div>
                                <div class="row row-sm">
                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Bank Branch <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Bank Branch" type="text"
                                            name="bank_branch" value="{{$editData->bank_branch}}">
                                            <span class="text-danger ERROR__bank_branch"></span>
                                    </div>
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <p class="mg-b-10">Bank City <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Bank City" type="text"
                                            name="bank_city" value="{{$editData->bank_city}}">
                                            <span class="text-danger ERROR__bank_city"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="mb-4 hny_tt">
                                <h6 class="main-content-label mb-1">Other</h6>
                            </div>
                            <div class="card-body">

                                <div class="row row-sm mg-b-20">
                                    <div class="col-lg-4">
                                        <p class="mg-b-10">Reference <b class="text-danger">*</b></p>
                                        <input class="form-control" placeholder="Reference (if any)" type="text"
                                            name="reference_name" value="{{$editData->reference_name}}">
                                            <span class="text-danger ERROR__reference_name"></span>
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
                            value="&nbsp; Edit Doctor &nbsp;">
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection @section('script')
<script>
    $('#user_country').change(function(){
        let elem = this;
        $.ajax({
            url:'/states',
            type:'post',
            data:{country_id:$(elem).val()},
            datatype:'json',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            success:function(res){
                $('#user_state').html(res.html_data);
            },
            error:function(res){
            }
        });
    });
    $('#user_state').change(function(){
        let elem = this;
        $.ajax({
            url:'/cities',
            type:'post',
            data:{state_id:$(elem).val()},
            datatype:'json',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            success:function(res){
                $('#user_city').html(res.html_data);
            },
            error:function(res){
            }
        });
    });
    $('#employeeFormData').submit(function(e){
        e.preventDefault();
        let setIds = "<?php print_r(request()->route()->parameter('id'))?>";
        $.ajax({
            url:`/vendor-update-doctors-other/${setIds}`,
            type:'post',
            data:new FormData(document.getElementById('employeeFormData')),
            datatype:'json',
            processData:false,
            contentType:false,
            success:function(res){
                window.location.href="/vendor-list-doctors-other";
            },
            error:function(res){
                if(res.status==422){
                    const error = Object.entries(res.responseJSON.errors)[0][1];
                    $('#errors').text(error);
                    $('#errors').removeClass('d-none');
                    $('html,body').animate({scrollTop:0},'slow');
                    setTimeout(() => {
                        $('#errors').addClass('d-none');
                        $('#errors').text('');
                    }, 4000);
                }
            }
        })
    })
</script>
<script>

    $(document).ready(function () {
        // Add More Button Click Event
        $(".add-more").click(function () {
            var html = `
            <div class="row row-sm mg-b-20">
                <div class="col-5 mg-t-20 mg-lg-t-0">
                    <p class="mg-b-10">Location <b class="text-danger">*</b></p>
                    <input class="form-control" placeholder="Location" type="text" name="location[]">
                </div>

                <div class="col-5 mg-t-20 mg-lg-t-0">
                    <p class="mg-b-10">Visiting Hours <b class="text-danger">*</b></p>
                    <input class="form-control" placeholder="Visiting Hours" type="text" name="visiting_hours[]">
                </div>

                <div class="col-2 mg-t-20 mg-lg-t-0">
                    <p class="mg-b-10">&nbsp;</p>
                    <button class="remove btn btn-danger" type="button">Remove</button>
                </div>
            </div>
            `;
            $("#practiceDetailsSection").append(html);
        });

        // Remove Button Click Event
        $("#practiceDetailsSection").on("click", ".remove", function () {
            $(this).closest(".row").remove();
        });
        $('#gst_certificate').dropify();
        $('#pan_card_attachment').dropify();
        $('#registration_docs').dropify();
        $('#upload_other_documents').dropify();

        let country_id = "<?php print_r($editData->country)?>";
        let state_id = "<?php print_r($editData->state)?>";
        let city_id = "<?php print_r($editData->city)?>";
        $.ajax({
            url:'/states',
            type:'post',
            data:{country_id:country_id},
            datatype:'json',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            success:function(res){
                $('#user_state').html(res.html_data);
                $('#user_state').find(`option[value=${state_id}]`).prop('selected',true);
            },
            error:function(res){
            }
        });
        $.ajax({
            url:'/cities',
            type:'post',
            data:{state_id:state_id},
            datatype:'json',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            success:function(res){
                $('#user_city').html(res.html_data);
                $('#user_city').find(`option[value=${city_id}]`).prop('selected',true);
            },
            error:function(res){
            }
        });
    });

    function get_vendor(val)
    {
        if(val == 'Other')
        {
            $('.other').css('display','block');
        }else{
            $('.other').css('display','none');
        }
    }
</script>
@endsection
