@extends('admin.layout.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.min.js" integrity="sha512-E6nwMgRlXtH01Lbn4sgPAn+WoV2UoEBlpgg9Ghs/YYOmxNpnOAS49+14JMxIKxKSH3DqsAUi13vo/y1wo9S/1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/jQuery.tagify.min.js" integrity="sha512-p9gMF/ac5BAhDZi+ZBkd4sOXZpo0++/DaJ0O6GU/32lizIT9wZPXTIVrPoZ8Erstl6SXnkginEaQNCDhez6Jww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.min.css" integrity="sha512-yWu5jVw5P8+IsI7tK+Uuc7pFfQvWiBfFfVlT5r0KP6UogGtZEc4BxDIhNwUysMKbLjqCezf6D8l6lWNQI6MR7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('style')
<style>
    tags.tagify.form-control {
    height: auto;
    display: flex;
    align-items: center;
}
</style>
@endsection
@section('content')
    <div class="main-content side-content pt-0">
        <div class="main-container container-fluid">
            <div class="inner-body">

                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Assign to LAB (<span class="text-danger">Order ID - #S112233</span>)</h2>
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

                <form action="{{ route('sendData.labAPI') }}" id="send_to_lab" method="post" enctype="multipart/form-data" >
                    @csrf

                    <div class="row row-sm">
                        <div class="col-lg-12 col-md-12">
                            <div class="card custom-card">
                                <div class="mb-4 hny_tt">
                                    <h6 class="main-content-label mb-1">Details For LAB</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Select LAB for assign</p>
                                            <div class="form-group ">
                                            <select name="assign_lab" class="form-control">
                                                <option value="" selected>Select LAB</option>
                                                <option value="Normal">LAB One</option>
                                                <option value="Stat">LAB Two</option>
                                            </select>
                                            <span class="text-danger ERROR__assign_lab"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Priority</p>
                                            <div class="form-group ">
                                            <select name="priority" class="form-control">
                                                <option value="" selected>Select Priority</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Stat">Stat</option>
                                            </select>
                                            <span class="text-danger ERROR__priority"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Barcode<b class="text-danger">*</b></p>
                                            <div class="form-group">
                                            <input class="form-control" placeholder="Enter Barcode" type="text" name="barcode" >
                                            <span class="text-danger ERROR__barcode"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">POD Number</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter POD Number" type="text" name="pod_number" >
                                            <span class="text-danger ERROR__pod_number"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">First Name<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter First Name" type="text" name="first_name" >
                                            <span class="text-danger ERROR__first_name"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Last Name<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Last Name" type="text" name="last_name" >
                                            <span class="text-danger ERROR__last_name"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">DOB<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" type="text" name="dob" >
                                            <span class="text-danger ERROR__dob"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Age<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Age" type="text" name="age" >
                                            <span class="text-danger ERROR__age"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Gender </p>
                                            <div class="form-group ">
                                                <select name="gender" class="form-control select2">
                                                    <option value="" selected>Select Gender</option>
                                                    <option value="m">Male</option>
                                                    <option value="f">Female</option>
                                                    <option value="u">Unknown</option>
                                                </select>
                                                <span class="text-danger ERROR__blood_group"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">UID</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="User ID" type="text" name="uid_number" >
                                            <span class="text-danger ERROR__uid_number"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">MRN No.</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="MRN Number" type="text" name="mrn_number" >
                                            <span class="text-danger ERROR__mrn_number"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Mobile<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Mobile Number" type="number" name="mobile" >
                                            <span class="text-danger ERROR__mobile"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Email<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Email" type="email" name="email" >
                                            <span class="text-danger ERROR__email"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Pin Code<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Pin Code" type="number" name="pin_code" >
                                            <span class="text-danger ERROR__pin_code"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Address</p>
                                            <div class="form-group ">
                                            <textarea class="form-control" placeholder="Enter Address" type="text" name="address" ></textarea>
                                            <span class="text-danger ERROR__address"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Client Code</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Client Code" type="text" name="client" >
                                            <span class="text-danger ERROR__client"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Institution Code<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Institution Code" type="text" name="institution" >
                                            <span class="text-danger ERROR__institution"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Physician Code<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Physician Code" type="text" name="physician" >
                                            <span class="text-danger ERROR__physician"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Physician Name<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Physician Name" type="text" name="physician_name" >
                                            <span class="text-danger ERROR__physician_name"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Physician City</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Physician City" type="text" name="physician_city" >
                                            <span class="text-danger ERROR__physician_city"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Physician Address</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Physician Address" type="text" name="physician_address" >
                                            <span class="text-danger ERROR__physician_address"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Physician Number</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Physician Number" type="text" name="physician_number" >
                                            <span class="text-danger ERROR__physician_number"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Physician Number</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Physician Number" type="text" name="physician_number" >
                                            <span class="text-danger ERROR__physician_number"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Temperature</p>
                                            <div class="form-group ">
                                                <select name="temperature" class="form-control select2">
                                                    <option value="" selected>Select Temperature</option>
                                                    <option value="Ambient">Ambient</option>
                                                    <option value="Refrigerated ">Refrigerated </option>
                                                    <option value="Frozen">Frozen</option>
                                                </select>
                                                <span class="text-danger ERROR__temperature"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Requested By Email<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Requested By Email" type="email" name="requested_by_email" >
                                            <span class="text-danger ERROR__requested_by_email"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 p-0">
                                            <p class="mg-b-10 fw-bold">Upload Documents</p>
                                            <input type="file" class="dropify" data-height="100"
                                                name="uploadfile[]" multiple>
                                                <span class="text-danger ERROR__uploadfile"></span>
                                        </div>
                                    </div>
                                    <div class="row row-sm" id="addnew_test">
                                        <div class="col-lg-6 d-flex justify-content-between gap-2">
                                            <input type="hidden" class="rowcount_test" value="" name="rowcount_test">
                                            <div class="mg-t-10 mg-lg-t-0 w-100">
                                            <p class="mg-b-10">Test<b class="text-danger">*</b></p>
                                            <div class="form-group">
                                            <input class="form-control" placeholder="Enter Test" type="text" id="test" name="test[]" >
                                            <span class="text-danger ERROR__test"></span>
                                            </div>
                                            </div>
                                        
                                            <div class="mg-t-10 mg-lg-t-0">
                                                <div class="form-group">
                                                    <p class="mg-b-10 mt-4"></p>
                                                    <input type="button" class="btn btn-primary my-2 btn-icon-text" id="addMoreButton_panel" onclick="add_new_row_test();" style="color: white;" value="&nbsp; Add More &nbsp;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm"  id="addnew_panel">
                                        <div class="col-lg-6 d-flex justify-content-between gap-2">
                                        <div class="mg-t-10 mg-lg-t-0 w-100">
                                            <p class="mg-b-10">Panel<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Panel" type="text" id="panel" name="panel[]" >
                                            <span class="text-danger ERROR__panel"></span>
                                            </div>
                                        </div>
                                        <input type="hidden" class="rowcount_panel" value="" name="rowcount_panel">
                                        <div class=" mg-t-10 mg-lg-t-0">
                                            <div class="form-group">
                                                <p class="mg-b-10 mt-4"></p>
                                                <input type="button" class="btn btn-primary my-2 btn-icon-text" id="addMoreButton_panel" onclick="add_new_row_panel();" style="color: white;" value="&nbsp; Add More &nbsp;">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm">
                                        <div class="col-lg-2 col-md-2">
                                            <div class="form-group ">
                                            <label class="ckbox"><input type="checkbox" name="clinicalhistoryattached"><span>Clinic History</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 mg-t-20 mg-lg-t-0">
                                            <div class="form-group ">
                                            <label class="ckbox"><input type="checkbox" name="historyofsmoking"><span>Smoking</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 mg-t-20 mg-lg-t-0">
                                            <div class="form-group ">
                                            <label class="ckbox"><input type="checkbox" name="pasthistoryofcancer"><span>Cancer</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 mg-t-20 mg-lg-t-0">
                                            <div class="form-group ">
                                            <label class="ckbox"><input type="checkbox" name="diabetes"><span>Diabetes</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 mg-t-20 mg-lg-t-0">
                                            <label class="ckbox"><input type="checkbox" name="drugintakeifany"><span>Take Any Drug</span></label>
                                        </div>
                                        
                                        <div class="col-lg-2 col-md-2 mg-t-20 mg-lg-t-0">
                                            <div class="form-group">
                                            <label class="ckbox"><input type="checkbox" name="otherhistory"><span>Other History</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-2 mg-t-20 mg-lg-t-0">
                                            <div class="form-group ">
                                            <label class="ckbox"><input type="checkbox" name="other_hist_desc"><span>Other History Description</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-2 mg-t-20 mg-lg-t-0">
                                            <div class="form-group ">
                                            <label class="ckbox"><input type="checkbox" name="radiologicalendoscopicfindings"><span>Finding Radiological</span></label>
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
                                    <h6 class="main-content-label mb-1">Specimen Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="add_more_field" id="addnew">
                                    <div class="address-row">
                                    <div class="row row-sm mg-b-20 ">
                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Specimen Barcode</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Specimen Barcode" type="text" name="specimen_barcode[]" >
                                            <span class="text-danger ERROR__specimen_barcode"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Specimen Name<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Specimen Name" type="text" name="specimen_name[]" >
                                            <span class="text-danger ERROR__specimen_name"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Container Title</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Container Title" type="text" name="container_title[]" >
                                            <span class="text-danger ERROR__container_title"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Preservation Title</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Preservation Title" type="text" name="preservation_title[]" >
                                            <span class="text-danger ERROR__preservation_title"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Preservation Title</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Preservation Title" type="text" name="minimum_vol_weight[]" >
                                            <span class="text-danger ERROR__minimum_vol_weight"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Unit Name</p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Unit Name" type="text" name="unit_name[]" >
                                            <span class="text-danger ERROR__minimum_unit_name"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <p class="mg-b-10">Quantity<b class="text-danger">*</b></p>
                                            <div class="form-group ">
                                            <input class="form-control" placeholder="Enter Quantity" type="text" name="quantity[]" >
                                            <span class="text-danger ERROR__quantity"></span>
                                            </div>
                                        </div>
                                        <input type="hidden" class="rowcount" value="" name="rowcount">
                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0 ">
                                            <div class="form-group">
                                                <p class="mg-b-10 mt-4"></p>
                                                <input type="button" class="btn btn-primary my-2 btn-icon-text" id="addMoreButton" onclick="add_new_row();" style="color: white;" value="&nbsp; Add More &nbsp;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3 mb-4">
                        <div class="col-12 text-center">
                            <input type="submit" class="btn btn-primary my-2 btn-icon-text" name="submit" id="submit"  style="color: white;"
                                value="&nbsp; Assign to LAB &nbsp;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    // The DOM elements you wish to replace with Tagify
var input1 = document.querySelector("#test");
var input2 = document.querySelector("#panel");
// Initialize Tagify components on the above inputs
// new Tagify(input1);
// new Tagify(input2);


// submit form
$(document).on('submit', '#send_to_lab', function(ev) {

ev.preventDefault();
var frm = $('#send_to_lab');
var form = $('#send_to_lab')[0];
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

<script>
    var rowcount = 1;
    $(".rowcount").val(rowcount);

    function add_new_row() {
        rowcount++;
        $(".rowcount").val(rowcount);

        var html = '<div class="add_more_field" id="addnew' + rowcount + '" >';
        html += '<div class="col-lg-3 mg-t-10 mg-lg-t-0"><p class="mg-b-10">Specimen Barcode</p><div class="form-group "><input class="form-control" placeholder="Enter Specimen Barcode" type="text" name="specimen_barcode[]" ><span class="text-danger ERROR__specimen_barcode"></span></div></div>';
        html += '<div class="col-lg-3 mg-t-10 mg-lg-t-0"><p class="mg-b-10">Specimen Name<b class="text-danger">*</b></p><div class="form-group "><input class="form-control" placeholder="Enter Specimen Name" type="text" name="specimen_name[]" ><span class="text-danger ERROR__specimen_name"></span></div></div>';
        html += '<div class="col-lg-3 mg-t-10 mg-lg-t-0"><p class="mg-b-10">Container Title</p><div class="form-group "><input class="form-control" placeholder="Enter Container Title" type="text" name="container_title[]" ><span class="text-danger ERROR__container_title"></span></div></div>';
        html += '<div class="col-lg-3 mg-t-10 mg-lg-t-0"><p class="mg-b-10">Preservation Title</p><div class="form-group "><input class="form-control" placeholder="Enter Preservation Title" type="text" name="preservation_title[]" ><span class="text-danger ERROR__preservation_title"></span></div></div>';
        html += '<div class="col-lg-3 mg-t-10 mg-lg-t-0"><p class="mg-b-10">Vol. Weight</p><div class="form-group "><input class="form-control" placeholder="Enter Preservation Title" type="text" name="minimum_vol_weight[]" ><span class="text-danger ERROR__minimum_vol_weight"></span></div></div>';
        html += '<div class="col-lg-3 mg-t-10 mg-lg-t-0"><p class="mg-b-10">Unit Name</p><div class="form-group "><input class="form-control" placeholder="Enter Unit Name" type="text" name="unit_name[]" ><span class="text-danger ERROR__minimum_unit_name"></span></div></div>';
        html += '<div class="col-lg-3 mg-t-10 mg-lg-t-0"><p class="mg-b-10">Quantity<b class="text-danger">*</b></p><div class="form-group "><input class="form-control" placeholder="Enter Quantity" type="text" name="quantity[]" ><span class="text-danger ERROR__quantity"></span></div></div>';
        html += '<div class="col-lg-3 mg-t-10 mg-lg-t-0 "><div class="form-group "><p class="mg-b-10 mt-4"></p><button class="btn btn-danger" onclick="removerow(' + rowcount +');" type="button"><i class="fa fa-trash"></i> Remove </button></div></div>';
        html += '</div>';
        $('#addnew').append(html);

    }

    function removerow(product) {
        $('#addnew' + product).remove();
    }
</script>
<script>
    var rowcount = 1;
    $(".rowcount_test").val(rowcount);

    function add_new_row_test() {
        rowcount++;
        $(".rowcount_test").val(rowcount);
        var html = '<div class="row row-sm" id="addnew_test'+rowcount+'">'
            html += '<div class="col-lg-6 d-flex justify-content-between gap-2">'
        html += '<input type="hidden" class="rowcount_test" value="" name="rowcount_test"><div class="mg-t-10 mg-lg-t-0 w-100"><p class="mg-b-10">Test<b class="text-danger">*</b></p><div class="form-group"><input class="form-control" placeholder="Enter Test" type="text" id="test" name="test[]" ><span class="text-danger ERROR__test"></span></div></div>';
        html += '<div class="mg-t-10 mg-lg-t-0 mt-2"><div class="form-group "><p class="mg-b-10 mt-4"></p><button class="btn btn-danger" onclick="removerow_test(' + rowcount +');" type="button">Remove </button></div></div>';
        html += '</div></div></div>';
        $('#addnew_test').append(html);

    }
    function removerow_test(product) {
        $('#addnew_test' + product).remove();
    }
</script>

<script>
    var rowcount = 1;
    $(".rowcount_panel").val(rowcount);

    function add_new_row_panel() {
        rowcount++;
        $(".rowcount_panel").val(rowcount);
        var html = '<div class="row row-sm" id="addnew_panel'+rowcount+'">'
            html += '<div class="col-lg-6 d-flex justify-content-between gap-2">'
        html += '<input type="hidden" class="rowcount_panel" value="" name="rowcount_panel"><div class="mg-t-10 mg-lg-t-0 w-100"><p class="mg-b-10">Panel<b class="text-danger">*</b></p><div class="form-group"><input class="form-control" placeholder="Enter Panel" type="text" id="panel" name="panel[]" ><span class="text-danger ERROR__panel"></span></div></div>';
        html += '<div class="mg-t-10 mg-lg-t-0 mt-2"><div class="form-group "><p class="mg-b-10 mt-4"></p><button class="btn btn-danger" onclick="removerow_panel(' + rowcount +');" type="button">Remove </button></div></div>';
        html += '</div></div></div>';
        $('#addnew_panel').append(html);

    }
    function removerow_panel(product) {
        $('#addnew_panel' + product).remove();
    }
</script>
@endsection
