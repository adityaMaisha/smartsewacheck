@extends('admin.layout.master')
@section('style')
@endsection
@section('content')
    <div class="main-content side-content pt-0">
        <div class="main-container container-fluid">
            <div class="inner-body">


                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Add New Employee</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Employee</li>
                        </ol>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <a href="{{ route('list.employee') }}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End Page Header -->

                <form action="{{ route('new.employee') }}" method="POST" enctype="multipart/form-data" id="employeeFormData">
                    @csrf

                    <div class="row row-sm">
                        <div class="col-lg-12 col-md-12">
                            <div class="card custom-card">
                                <div class="mb-4 hny_tt">
                                    <h6 class="main-content-label mb-1">Personal Detail</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg-4">
                                            <p class="mg-b-10">Department <b class="text-danger">*</b></p>
                                            <select class="form-control select2" name="department_uuid" required>
                                                <option value="">Choose department</option>
                                                @foreach ($roles_list as $role)
                                                    <option value="{{ lock($role->uuid) }}">{{ $role->title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger ERROR__department_uuid"></span>
                                        </div>

                                        <div class="col-lg-4">
                                            <p class="mg-b-10">Designation <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Designation" type="text" name="designation" list="designationList" required>
                                            <datalist id="designationList">
                                                <option value="CEO (Chief Executive Officer)">
                                                <option value="CFO (Chief Financial Officer)">
                                                <option value="COO (Chief Operating Officer)">
                                                <option value="CTO (Chief Technology Officer)">
                                                <option value="CMO (Chief Marketing Officer)">
                                                <option value="CIO (Chief Information Officer)">
                                                <option value="HR Director (Human Resources Director)">
                                                <option value="VP of Sales (Vice President of Sales)">
                                                <option value="VP of Marketing (Vice President of Marketing)">
                                                <option value="VP of Operations (Vice President of Operations)">
                                                <option value="VP of Finance (Vice President of Finance)">
                                                <option value="Project Manager">
                                                <option value="Account Manager">
                                                <option value="Software Engineer">
                                                <option value="Data Analyst">
                                                <option value="Graphic Designer">
                                                <option value="Marketing Manager">
                                                <option value="Sales Manager">
                                                <option value="Operations Manager">
                                                <option value="Financial Analyst">
                                                <option value="Administrative Assistant">
                                                <option value="Customer Service Representative">
                                                <option value="Human Resources Manager">
                                                <option value="Business Development Manager">
                                                <option value="IT Support Specialist">
                                                <option value="Product Manager">
                                                <option value="Quality Assurance Analyst">
                                                <option value="Research Analyst">
                                                <option value="Content Writer">
                                                <option value="Public Relations Specialist">
                                                <option value="Executive Assistant">
                                                <option value="Web Developer">
                                                <option value="Systems Administrator">
                                                <option value="Supply Chain Manager">
                                                <option value="Procurement Specialist">
                                                <option value="Legal Counsel">
                                                <option value="Network Engineer">
                                                <option value="UX/UI Designer">
                                                <option value="Accountant">
                                                <option value="Social Media Manager">
                                                <option value="Brand Manager">
                                                <option value="Sales Representative">
                                                <option value="Customer Success Manager">
                                                <option value="Project Coordinator">
                                                <option value="Operations Coordinator">
                                                <option value="Financial Controller">
                                                <option value="Compliance Officer">
                                                <option value="Event Coordinator">
                                                <option value="Business Analyst">
                                                <option value="Inside Sales Representative">
                                            </datalist>
                                            <span class="text-danger ERROR__designation"></span>
                                        </div>

                                        <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                            <p class="mg-b-10">Date of birth <b class="text-danger">*</b></p>
                                            <div class="mg-b-20">
                                                <div class="input-group">
                                                    <div class="input-group-text border-end-0">
                                                        <i class="fe fe-calendar lh--9 op-6"></i>
                                                    </div>
                                                    <input class="form-control fc-datepicker" required
                                                        placeholder="MM/DD/YYYY" type="text" name="date_of_birth">
                                                </div>
                                                <span class="text-danger ERROR__date_of_birth"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg">
                                            <p class="mg-b-10">First Name <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="First Name" type="text"
                                                name="employee_first_name" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                            <span class="text-danger ERROR__employee_first_name"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Last Name <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Lasst Name" type="text"
                                                name="employee_last_name" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                            <span class="text-danger ERROR__employee_last_name"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Employee Profile</p>
                                            <div class="input-group file-browser">
                                                <input type="text" class="form-control border-end-0 browse-file"
                                                    placeholder="Choose File" readonly="">
                                                <label class="input-group-btn">
                                                    <span class="btn btn-primary">
                                                        Browse <input type="file" style="display: none;"
                                                            name="employee_profile">
                                                    </span>
                                                </label>
                                            </div>
                                            <span class="text-danger ERROR__employee_profile"></span>
                                        </div>

                                    </div>

                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Date of joining</p>
                                            <div class="mg-b-20">
                                                <div class="input-group">
                                                    <div class="input-group-text border-end-0">
                                                        <i class="fe fe-calendar lh--9 op-6"></i>
                                                    </div>
                                                    <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                                        type="text" name="date_of_joining">
                                                </div>
                                                <span class="text-danger ERROR__date_of_joining"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
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
                                    </div>

                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg">
                                            <p class="mg-b-10">Email <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Enter Email" type="email"
                                                name="email_id" required>
                                                <span class="text-danger ERROR__email_id"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Mobile </p>
                                            <input class="form-control" type="text" name="mobile_number" pattern="[0-9]{10}" title="Please enter exactly 10 digits" placeholder="10 Digit Mobile Number" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10">
                                                <span class="text-danger ERROR__mobile_number"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Blood Group </p>
                                            <div class="form-group ">
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
                                    </div>
                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg">
                                            <p class="mg-b-10">Country <b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                                <select name="country" class="form-control select2" required
                                                    id="user_country">
                                                    <option value="">Select Employee Country</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger ERROR__country"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">State <b class="text-danger">*</b></p>
                                            <div class="form-group">
                                                <select name="state" class="form-control select2" required
                                                    id="user_state"></select>
                                                    <span class="text-danger ERROR__state"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">City <b class="text-danger">*</b></p>
                                            <div class="form-group">
                                                <select name="city" class="form-control select2" required
                                                    id="user_city"></select>
                                                    <span class="text-danger ERROR__city"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg">
                                            <p class="mg-b-10">Address <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Address" type="text" required
                                                name="address">
                                            <span class="text-danger ERROR__address"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Pin Code</p>
                                            <input class="form-control" placeholder="Pin Code" type="number"
                                                name="pin_code" pattern="[0-9]" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10">
                                            <span class="text-danger ERROR__pin_code"></span>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Emergency Contact <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Emergency Contact" type="text"
                                                required name="emergency_contact" pattern="[0-9]{10}" title="Please enter exactly 10 digits" placeholder="10 Digit Mobile Number" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10">
                                            <span class="text-danger ERROR__emergency_contact"></span>
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
                                    <h6 class="main-content-label mb-1">Office Details</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row row-sm">
                                        <div class="col-lg-6">
                                            <p class="mg-b-10">Office Email <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Office Email" type="Email" readonly onfocus="this.removeAttribute('readonly');"
                                                name="office_email" required>
                                            <span class="text-danger ERROR__office_email"></span>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-b-10">Login Password <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Login Password" type="password" name="password" required readonly onfocus="this.removeAttribute('readonly');">
                                            <span class="text-danger ERROR__password"></span>
                                        </div>
                                        <div class="col-lg-6 mt-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Office Mobile</p>
                                            <input class="form-control" placeholder="Office Mobile" type="text"
                                                name="office_mobile" pattern="[0-9]{10}" title="Please enter exactly 10 digits" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10">
                                            <span class="text-danger ERROR__office_mobile"></span>
                                        </div>
                                        <div class="col-lg-6 mt-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Right to Excess <b class="text-danger">*</b></p>
                                            <select class="form-control select2" name="right_to_access" required>
                                                <option value="active">Active (User can log in from the dashboard)</option>
                                                <option value="inactive">Deactive (User can't log in to the dashboard)</option>
                                            </select>
                                            <span class="text-danger ERROR__right_to_access"></span>
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
                                            <input class="form-control" placeholder="Adhaar Card No" type="text" required
                                                name="adhaar_card_number" pattern="[0-9]{12}" title="Please enter valid 12 digits" placeholder="12 Digit Adhaar Card Number" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="12">
                                                <span class="text-danger ERROR__adhaar_card_number"></span>
                                        </div>
                                        <div class="col-lg-4">
                                            <p class="mg-b-10 fw-bold">PAN Card No <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Card No" type="text" required
                                                name="pan_card_number" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Enter Valid Pan Card Number ( Example: ABCTY1234D )">
                                                <span class="text-danger ERROR__pan_card_number"></span>
                                        </div>
                                        <div class="col-lg-4 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10 fw-bold">Address Proof id No</p>
                                            <input class="form-control" placeholder="Address Proof id No" type="text" name="address_proof_id_no">
                                                <span class="text-danger ERROR__address_proof_id_no"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-4 col-md-4  mt-3">
                                            <p class="mg-b-10 fw-bold">Adhaar Card Upload</p>
                                            <input type="file" class="dropify" data-height="100" name="upload_adhaar_card_attachment">
                                                <span class="text-danger ERROR__upload_adhaar_card_attachment"></span>
                                        </div>

                                        <div class="col-lg-4 col-md-4  mt-3">
                                            <p class="mg-b-10 fw-bold">PAN Card Upload</p>
                                            <input type="file" class="dropify" data-height="100"
                                                name="upload_pan_card_attachment">
                                                <span class="text-danger ERROR__upload_pan_card_attachment"></span>
                                        </div>

                                        <div class="col-lg-4 col-md-4  mt-3">
                                            <p class="mg-b-10 fw-bold">Resume Upload</p>
                                            <input type="file" class="dropify" data-height="100"
                                                name="upload_resume_attachment">
                                                <span class="text-danger ERROR__upload_resume_attachment"></span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-lg-12 p-0">
                                            <p class="mg-b-10 fw-bold">Qualification Certifactes Documents</p>
                                            <input type="file" class="dropify" data-height="100"
                                                name="upload_other_documents[]" multiple>
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
                                    <h6 class="main-content-label mb-1">Bank Detials</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                            <p class="mg-b-10">Bank Name <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Bank Name" type="text"
                                                name="employee_bank_name">
                                                <span class="text-danger ERROR__employee_bank_name"></span>
                                        </div>
                                        <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                            <p class="mg-b-10">Account Holder Name <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="First Name" type="text"
                                                name="bank_account_holder_name">
                                                <span class="text-danger ERROR__bank_account_holder_name"></span>
                                        </div>

                                        <div class="col-lg-4">
                                            <p class="mg-b-10">Account Type <b class="text-danger">*</b></p>
                                            <select class="form-control select2" name="bank_account_type" required>
                                                <option label="Account Type"></option>
                                                <option value="saving">Saving</option>
                                                <option value="current">Current</option>
                                            </select>
                                            <span class="text-danger ERROR__bank_account_type"></span>
                                        </div>
                                    </div>
                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg-4">
                                            <p class="mg-b-10">Account Number <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Account Number" required
                                                type="text" name="bank_account_number">
                                                <span class="text-danger ERROR__bank_account_number"></span>
                                        </div>
                                        <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                            <p class="mg-b-10">Confirm Account Number <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Confirm Account Number" required
                                                id="confirm_account_number" name="confirm_account_number" type="number">
                                                <span class="text-danger ERROR__confirm_account_number"></span>
                                        </div>
                                        <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                            <p class="mg-b-10">IFSC Code <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="IFSC Code" type="text" required
                                                name="bank_ifsc_code">
                                                <span class="text-danger ERROR__bank_ifsc_code"></span>
                                        </div>
                                    </div>
                                    <div class="row row-sm">
                                        <div class="col-lg-4">
                                            <p class="mg-b-10">Bank Branch <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Bank Branch" type="text" required
                                                name="bank_branch">
                                                <span class="text-danger ERROR__bank_branch"></span>
                                        </div>
                                        <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                            <p class="mg-b-10">Bank City <b class="text-danger">*</b></p>
                                            <input class="form-control" placeholder="Bank City" type="text" required
                                                name="bank_city">
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
                                            <p class="mg-b-10">Reference</p>
                                            <input class="form-control" placeholder="Reference (if any)" type="text"
                                                name="reference_name">
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
                                value="&nbsp; Create New Employee &nbsp;">
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
            getDynamicStates();
            getDynamicCities();
            $("select#user_country").change(getDynamicStates);
            $("select#user_state").change(getDynamicCities);
        });


        $(document).on('submit', '#employeeFormData', function(ev) {

            ev.preventDefault();
            var frm = $('#employeeFormData');
            var form = $('#employeeFormData')[0];
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

                    if (data.success == true) {
                        python(data.message, 'Great');
                    }else{
                        python(data.message, 'Whoops!', 'red');
                        $.each(data.errors, function (field, message) {
                            $(".ERROR__" + field).html('<div class="text-danger">' + message + "</div>");
                        });
                    }

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
