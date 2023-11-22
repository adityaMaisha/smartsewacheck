<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalOther;
use App\Models\Admin;
use App\Models\countries;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class HospitalController extends Controller
{
    public function vendorNewSetup(Request $request)
    {
        try {
            if ( request()->isMethod('post') ) {
                return response()->json(['success' => true, 'url' => route('vendor.new.step.01', $request->input('vendorType')), 'msg' => 'next step open']);
            }else{
                return view('admin/hospital/hospital-step-0');
            }

        } catch (\Exception $e) {
            prx(['error' => $e->getMessage(), 'line' => $e->getLine()]);
        }
    }

    public function vendorNewToken01(Request $request, $nextToken){

        try {
            if ( request()->isMethod('post') ) {

                prx( $request->all() );

            }else{

                return view('admin/hospital/hospital-step-1',[
                    'nextToken' => $nextToken,
                    'countries'=>countries::get()
                ]);
            }

        } catch (\Exception $e) {
            prx(['error' => $e->getMessage(), 'line' => $e->getLine()]);
        }

    }

    public function hospitalList(){
        $getData = HospitalOther::where('trash',"0")->get();
        return view('admin.hospital.hospitalList',compact('getData'));
    }

    public function hospitalFormSave(Request $request){
        try{
            if($request->form == "1"){
                // dd($request->all());
                $this->validate($request,[
                    "hospitalType"=>'required',
                    "hospitalFullName"=>'required',
                    "hospitalDisplayName"=>'required',
                    "establisementDate"=>'required',
                    "shortBrief"=>'required',
                    "speciality"=>'required',
                    "contact_details_designation1"=>'required',
                    "department1"=>'required',
                    "contact_details_name1"=>'required',
                    "contact_details_email1"=>'required',
                    "contact_details_contact1"=>'required',
                    "helplineNumber"=>'required',
                    "emergencyContact"=>'required',
                    "login_email"=>"required|unique:admin,email"
                ],[
                    "hospitalType.required"=>"Please select hospital type field",
                    "hospitalFullName.required"=>"Please fill hospital name field",
                    "hospitalDisplayName.required"=>"Please fill display name field",
                    "establisementDate.required"=>"Please select establishment date field",
                    "shortBrief.required"=>"Please fill short brief field",
                    "speciality.required"=>"Please select speciality field",
                    "contact_details_designation1.required"=>"Please select designation field",
                    "department.required1"=>"Please fill department field",
                    "contact_details_name1.required"=>"Please fill name field",
                    "contact_details_email1.required"=>"Please fill email field",
                    "contact_details_contact1.required"=>"Please fill contact field",
                    "helplineNumber.required"=>"Please fill helpline number field",
                    "emergencyContact.required"=>"Please fill emergency contact field",
                    "login_email.required"=>"Please fill email field",
                    "login_email.unique"=>"Email Id already taken"
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);

                if(empty($request->hidden_id)){
                    $inputs['trash']="0";
                    $inputs['status']="0";
                    $insert = HospitalOther::create($inputs);
                    $setId = encrypt($insert->_id);
                }else{
                    $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                    $setId = $request->hidden_id;
                }

                if($insert){
                    return response()->json([
                        'message'=>'insert successfull',
                        'insertid'=>$setId,
                        'form'=>"2"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "2"){
                $this->validate($request,[
                    "AddressCountry"=>'required',
                    "AddressState"=>'required',
                    "AddressCity"=>'required',
                    "addressPinCode"=>'required',
                    "AddressLandmark"=>'required',
                    "AddressLatitude"=>'required',
                    "AddressLongitude"=>'required',
                    "full_address"=>'required',
                ],[
                    "AddressCountry.required"=>'Please select country field',
                    "AddressState.required"=>'Please select state field',
                    "AddressCity.required"=>'Please select city field',
                    "addressPinCode.required"=>'Please fill pincode field',
                    "AddressLandmark.required"=>'Please fill landmark field',
                    "AddressLatitude.required"=>'Please fill latitude field',
                    "AddressLongitude.required"=>'Please fill longtitude field',
                    "full_address.required"=>'Please fill address field',
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"3"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "3"){
                $this->validate($request,[
                    "pan_card_no"=>'required',
                    "address_proof"=>'required',
                    "upload_pan"=>'required',
                    "upload_id"=>'required',
                    "upload_other"=>'required',
                ],[
                    "pan_card_no.required"=>'Please fill pan card number field',
                    "address_proof.required"=>'Please fill address proof id number field',
                    "upload_pan.required"=>'Please upload pan card',
                    "upload_id.required"=>'Please upload id proof',
                    "upload_other.required"=>'Please upload other documents',
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                if($request->hasFile('upload_pan')){
                    $upload_pan = $request->file('upload_pan')->store('hospitalandOther','public');
                    $inputs['upload_pan'] = $upload_pan;
                }
                if($request->hasFile('upload_id')){
                    $upload_id = $request->file('upload_id')->store('hospitalandOther','public');
                    $inputs['upload_id'] = $upload_id;
                }
                if($request->hasFile('upload_other')){
                    $upload_other = $request->file('upload_other')->store('hospitalandOther','public');
                    $inputs['upload_other'] = $upload_other;
                }
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"4"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "4"){

                $this->validate($request,[
                    "numberOfAmbulance"=>'required',
                    "pickupDropFaclity"=>'required',
                    "inHousePathLab"=>'required',
                    "radiolgyDiagnostics"=>'required',
                    "care"=>'required',
                    "remoteCare"=>'required',
                    "numberPatientDayInOpd"=>'required',
                    "numberOfBedsInTotal"=>'required',
                    "numberOfGeneralWards"=>'required',
                    "numberOfIcu"=>'required',
                    "numberOfPrivateRooms"=>'required',
                    "numberOfSemiPriavateRooms"=>'required',
                    "numberOfBedsINEmergencyNumberOfDepartments"=>'required',
                    "numberOfClinics"=>'required',
                    "bloodBankAvailableOrNot"=>'required',
                    "numberOfDoctorsOnRoll"=>'required',
                    "categoryOfFacility"=>'required',
                    "contact_details_name"=>'required',
                    "contact_details_email"=>'required',
                    "contact_details_contact"=>'required',
                ],[
                    "numberOfAmbulance.required"=>'Please fill number of ambulance field',
                    "pickupDropFaclity.required"=>'Please select pickup drop faclity field',
                    "inHousePathLab.required"=>'Please select In-house path lab field',
                    "radiolgyDiagnostics.required"=>'Please select radiolgy diagnostics field',
                    "care.required"=>'Please select care type field',
                    "remoteCare.required"=>'Please select remote care field',
                    "numberPatientDayInOpd.required"=>'Please fill number patient/day in OPD field',
                    "numberOfBedsInTotal.required"=>'Please fill number of beds in total field',
                    "numberOfGeneralWards.required"=>'Please fill number of general wards field',
                    "numberOfIcu.required"=>'Please fill number of ICU field',
                    "numberOfPrivateRooms.required"=>'Please fill number of private rooms field',
                    "numberOfSemiPriavateRooms.required"=>'Please fill number of semi priavate rooms field',
                    "numberOfBedsINEmergencyNumberOfDepartments.required"=>'Please fill number of beds in emergency number of departments field',
                    "numberOfClinics.required"=>'Please fill number of clinics field',
                    "bloodBankAvailableOrNot.required"=>'Please fill blood bank available or not field',
                    "numberOfDoctorsOnRoll.required"=>'Please fill number of doctors on-roll field',
                    "categoryOfFacility.required"=>'Please select category of facility field',
                    "contact_details_name.required"=>'Please fill name field',
                    "contact_details_email.required"=>'Please fill email field',
                    "contact_details_contact.required"=>'Please fill contact field',
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"5"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "5"){
                $this->validate($request,[
                    "bank_name"=>'required',
                    "holder_name"=>'required',
                    "account_type"=>'required',
                    "acount_number"=>'required|confirmed',
                    "acount_number_confirmation"=>'required|same:acount_number',
                    "bacnk_ifsc_code"=>'required',
                    "bank_branch"=>'required',
                    "bank_city"=>'required'
                ],[
                    "bank_name.required"=>'Please fill bank name field',
                    "holder_name.required"=>'Please fill account holder name field',
                    "account_type.required"=>'Please fill account type field',
                    "acount_number.required"=>'Please fill account number field',
                    "acount_number.confirmed"=>'Account Number and Confirm Account Number does not match',
                    "acount_number_confirmation.required"=>'Please fill confirm account number field',
                    "bacnk_ifsc_code.required"=>'Please fill IFSC code field',
                    "bank_branch.required"=>'Please fill bank branch field',
                    "bank_city.required"=>'Please fill bank city field',
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"6"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "6"){
                $this->validate($request,[
                    "brand_color_primary"=>'required',
                    "brand_color_secondary"=>'required',
                    "hospital_logo"=>'required',
                    "banner_picture"=>'required',
                ],[
                    "brand_color_primary.required"=>'Please select brand colour theme first field',
                    "brand_color_secondary.required"=>'Please select brand colour theme secondary field',
                    "hospital_logo.required"=>'Please upload media info',
                    "banner_picture.required"=>'Please upload banner picture',
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                unset($inputs['parameter']);
                if($request->hasFile('hospital_logo')){
                    $hospital_logo = $request->file('hospital_logo')->store('hospitalandOther','public');
                    $inputs['hospital_logo']=$hospital_logo;
                }
                if($request->hasFile('banner_picture')){
                    $banner_picture = $request->file('banner_picture')->store('hospitalandOther','public');
                    $inputs['banner_picture']=$banner_picture;
                }
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    if($request->parameter != 'hospitals'){
                        return response()->json([
                            'message'=>'update successfull',
                            'insertid'=>$request->hidden_id,
                            'form'=>"6"
                        ],200);
                    }else{
                        $getData = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                        $admin = Admin::create([
                            'name'=>$getData->hospitalFullName,
                            'email'=>$getData->login_email,
                            'password'=>Hash::make('12345678'),
                            'roleType'=>$request->parameter,
                            'trash'=>'0',
                        ]);
                        HospitalOther::where('_id',decrypt($request->hidden_id))->update([
                            'admin_id'=> $admin->_id,
                            'status'=>"1"
                        ]);
                        return response()->json([
                            'message'=>'update successfull',
                            'insertid'=>$request->hidden_id,
                            'form'=>"6"
                        ],200);
                    }
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "7"){
                $this->validate($request,[
                    "shortBrief"=>"required",
                    "logo"=>"required",
                    "bannerImage"=>"required",
                ],[
                    "shortBrief.required"=>"Please upload fill short brief field",
                    "logo.required"=>"Please upload logo",
                    "bannerImage.required"=>"Please upload banner image",
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                // dd(array_keys($inputs));
                if($request->hasFile('logo')){
                    $logo = $request->file('logo')->store('hospitalandOther','public');
                    $inputs['logo']=$logo;
                }
                if($request->hasFile('bannerImage')){
                    $bannerImage = $request->file('bannerImage')->store('hospitalandOther','public');
                    $inputs['bannerImage']=$bannerImage;
                }
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);

                if($insert){
                    $gethosData = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                        $admin = Admin::create([
                            'name'=>$gethosData->hospitalFullName,
                            'email'=>$gethosData->login_email,
                            'password'=>Hash::make('12345678'),
                            'roleType'=>$request->parameter,
                            'trash'=>'0',
                        ]);
                        HospitalOther::where('_id',decrypt($request->hidden_id))->update([
                            'admin_id'=> $admin->_id,
                            'status'=>"1"
                        ]);
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"6"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function hospitalEdit($id){
        $editData = HospitalOther::where('admin_id',decrypt($id))->first();
        $nextToken = $editData->roleType;
        return view('admin.hospital.hospital-step-1edit',compact('editData','nextToken'));
    }

    public function hospitalUpdate(Request $request){
        try{
            if($request->form == "1"){
                $get = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                $checkEmail = Admin::where('_id','!=',decrypt($get->admin_id))->where('email',$request->email_id)->first();
                if ($checkEmail) {

                    throw ValidationException::withMessages(['email_id' => 'The email must be unique.']);
                }
                // dd($request->all());
                $this->validate($request,[
                    "hospitalType"=>'required',
                    "hospitalFullName"=>'required',
                    "hospitalDisplayName"=>'required',
                    "establisementDate"=>'required',
                    "shortBrief1"=>'required',
                    "speciality"=>'required',
                    "contact_details_designation1"=>'required',
                    "department1"=>'required',
                    "contact_details_name1"=>'required',
                    "contact_details_email1"=>'required',
                    "contact_details_contact1"=>'required',
                    "helplineNumber"=>'required',
                    "emergencyContact"=>'required',
                    "login_email"=>"required"
                ],[
                    "hospitalType.required"=>"Please select hospital type field",
                    "hospitalFullName.required"=>"Please fill hospital name field",
                    "hospitalDisplayName.required"=>"Please fill display name field",
                    "establisementDate.required"=>"Please select establishment date field",
                    "shortBrief1.required"=>"Please fill short brief field",
                    "speciality.required"=>"Please select speciality field",
                    "contact_details_designation1.required"=>"Please select designation field",
                    "department.required1"=>"Please fill department field",
                    "contact_details_name1.required"=>"Please fill name field",
                    "contact_details_email1.required"=>"Please fill email field",
                    "contact_details_contact1.required"=>"Please fill contact field",
                    "helplineNumber.required"=>"Please fill helpline number field",
                    "emergencyContact.required"=>"Please fill emergency contact field",
                    "login_email.required"=>"Please fill email field",
                    "login_email.unique"=>"Email Id already taken"
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);


                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);

                if($insert){
                    return response()->json([
                        'message'=>'insert successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"2"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "2"){
                $this->validate($request,[
                    "AddressCountry"=>'required',
                    "AddressState"=>'required',
                    "AddressCity"=>'required',
                    "addressPinCode"=>'required',
                    "AddressLandmark"=>'required',
                    "AddressLatitude"=>'required',
                    "AddressLongitude"=>'required',
                    "full_address"=>'required',
                ],[
                    "AddressCountry.required"=>'Please select country field',
                    "AddressState.required"=>'Please select state field',
                    "AddressCity.required"=>'Please select city field',
                    "addressPinCode.required"=>'Please fill pincode field',
                    "AddressLandmark.required"=>'Please fill landmark field',
                    "AddressLatitude.required"=>'Please fill latitude field',
                    "AddressLongitude.required"=>'Please fill longtitude field',
                    "full_address.required"=>'Please fill address field',
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"3"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "3"){
                $this->validate($request,[
                    "pan_card_no"=>'required',
                    "address_proof"=>'required'
                ],[
                    "pan_card_no.required"=>'Please fill pan card number field',
                    "address_proof.required"=>'Please fill address proof id number field'
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                if($request->hasFile('upload_pan')){
                    $filecheck = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                    if(isset($filecheck->upload_pan)&&file_exists(public_path($filecheck->upload_pan))){
                        unlink(public_path($filecheck->upload_pan));
                    }
                    $upload_pan = $request->file('upload_pan')->store('hospitalandOther','public');
                    $inputs['upload_pan'] = $upload_pan;
                }
                if($request->hasFile('upload_id')){
                    $filecheck = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                    if(isset($filecheck->upload_id)&&file_exists(public_path($filecheck->upload_id))){
                        unlink(public_path($filecheck->upload_id));
                    }
                    $upload_id = $request->file('upload_id')->store('hospitalandOther','public');
                    $inputs['upload_id'] = $upload_id;
                }
                if($request->hasFile('upload_other')){
                    $filecheck = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                    if(isset($filecheck->upload_other)&&file_exists(public_path($filecheck->upload_other))){
                        unlink(public_path($filecheck->upload_other));
                    }
                    $upload_other = $request->file('upload_other')->store('hospitalandOther','public');
                    $inputs['upload_other'] = $upload_other;
                }
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"4"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "4"){

                $this->validate($request,[
                    "numberOfAmbulance"=>'required',
                    "pickupDropFaclity"=>'required',
                    "inHousePathLab"=>'required',
                    "radiolgyDiagnostics"=>'required',
                    "homeCare"=>'required',
                    "remoteCare"=>'required',
                    "numberPatientDayInOpd"=>'required',
                    "numberOfBedsInTotal"=>'required',
                    "numberOfGeneralWards"=>'required',
                    "numberOfIcu"=>'required',
                    "numberOfPrivateRooms"=>'required',
                    "numberOfSemiPriavateRooms"=>'required',
                    "numberOfBedsINEmergencyNumberOfDepartments"=>'required',
                    "numberOfClinics"=>'required',
                    "bloodBankAvailableOrNot"=>'required',
                    "numberOfDoctorsOnRoll"=>'required',
                    "categoryOfFacility"=>'required',
                    "contact_details_name"=>'required',
                    "contact_details_email"=>'required',
                    "contact_details_contact"=>'required',
                ],[
                    "numberOfAmbulance.required"=>'Please fill number of ambulance field',
                    "pickupDropFaclity.required"=>'Please select pickup drop faclity field',
                    "inHousePathLab.required"=>'Please select In-house path lab field',
                    "radiolgyDiagnostics.required"=>'Please select radiolgy diagnostics field',
                    "homeCare.required"=>'Please select home care field',
                    "remoteCare.required"=>'Please select remote care field',
                    "numberPatientDayInOpd.required"=>'Please fill number patient/day in OPD field',
                    "numberOfBedsInTotal.required"=>'Please fill number of beds in total field',
                    "numberOfGeneralWards.required"=>'Please fill number of general wards field',
                    "numberOfIcu.required"=>'Please fill number of ICU field',
                    "numberOfPrivateRooms.required"=>'Please fill number of private rooms field',
                    "numberOfSemiPriavateRooms.required"=>'Please fill number of semi priavate rooms field',
                    "numberOfBedsINEmergencyNumberOfDepartments.required"=>'Please fill number of beds in emergency number of departments field',
                    "numberOfClinics.required"=>'Please fill number of clinics field',
                    "bloodBankAvailableOrNot.required"=>'Please fill blood bank available or not field',
                    "numberOfDoctorsOnRoll.required"=>'Please fill number of doctors on-roll field',
                    "categoryOfFacility.required"=>'Please select category of facility field',
                    "contact_details_name.required"=>'Please fill name field',
                    "contact_details_email.required"=>'Please fill email field',
                    "contact_details_contact.required"=>'Please fill contact field',
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"5"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "5"){
                $this->validate($request,[
                    "bank_name"=>'required',
                    "holder_name"=>'required',
                    "account_type"=>'required',
                    "acount_number"=>'required',
                    "bacnk_ifsc_code"=>'required',
                    "bank_branch"=>'required',
                    "bank_city"=>'required'
                ],[
                    "bank_name.required"=>'Please fill bank name field',
                    "holder_name.required"=>'Please fill account holder name field',
                    "account_type.required"=>'Please fill account type field',
                    "acount_number.required"=>'Please fill account number field',
                    "bacnk_ifsc_code.required"=>'Please fill IFSC code field',
                    "bank_branch.required"=>'Please fill bank branch field',
                    "bank_city.required"=>'Please fill bank city field',
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"6"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "6"){
                $this->validate($request,[
                    "brand_color_primary"=>'required',
                    "brand_color_secondary"=>'required',
                ],[
                    "brand_color_primary.required"=>'Please select brand colour theme first field',
                    "brand_color_secondary.required"=>'Please select brand colour theme secondary field',
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                unset($inputs['parameter']);
                if($request->hasFile('hospital_logo')){
                    $filecheck = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                    if(isset($filecheck->hospital_logo)&&file_exists(public_path($filecheck->hospital_logo))){
                        unlink(public_path($filecheck->hospital_logo));
                    }
                    $hospital_logo = $request->file('hospital_logo')->store('hospitalandOther','public');
                    $inputs['hospital_logo']=$hospital_logo;
                }
                if($request->hasFile('banner_picture')){
                    $filecheck = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                    if(isset($filecheck->banner_picture)&&file_exists(public_path($filecheck->banner_picture))){
                        unlink(public_path($filecheck->banner_picture));
                    }
                    $banner_picture = $request->file('banner_picture')->store('hospitalandOther','public');
                    $inputs['banner_picture']=$banner_picture;
                }
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);
                if($insert){
                    if($request->parameter != 'hospitals'){
                        return response()->json([
                            'message'=>'update successfull',
                            'insertid'=>$request->hidden_id,
                            'form'=>"6"
                        ],200);
                    }else{
                        $gethosData = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                        $adminData = Admin::where('_id',$gethosData->admin_id)->first();
                        if(empty($adminData)){
                            $admin = Admin::create([
                                'name'=>$gethosData->hospitalFullName,
                                'email'=>$gethosData->login_email,
                                'password'=>Hash::make('12345678'),
                                'roleType'=>$request->parameter,
                                'trash'=>"0"
                            ]);
                            $adminid = $admin->_id;
                        }else{
                            $admin = Admin::where('_id',$gethosData->admin_id)->update([
                                'name'=>$gethosData->hospitalFullName,
                                'email'=>$gethosData->login_email
                            ]);
                            $adminid = $gethosData->admin_id;
                        }

                        HospitalOther::where('_id',decrypt($request->hidden_id))->update([
                            'admin_id'=> $adminid,
                            'status'=>"1"
                        ]);
                        return response()->json([
                            'message'=>'update successfull',
                            'insertid'=>$request->hidden_id,
                            'form'=>"6"
                        ],200);
                        // $getData = HospitalOther::where('_id',decrypt($request->hidden_id))->first();

                        // $admin = Admin::where('_id',$getData->admin_id)->update([
                        //     'name'=>$getData->hospitalFullName,
                        //     'email'=>$getData->login_email,
                        // ]);
                        // $adminData = Admin::where('_id',$getData->admin_id)->first();
                        // HospitalOther::where('_id',decrypt($request->hidden_id))->update([
                        //     'admin_id'=> $adminData->_id,
                        //     'status'=>"1"
                        // ]);
                        // return response()->json([
                        //     'message'=>'update successfull',
                        //     'insertid'=>$request->hidden_id,
                        //     'form'=>"6"
                        // ],200);
                    }
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
            if($request->form == "7"){
                $this->validate($request,[
                    "shortBrief"=>"required",
                    "logo"=>"required",
                    "bannerImage"=>"required",
                ],[
                    "shortBrief.required"=>"Please upload fill short brief field",
                    "logo.required"=>"Please upload logo",
                    "bannerImage.required"=>"Please upload banner image",
                ]);
                $inputs = $request->all();
                unset($inputs['_token']);
                unset($inputs['form']);
                unset($inputs['hidden_id']);
                if($request->hasFile('logo')){
                    $filecheck = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                    if(isset($filecheck->logo)&&file_exists(public_path($filecheck->logo))){
                        unlink(public_path($filecheck->logo));
                    }
                    $logo = $request->file('logo')->store('hospitalandOther','public');
                    $inputs['logo']=$logo;
                }
                if($request->hasFile('bannerImage')){
                    $filecheck = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                    if(isset($filecheck->bannerImage)&&file_exists(public_path($filecheck->bannerImage))){
                        unlink(public_path($filecheck->bannerImage));
                    }
                    $bannerImage = $request->file('bannerImage')->store('hospitalandOther','public');
                    $inputs['bannerImage']=$bannerImage;
                }
                $insert = HospitalOther::where('_id',decrypt($request->hidden_id))->update($inputs);

                if($insert){
                    $gethosData = HospitalOther::where('_id',decrypt($request->hidden_id))->first();
                    $adminData = Admin::where('_id',$gethosData->admin_id)->first();
                    if(empty($adminData)){
                        $admin = Admin::create([
                            'name'=>$gethosData->hospitalFullName,
                            'email'=>$gethosData->login_email,
                            'password'=>Hash::make('12345678'),
                            'roleType'=>$request->parameter,
                            'trash'=>"0"
                        ]);
                        $adminid = $admin->_id;
                    }else{
                        $admin = Admin::where('_id',$gethosData->admin_id)->update([
                            'name'=>$gethosData->hospitalFullName,
                            'email'=>$gethosData->login_email
                        ]);
                        $adminid = $gethosData->admin_id;
                    }

                    HospitalOther::where('_id',decrypt($request->hidden_id))->update([
                        'admin_id'=> $adminid,
                        'status'=>"1"
                    ]);
                    return response()->json([
                        'message'=>'update successfull',
                        'insertid'=>$request->hidden_id,
                        'form'=>"6"
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Internal Server error'
                    ],500);
                }
            }
        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function hospitalDelete($id){
        $delete = HospitalOther::where('admin_id',decrypt($id))->update([
            'trash'=>"1"
        ]);
        if($delete){
            return response()->json([
                'message'=>'Delete Successfull'
            ],200);
        }else{
            return response()->json([
                'message'=>'Internal Server Error'
            ],500);
        }
    }
}
