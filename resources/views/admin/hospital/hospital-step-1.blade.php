@extends('admin.layout.master')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.remove-address-row {
    display: none!important;
}

.address-row:nth-child(even) {
  margin-top: 10px!important;
  background-color: #ECECEC!important;
  padding: 10px!important;
}

.address-row:nth-child(odd) {
  margin-top: 10px!important;
  background-color: #f7f7f7!important;
  padding: 10px!important;
}
.nav-tabs .nav-link.active {
    color: #3c4858;
    background-color: #e4e4e4;
    border-color: #eaedf7 #eaedf7 #ffffff;
    color: black;
    font-weight: 500;
    letter-spacing: -0.1px;
}
.nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
    background-color: #e4e4e4;
    color: black !important;
}
</style>
@endsection
@section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Add New Hospital</h2>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="{{route('vendor.new.setup')}}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Wizard for Create new Hospital</h6>
                                <p class="text-muted card-sub-title">To create a hospital, you need to fill out a form step by step, and then your hospital will be created.</p>
                            </div>
                            <ul class="nav nav-tabs mb-2" id="myTab" style="border-bottom: 1px solid grey;">
                                <li class="nav-item">
                                    <a href="#home" id="registration" class="nav-link active" data-bs-toggle="tab">Registration</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#profile" id="address" class="nav-link" data-bs-toggle="tab">Address</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#messages" id="documents" class="nav-link" data-bs-toggle="tab">Documents</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#services" id="facilities" class="nav-link" data-bs-toggle="tab">Services & Facilities</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#bankaccount" id="account" class="nav-link" data-bs-toggle="tab">Bank Account</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#media" id="mediatab" class="nav-link" data-bs-toggle="tab">Media</a>
                                </li>
                                <?php if($nextToken != 'hospitals'){ ?>
                                    <li class="nav-item">
                                        <a href="#other" id="othertab" class="nav-link" data-bs-toggle="tab">Other</a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <div class="alert alert-danger d-none" id="errors"></div>
                                <div class="tab-pane fade show active" id="home">
                                    <form id="form1" enctype="multipart/form-data">
                                        <input type="hidden" name="roleType" value="{{request()->route()->parameter('token')}}"/>
                                        <input type="hidden" name="form" value="1"/>
                                        <input type="hidden" name="hidden_id" value=""/>
                                        @csrf
                                        <div class="row row-sm">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="card custom-card">
                                                    <div class="mb-4 hny_tt">
                                                        <h6 class="main-content-label mb-1">Personal Detail</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row row-sm mg-b-20">
                                                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                                <p class="mg-b-10">Hospital Type <b class="text-danger">*</b></p>
                                                                <select class="form-control select2" name="hospitalType">
                                                                    <option label="Choose one"> </option>
                                                                    <option value="multispeciality">Multispeciality</option>
                                                                    <option value="clinic">Clinic</option>
                                                                    <option value="nursing_home">Nursing Home</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                                <p class="mg-b-10">Hospital Name <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Hospital Full Name" type="text" name="hospitalFullName" />
                                                            </div>
                                                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                                <p class="mg-b-10">Display Name</p>
                                                                <input class="form-control" placeholder="Hospital Display Name" type="text" name="hospitalDisplayName" />
                                                            </div>

                                                        </div>
                                                        <div class="row row-sm mg-b-20">
                                                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                                <p class="mg-b-10">Email</p>
                                                                <input class="form-control" placeholder="Hospital Email" type="text" name="login_email" />
                                                            </div>
                                                            <div class="col-lg">
                                                                <p class="mg-b-10">Establishment Date <b class="text-danger">*</b></p>
                                                                <div class="mg-b-20">
                                                                    <div class="input-group">
                                                                        <div class="input-group-text border-end-0">
                                                                            <i class="fe fe-calendar lh--9 op-6"></i>
                                                                        </div>
                                                                        <input class="form-control" id="datepicker" name="establisementDate" placeholder="MM/DD/YYYY" type="text" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 mt-3">
                                                            <p class="mg-b-10">Short Brief <b class="text-danger">*</b></p>
                                                            <textarea class="form-control" name="shortBrief" id="" cols="3" rows="3" placeholder="Enter Short Brief"></textarea>
                                                            <span class="text-danger ERROR__shortBrief"></span>
                                                        </div>

                                                        <div class="col-lg-12 mt-3">
                                                            <p class="mg-b-10">Speciality <b class="text-danger">*</b></p>
                                                            <select name="speciality" class="form-control select2">
                                                                <option value="">Select Speciality</option>
                                                                <option value="superSpeciality">Super Speciality</option>
                                                                <option value="multispeciality">Multispeciality</option>
                                                            </select>
                                                            <span class="text-danger ERROR__shortBrief"></span>
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
                                                        <h6 class="main-content-label mb-1">Contact Details</h6>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="text-end">
                                                            <button class="btn btn-primary" type="button" id="addContactFields"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>
                                                        </div>
                                                        <div class="row row-sm mg-t-20" id="contact_dynamic_fields">
                                                            <div class="row">
                                                                <div class="col-lg">
                                                                    <p class="mg-b-10 fw-bold">Designation <b class="text-danger">*</b></p>
                                                                    <div class="form-group">
                                                                        <select class="form-control select2" name="contact_details_designation1[]" >
                                                                            <option value="">Select Option</option>
                                                                            <option value="admin">Admin</option>
                                                                            <option value="it_head">IT Head</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                    <p class="mg-b-10 fw-bold">Department  <b class="text-danger">*</b></p>
                                                                    <input class="form-control" placeholder="Department" type="text" name="department1[]"  />
                                                                </div>
                                                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                    <p class="mg-b-10 fw-bold">Name <b class="text-danger">*</b></p>
                                                                    <input class="form-control" placeholder="Full Name" type="text" name="contact_details_name1[]"  />
                                                                </div>
                                                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                    <p class="mg-b-10 fw-bold">Email <b class="text-danger">*</b></p>
                                                                    <input class="form-control" placeholder="Email Address" type="email" name="contact_details_email1[]"  />
                                                                </div>
                                                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                    <p class="mg-b-10 fw-bold">Contact <b class="text-danger">*</b></p>
                                                                    <input
                                                                        class="form-control"
                                                                        type="number"
                                                                        name="contact_details_contact1[]"

                                                                        pattern="[0-9]{10}"
                                                                        title="Please enter exactly 10 digits"
                                                                        placeholder="10 Digit Contact Number"
                                                                        onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"
                                                                        maxlength="10"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <span id="contactDetailsDynamicFields"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row row-sm">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="card custom-card">
                                                    <div class="card-body">
                                                        <div class="row row-sm mg-b-20">
                                                            <div class="col-lg-4">
                                                                <p class="mg-b-10">Helpline Number <b class="text-danger">*</b></p>
                                                                <input
                                                                    class="form-control"
                                                                    type="text"
                                                                    name="helplineNumber"
                                                                    pattern="[0-9]{10}"
                                                                    title="Please enter exactly 10 digits"
                                                                    placeholder="10 Digit Helpline Number"
                                                                    onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"
                                                                    maxlength="10"
                                                                />
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <p class="mg-b-10">Emergency Contact <b class="text-danger">*</b></p>
                                                                <input
                                                                    class="form-control"
                                                                    type="text"
                                                                    name="emergencyContact"
                                                                    pattern="[0-9]{10}"
                                                                    title="Please enter exactly 10 digits"
                                                                    placeholder="10 Digit Emergency Contact"
                                                                    onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"
                                                                    maxlength="10"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-4">
                                            <div class="col-12 text-end">
                                                <button type="submits" class="btn btn-primary my-2 btn-icon-text">
                                                    <a style="color: white;"> Save & Next <i class="fa fa-save"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <form id="form2">
                                        @csrf
                                        <input type="hidden" name="form" value="2"/>
                                        <input type="hidden" name="hidden_id" value=""/>
                                        <div class="row row-sm">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="card custom-card">
                                                    <div class="mb-4 hny_tt">
                                                        <h6 class="main-content-label mb-1">Address</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="address-container">
                                                            <div class="address-row mb-4">
                                                                <div class="row row-sm mg-b-20">
                                                                    <div class="col-lg">
                                                                        <p class="mg-b-10">Select Country <b class="text-danger">*</b></p>
                                                                        <div class="form-group">
                                                                            <select name="AddressCountry[]" class="countrychange form-control select2">
                                                                                <option value="">Default Select</option>
                                                                                @foreach ($countries as $country)
                                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                        <p class="mg-b-10">State <b class="text-danger">*</b></p>
                                                                        <div class="form-group">
                                                                            <select name="AddressState[]" class="statechange form-control select2">
                                                                                <option value="">Default Select</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                        <p class="mg-b-10">City <b class="text-danger">*</b></p>
                                                                        <div class="form-group">
                                                                            <select name="AddressCity[]" class="citychange form-control select2">
                                                                                <option value="">Default Select</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row row-sm mg-b-20">
                                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                        <p class="mg-b-10">Pin Code <b class="text-danger">*</b></p>
                                                                        <input
                                                                            class="form-control"
                                                                            placeholder="Pin Code"
                                                                            type="text"
                                                                            name="addressPinCode[]"
                                                                            onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"
                                                                        />
                                                                    </div>
                                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                        <p class="mg-b-10">Landmark <b class="text-danger">*</b></p>
                                                                        <input class="form-control" placeholder="Landmark" type="text" name="AddressLandmark[]" />
                                                                    </div>
                                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                        <p class="mg-b-10">Latitude <b class="text-danger">*</b></p>
                                                                        <input class="form-control" placeholder="Latitude" type="text" name="AddressLatitude[]" />
                                                                    </div>
                                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                        <p class="mg-b-10">Longitude <b class="text-danger">*</b></p>
                                                                        <input class="form-control" placeholder="Longitude" type="text" name="AddressLongitude[]" />
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <p class="mg-b-10">Address <b class="text-danger">*</b></p>
                                                                        <textarea name="full_address[]" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                                {{-- <button class="btn btn-danger addRemoveAddressButton" type="button">Remove Address</button> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row row-sm">
                                            <div class="col-lg-12 col-md-12 text-center">
                                                <button type="button" class="btn btn-primary" id="addMoreAddressButton">Add More Address</button>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-4">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary my-2 btn-icon-text">
                                                    <a style="color: white;"> Save & Next <i class="fa fa-save"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <form id="form3">
                                        @csrf
                                        <input type="hidden" name="form" value="3"/>
                                        <input type="hidden" name="hidden_id" value=""/>
                                        <div class="row row-sm">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="card custom-card">
                                                    <div class="mb-4 hny_tt">
                                                        <h6 class="main-content-label mb-1">Certifications</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row row-sm mg-t-20">
                                                            <div class="col-lg">
                                                                <p class="mg-b-10 fw-bold">PAN Card No</p>
                                                                <input class="form-control" name="pan_card_no" placeholder="Card No" type="number" />
                                                            </div>
                                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                <p class="mg-b-10 fw-bold">Address Proof id No</p>
                                                                <input class="form-control" name="address_proof" placeholder="Address Proof id No" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-lg-6 col-md-4 mt-3">
                                                                <p class="mg-b-10 fw-bold">Upload PAN Card</p>
                                                                <input type="file" class="" name="upload_pan" data-height="200" />
                                                            </div>

                                                            <div class="col-lg-6 col-md-4 mt-3">
                                                                <p class="mg-b-10 fw-bold">Upload ID Proof</p>
                                                                <input type="file" class="" name="upload_id" data-height="200" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="col-lg-12 p-0">
                                                                <p class="mg-b-10 fw-bold">Upload Other Documents</p>
                                                                <input type="file" class="" name="upload_other" data-height="100" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-4">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary my-2 btn-icon-text">
                                                    <a style="color: white;"> Save & Next <i class="fa fa-save"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="services">
                                    <form id="form4">
                                        @csrf
                                        <input type="hidden" name="form" value="4"/>
                                        <input type="hidden" name="hidden_id" value=""/>
                                        <div class="row row-sm">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="card custom-card">
                                                    <div class="mb-4 hny_tt">
                                                        <h6 class="main-content-label mb-1">Facilites</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row row-sm mg-t-20">
                                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                <p class="mg-b-10 fw-bold">Number of ambulance <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number of ambulance" type="text" name="numberOfAmbulance" />
                                                            </div>

                                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                <p class="mg-b-10 fw-bold">Pickup drop faclity <b class="text-danger">*</b></p>
                                                                <select name="pickupDropFaclity" class="form-control select2">
                                                                    <option value="">Default Select</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                <p class="mg-b-10 fw-bold">In-house path lab <b class="text-danger">*</b></p>
                                                                <select name="inHousePathLab" class="form-control select2">
                                                                    <option value="">Default Select</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                <p class="mg-b-10 fw-bold">Radiolgy Diagnostics <b class="text-danger">*</b></p>
                                                                <select name="radiolgyDiagnostics" class="form-control select2">
                                                                    <option value="">Default Select</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>

                                                            {{-- <div class="">
                                                                <p class="mg-b-10 fw-bold">Care <b class="text-danger">*</b></p>
                                                                <select name="homeCare" class="form-control select2">
                                                                    <option value="">Default Select</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div> --}}
                                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                <p class="mg-b-10 fw-bold">Care Type <b class="text-danger">*</b></p>
                                                                <div class="form-check">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="home_care" name="care[]">
                                                                        <label class="form-check-label" for="inlineCheckbox1">Home Care</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="critical_care" name="care[]">
                                                                        <label class="form-check-label" for="inlineCheckbox2">Critical Care</label>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>


                                                        <div class="row row-sm mg-t-20">
                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Remote Care <b class="text-danger">*</b></p>
                                                                <select name="remoteCare" class="form-control select2">
                                                                    <option value="">Default Select</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Number Patient/Day In OPD <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number Patient/Day In OPD" type="text" name="numberPatientDayInOpd" />
                                                            </div>

                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Number of Beds in total <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number of Beds in total" type="text" name="numberOfBedsInTotal" />
                                                            </div>

                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Number of General Wards <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number of General Wards" type="text" name="numberOfGeneralWards" />
                                                            </div>

                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Number of ICU <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number of ICU" type="text" name="numberOfIcu" />
                                                            </div>

                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Number of Private Rooms <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number of Private Rooms" type="text" name="numberOfPrivateRooms" />
                                                            </div>

                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Number of Semi Priavate rooms <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number of Semi Priavate rooms" type="text" name="numberOfSemiPriavateRooms" />
                                                            </div>

                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Number of Beds iN Emergency Number of departments <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number of Beds iN Emergency Number of departments" type="text" name="numberOfBedsINEmergencyNumberOfDepartments" />
                                                            </div>

                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Number of clinics <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number of clinics" type="text" name="numberOfClinics" />
                                                            </div>

                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Blood Bank Available or not <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Blood Bank Available or not" type="text" name="bloodBankAvailableOrNot" />
                                                            </div>

                                                            <div class="col-4">
                                                                <p class="mg-b-10 fw-bold">Number of Doctors on-roll <b class="text-danger">*</b></p>
                                                                <input class="form-control" placeholder="Number of Doctors On Roll" type="text" name="numberOfDoctorsOnRoll" />
                                                            </div>
                                                        </div>


                                                        <div class="row row-sm mg-t-20" id="dynamic_facilities">
                                                            <div class="row">
                                                                <div class="col-lg">
                                                                    <p class="mg-b-10 fw-bold">Category of facility <b class="text-danger">*</b></p>
                                                                    <input type="text" name="categoryOfFacility[]"  class="form-control" list="categoryOfFacility" />
                                                                    <datalist id="categoryOfFacility">
                                                                        <option value="">Select Option</option>
                                                                        <option value="OPD">OPD (Outpatient Department)</option>
                                                                        <option value="IPD">IPD (Inpatient Department)</option>
                                                                        <option value="Emergency">Emergency</option>
                                                                        <option value="Radiology">Radiology</option>
                                                                        <option value="Surgery">Surgery</option>
                                                                        <option value="Pediatrics">Pediatrics</option>
                                                                        <option value="Orthopedics">Orthopedics</option>
                                                                        <option value="Oncology">Oncology</option>
                                                                        <option value="Cardiology">Cardiology</option>
                                                                        <option value="Gynecology">Gynecology</option>
                                                                        <option value="Neurology">Neurology</option>
                                                                        <option value="Dermatology">Dermatology</option>
                                                                        <option value="Ophthalmology">Ophthalmology</option>
                                                                        <option value="ENT (Ear, Nose, and Throat)">ENT (Ear, Nose, and Throat)</option>
                                                                        <option value="Urology">Urology</option>
                                                                        <option value="Dentistry">Dentistry</option>
                                                                        <option value="Psychiatry">Psychiatry</option>
                                                                        <option value="Nephrology">Nephrology</option>
                                                                        <option value="Gastroenterology">Gastroenterology</option>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                    <p class="mg-b-10 fw-bold">Name <b class="text-danger">*</b></p>
                                                                    <input class="form-control" placeholder="Full Name" type="text" name="contact_details_name[]"  />
                                                                </div>
                                                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                    <p class="mg-b-10 fw-bold">Email <b class="text-danger">*</b></p>
                                                                    <input class="form-control" placeholder="Email Address" type="email" name="contact_details_email[]"  />
                                                                </div>
                                                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                    <p class="mg-b-10 fw-bold">Contact <b class="text-danger">*</b></p>
                                                                    <input
                                                                        class="form-control"
                                                                        type="number"
                                                                        name="contact_details_contact[]"

                                                                        pattern="[0-9]{10}"
                                                                        title="Please enter exactly 10 digits"
                                                                        placeholder="10 Digit Contact Number"
                                                                        onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"
                                                                        maxlength="10"
                                                                    />
                                                                </div>
                                                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                                                    <p class="mg-b-10 fw-bold">&nbsp;</p>
                                                                    <button id="addfacilities" class="btn btn-primary" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <span id="contactDetailsDynamicFields"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-4">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary my-2 btn-icon-text">
                                                    <a style="color: white;"> Save & Next <i class="fa fa-save"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="bankaccount">
                                    <form id="form5">
                                        @csrf
                                        <input type="hidden" name="form" value="5"/>
                                        <input type="hidden" name="hidden_id" value=""/>
                                        <div class="row row-sm">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="card custom-card">
                                                    <div class="mb-4 hny_tt">
                                                        <h6 class="main-content-label mb-1">Bank Detials</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row row-sm mg-b-20">
                                                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                                <p class="mg-b-10">Bank Name</p>
                                                                <input class="form-control" name="bank_name" placeholder="Bank Name" type="text" />
                                                            </div>
                                                            <!-- col-4 -->
                                                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                                <p class="mg-b-10">Account Holder Name</p>
                                                                <input class="form-control" name="holder_name" placeholder="First Name" type="text" />
                                                            </div>
                                                            <!-- col-4 -->
                                                            <div class="col-lg-4">
                                                                <p class="mg-b-10">Account Type</p>
                                                                <select name="account_type" class="form-control select2">
                                                                    <option label="Choose one"> </option>
                                                                    <option value="Saving">
                                                                        Saving
                                                                    </option>
                                                                    <option value="Current">
                                                                        Current
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <!-- col-4 -->
                                                        </div>
                                                        <div class="row row-sm mg-b-20">
                                                            <div class="col-lg-4">
                                                                <p class="mg-b-10">Account Number</p>
                                                                <input class="form-control" name="acount_number" placeholder="Account Number" type="number" />
                                                            </div>
                                                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                                <p class="mg-b-10">Confirm Account Number</p>
                                                                <input class="form-control" name="acount_number_confirmation" placeholder="Confirm Account Number" type="number" />
                                                            </div>
                                                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                                <p class="mg-b-10">IFSC Code</p>
                                                                <input class="form-control" name="bacnk_ifsc_code" placeholder="IFSC Code" type="number" />
                                                            </div>
                                                        </div>
                                                        <div class="row row-sm">
                                                            <div class="col-lg-4">
                                                                <p class="mg-b-10">Bank Branch</p>
                                                                <input class="form-control" name="bank_branch" placeholder="Bank Branch" type="text" />
                                                            </div>
                                                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                                <p class="mg-b-10">Bank City</p>
                                                                <input class="form-control" name="bank_city" placeholder="Bank City" type="text" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-4">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary my-2 btn-icon-text">
                                                    <a style="color: white;"> Save & Next <i class="fa fa-save"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="media">
                                    <form id="form6">
                                        @csrf
                                        <input type="hidden" name="form" value="6"/>
                                        <input type="hidden" name="hidden_id" value=""/>
                                        <input type="hidden" name="parameter" value="{{request()->route()->parameter('token')}}"/>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hospital_logo">Media Info</label>
                                                    <input type="file" name="hospital_logo" class="form-control" id="hospital_logo" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="banner_image">Banner Picture</label>
                                                    <input type="file" name="banner_picture" class="form-control" id="banner_image" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="banner_image">Brand Colour theme First</label>
                                                    <input type="color" name="brand_color_primary" class="form-control" id="banner_image" value="#14749c" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="banner_image">Brand Colour theme Secondary</label>
                                                    <input type="color" name="brand_color_secondary" class="form-control" id="banner_image" value="#7a576b" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-4">
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary my-2 btn-icon-text">
                                                    <a style="color: white;">
                                                        @if($nextToken != 'hospitals')
                                                        Save & Next
                                                        @else
                                                            Save
                                                        @endif
                                                        <i class="fa fa-save"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php if($nextToken != 'hospitals'){ ?>
                                    <div class="tab-pane fade" id="other">
                                        <form id="form7">
                                            @csrf
                                            <input type="hidden" name="form" value="7"/>
                                            <input type="hidden" name="hidden_id" value=""/>
                                            <input type="hidden" name="parameter" value="{{request()->route()->parameter('token')}}"/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="shortBrief">Short Brief</label>
                                                        <textarea name="shortBrief" id="shortBrief" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo">Logo</label>
                                                        <input type="file" class="form-control" name="logo" id="logo" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bannerImage">Banner Image</label>
                                                        <input type="file" class="form-control" id="bannerImage" name="bannerImage" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3 mb-4">
                                                <div class="col-12 text-end">
                                                    <button type="submit" class="btn btn-primary my-2 btn-icon-text">
                                                        <a style="color: white;"> Save <i class="fa fa-save"></i></a>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{--
        <div class="row mt-3 mb-4">
            <div class="col-12 text-center">
                <button type="button" class="btn btn-primary my-2 btn-icon-text">
                    <a href="javascript:;" style="color: white;"> Register <i class="fa fa-save"></i></a>
                </button>
            </div>
        </div>
    --}}

    </div>
</div>

@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#addContactFields').click(function(){
        $('#contact_dynamic_fields').append(`
            <div class="row">
                <div class="col-lg">
                    <p class="mg-b-10 fw-bold">Designation <b class="text-danger">*</b></p>
                    <div class="form-group">
                        <select class="form-control select2" name="contact_details_designation1[]" >
                            <option value="">Select Option</option>
                            <option value="admin">Admin</option>
                            <option value="it_head">IT Head</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <p class="mg-b-10 fw-bold">Department  <b class="text-danger">*</b></p>
                    <input class="form-control" placeholder="Department" type="text" name="department1[]"  />
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <p class="mg-b-10 fw-bold">Name <b class="text-danger">*</b></p>
                    <input class="form-control" placeholder="Full Name" type="text" name="contact_details_name1[]"  />
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <p class="mg-b-10 fw-bold">Email <b class="text-danger">*</b></p>
                    <input class="form-control" placeholder="Email Address" type="email" name="contact_details_email1[]"  />
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <p class="mg-b-10 fw-bold">Contact <b class="text-danger">*</b></p>
                    <input
                        class="form-control"
                        type="number"
                        name="contact_details_contact1[]"

                        pattern="[0-9]{10}"
                        title="Please enter exactly 10 digits"
                        placeholder="10 Digit Contact Number"
                        onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"
                        maxlength="10"
                    />
                </div>
                <div class="col-lg row align-items-center justify-content-center mt-3">
                    <button onclick="removeField(this)" class="btn btn-primary removefield" type="button">Remove</button>
                </div>
            </div>
        `);
    });
    function removeField(elem){
        $(elem).parent().parent().remove();
    }
    $('#addfacilities').click(function(){
        $('#dynamic_facilities').append(`
            <div class="row">
                <div class="col-lg">
                    <p class="mg-b-10 fw-bold">Category of facility <b class="text-danger">*</b></p>
                    <input type="text" name="categoryOfFacility[]" class="form-control" list="categoryOfFacility">
                    <datalist id="categoryOfFacility">
                        <option value="">Select Option</option>
                        <option value="OPD">OPD (Outpatient Department)</option>
                        <option value="IPD">IPD (Inpatient Department)</option>
                        <option value="Emergency">Emergency</option>
                        <option value="Radiology">Radiology</option>
                        <option value="Surgery">Surgery</option>
                        <option value="Pediatrics">Pediatrics</option>
                        <option value="Orthopedics">Orthopedics</option>
                        <option value="Oncology">Oncology</option>
                        <option value="Cardiology">Cardiology</option>
                        <option value="Gynecology">Gynecology</option>
                        <option value="Neurology">Neurology</option>
                        <option value="Dermatology">Dermatology</option>
                        <option value="Ophthalmology">Ophthalmology</option>
                        <option value="ENT (Ear, Nose, and Throat)">ENT (Ear, Nose, and Throat)</option>
                        <option value="Urology">Urology</option>
                        <option value="Dentistry">Dentistry</option>
                        <option value="Psychiatry">Psychiatry</option>
                        <option value="Nephrology">Nephrology</option>
                        <option value="Gastroenterology">Gastroenterology</option>
                    </datalist>
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <p class="mg-b-10 fw-bold">Name <b class="text-danger">*</b></p>
                    <input class="form-control" placeholder="Full Name" type="text" name="contact_details_name[]">
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <p class="mg-b-10 fw-bold">Email <b class="text-danger">*</b></p>
                    <input class="form-control" placeholder="Email Address" type="email" name="contact_details_email[]">
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <p class="mg-b-10 fw-bold">Contact <b class="text-danger">*</b></p>
                    <input class="form-control" type="number" name="contact_details_contact[]" pattern="[0-9]{10}" title="Please enter exactly 10 digits" placeholder="10 Digit Contact Number" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false) || (95<event.keyCode &amp;&amp; event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 &amp;&amp; event.keyCode<40) || (event.keyCode==46) )" maxlength="10">
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <p class="mg-b-10 fw-bold">&nbsp;</p>
                    <button onclick="removeFacilities(this)" class="btn btn-primary" type="button"> Remove </button>
                </div>
            </div>
        `);
    });
    function removeFacilities(elem){
        $(elem).parent().parent().remove();
    }
    $(document).ready(function () {
        $( "#datepicker" ).datepicker();
        var maxAddresses = 10;
        var minAddresses = 1;
        var addressCount = 1;

        // Function to add a new address field
        function addAddressField() {
            if (addressCount < maxAddresses) {
                addressCount++;
                var newAddressField = `
                    <div class="address-row">
                        <div class="row row-sm mg-b-20">
                            <div class="col-lg">
                                <p class="mg-b-10">Select Country</p>
                                <div class="form-group">
                                    <select name="AddressCountry[]" class="countrychange form-control select2">
                                        <option value="">Default Select</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <p class="mg-b-10">State</p>
                                <div class="form-group">
                                    <select name="AddressState[]" class="statechange form-control select2">
                                        <option value="">Default Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <p class="mg-b-10">City</p>
                                <div class="form-group">
                                    <select name="AddressCity[]" class="citychange form-control select2">
                                        <option value="">Default Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row row-sm mg-b-20">
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <p class="mg-b-10">Pin Code</p>
                                <input
                                    class="form-control"
                                    placeholder="Pin Code"
                                    type="text"
                                    name="addressPinCode[]"
                                    onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"
                                />
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <p class="mg-b-10">Landmark</p>
                                <input class="form-control" placeholder="Landmark" type="text" name="AddressLandmark[]" />
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <p class="mg-b-10">Latitude</p>
                                <input class="form-control" placeholder="Latitude" type="text" name="AddressLatitude[]" />
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <p class="mg-b-10">Longitude</p>
                                <input class="form-control" placeholder="Longitude" type="text" name="AddressLongitude[]" />
                            </div>
                            <div class="col-lg-12">
                                <p class="mg-b-10">Address</p>
                                <textarea name="full_address[]" class="form-control"></textarea>
                            </div>
                        </div>
                        <!-- Modified Remove button -->
                        <div style="text-align: right;">
                            <button class="btn btn-danger addRemoveAddressButton" type="button"><i class="fa fa-trash"></i> Remove </button>
                        </div>
                    </div>`;
                $(".address-container").append(newAddressField);
            }
        }

        // Function to remove an address field
        function removeAddressField() {
            if (addressCount > minAddresses) {
                $(this).closest('.address-row').remove();
                addressCount--;
            }
        }

        // Add an initial address field
        // addAddressField();

        // Event handler for adding more addresses
        $("#addMoreAddressButton").click(addAddressField);

        // Event handler for removing addresses (dynamic elements)
        $(document).on("click", ".addRemoveAddressButton", removeAddressField);
    });
    $('#form1').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'/hospitalFormSave',
            type:'POST',
            datatype:'json',
            data:new FormData(document.getElementById('form1')),
            processData:false,
            contentType:false,
            success:function(res){
                document.querySelector('#address').click();
                $('input[name="hidden_id"]').val(res.insertid);
            },
            error:function(res){
                if(res.status == 422){
                    let error = Object.entries(res.responseJSON.errors)[0][1];
                    $('#errors').text(error);
                    $('#errors').removeClass('d-none');
                    $('html,body').animate({scrollTop:0},'slow');
                    setTimeout(() => {
                        $('#errors').addClass('d-none');
                        $('#errors').text('');
                    }, 4000);
                }
            }
        });
    });
    $('#form2').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'/hospitalFormSave',
            type:'POST',
            datatype:'json',
            data:new FormData(document.getElementById('form2')),
            processData:false,
            contentType:false,
            success:function(res){
                document.querySelector('#documents').click();
                $('input[name="hidden_id"]').val(res.insertid);
            },
            error:function(res){
                if(res.status == 422){
                    let error = Object.entries(res.responseJSON.errors)[0][1];
                    $('#errors').text(error);
                    $('#errors').removeClass('d-none');
                    $('html,body').animate({scrollTop:0},'slow');
                    setTimeout(() => {
                        $('#errors').addClass('d-none');
                        $('#errors').text('');
                    }, 4000);
                }
            }
        });
    });
    $('#form3').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'/hospitalFormSave',
            type:'POST',
            datatype:'json',
            data:new FormData(document.getElementById('form3')),
            processData:false,
            contentType:false,
            success:function(res){
                document.querySelector('#facilities').click();
                $('input[name="hidden_id"]').val(res.insertid);
            },
            error:function(res){
                if(res.status == 422){
                    let error = Object.entries(res.responseJSON.errors)[0][1];
                    $('#errors').text(error);
                    $('#errors').removeClass('d-none');
                    $('html,body').animate({scrollTop:0},'slow');
                    setTimeout(() => {
                        $('#errors').addClass('d-none');
                        $('#errors').text('');
                    }, 4000);
                }
            }
        });
    });
    $('#form4').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'/hospitalFormSave',
            type:'POST',
            datatype:'json',
            data:new FormData(document.getElementById('form4')),
            processData:false,
            contentType:false,
            success:function(res){
                document.querySelector('#account').click();
                $('input[name="hidden_id"]').val(res.insertid);
            },
            error:function(res){
                if(res.status == 422){
                    let error = Object.entries(res.responseJSON.errors)[0][1];
                    $('#errors').text(error);
                    $('#errors').removeClass('d-none');
                    $('html,body').animate({scrollTop:0},'slow');
                    setTimeout(() => {
                        $('#errors').addClass('d-none');
                        $('#errors').text('');
                    }, 4000);
                }
            }
        });
    });
    $('#form5').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'/hospitalFormSave',
            type:'POST',
            datatype:'json',
            data:new FormData(document.getElementById('form5')),
            processData:false,
            contentType:false,
            success:function(res){
                document.querySelector('#mediatab').click();
                $('input[name="hidden_id"]').val(res.insertid);
            },
            error:function(res){
                if(res.status == 422){
                    let error = Object.entries(res.responseJSON.errors)[0][1];
                    $('#errors').text(error);
                    $('#errors').removeClass('d-none');
                    $('html,body').animate({scrollTop:0},'slow');
                    setTimeout(() => {
                        $('#errors').addClass('d-none');
                        $('#errors').text('');
                    }, 4000);
                }
            }
        });
    });
    $('#form6').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'/hospitalFormSave',
            type:'POST',
            datatype:'json',
            data:new FormData(document.getElementById('form6')),
            processData:false,
            contentType:false,
            success:function(res){
                let routeCheck = "<?php print_r(request()->route()->parameter('token'))?>";
                if(routeCheck != 'hospitals'){
                    document.querySelector('#othertab').click();
                    $('input[name="hidden_id"]').val(res.insertid);
                }else{
                    window.location.href="/hospitalList";
                }
            },
            error:function(res){
                if(res.status == 422){
                    let error = Object.entries(res.responseJSON.errors)[0][1];
                    $('#errors').text(error);
                    $('#errors').removeClass('d-none');
                    $('html,body').animate({scrollTop:0},'slow');
                    setTimeout(() => {
                        $('#errors').addClass('d-none');
                        $('#errors').text('');
                    }, 4000);
                }
            }
        });
    });
    $('input[name="upload_pan"]').dropify();
    $('input[name="upload_id"]').dropify();
    $('input[name="upload_other"]').dropify();
    $(document).on('change','.countrychange',function(){
        let element = $(this);
        // element.closest('.col-lg').next().find('.statechange')
        $.ajax({
            url:'/states',
            type:'post',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            datatype:'json',
            data:{country_id:element.val()},
            success:function(res){
                element.closest('.col-lg').next().find('.statechange').html(res.html_data);
            },
            error:function(res){
            }
        });
    });
    $(document).on('change','.statechange',function(){
        let element = $(this);
        // element.closest('.col-lg').next().find('.statechange')
        $.ajax({
            url:'/cities',
            type:'post',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            datatype:'json',
            data:{state_id:element.val()},
            success:function(res){
                element.closest('.col-lg').next().find('.citychange').html(res.html_data);
            },
            error:function(res){
            }
        });
    });
</script>
@if($nextToken != 'hospitals')
<script>
    $('#form7').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'/hospitalFormSave',
            type:'POST',
            datatype:'json',
            data:new FormData(document.getElementById('form7')),
            processData:false,
            contentType:false,
            success:function(res){
                window.location.href="/hospitalList";
            },
            error:function(res){
                if(res.status == 422){
                    let error = Object.entries(res.responseJSON.errors)[0][1];
                    $('#errors').text(error);
                    $('#errors').removeClass('d-none');
                    $('html,body').animate({scrollTop:0},'slow');
                    setTimeout(() => {
                        $('#errors').addClass('d-none');
                        $('#errors').text('');
                    }, 4000);
                }
            }
        });
    });
</script>
@endif
@endsection
