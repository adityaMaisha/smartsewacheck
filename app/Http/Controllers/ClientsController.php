<?php

namespace App\Http\Controllers;

use App\Models\Client_Wallet;
use App\Models\EndCustomerServiceModel;
use Illuminate\Http\Request;
use App\Models\VendorPathLab;
use App\Models\Admin;
use App\Models\LabTest;
use App\Models\Package;
use App\Models\BusinessClient;
use App\Models\Organ;
use Illuminate\Validation\ValidationException;

class ClientsController extends Controller
{
    public function labsList()
    {
        $vendors = VendorPathLab::where('trash','0')->get();
        return view('admin.lab.list', compact('vendors'));
    }
    public function deletelabsList($id){
        $dataget = VendorPathLab::where('_id',decrypt($id))->first();
        $admin = Admin::where('vendor_id',$dataget->vendor_id)->first();
        $admin->update([
            'trash'=>'1'
        ]);
        $dataget->update([
            'trash'=>'1'
        ]);
        return redirect('/labs-list');
    }
    public function labsDiagnosticsList()
    {

        return view('admin.lab.labsDiagnosticsList',compact('packageData'));
    }

    public function packagesList()
    {
        $packageDatas = Package::where('trash','0')->get();
        // dd($packageData);
        return view('admin.diagnostics.diagnostics-packages',compact('packageDatas'));
    }

    public function createDiagnosticsPackages()
    {
        $labtests = LabTest::where('trash','0')->get();
        $organs = Organ::where('trash','0')->get();
        return view('admin.diagnostics.create-diagnostics-packages',compact('labtests','organs'));
    }

    public function saveDiagnosticsPackages(Request $request){
        try{
            $this->validate($request,[
                'lab_package'=>'required|regex:/^LP-\d{2}$/|unique:package,lab_package',
                'providerid'=>'required|regex:/^AHDPL-\d{4}$/',
                'package_name'=>'required|regex:/^[\p{L}\s'.preg_quote("-'").']+$/u',
                'category'=>'required',
                'labtestid'=>'required',
                'basePrice'=>'required|integer',
                'discount'=>'required',
                'sample_type'=>'required',
                'method'=>'required',
                'result_time'=>'required',
                'age_group'=>'required',
                'gender'=>'required',
                'organs'=>'required',
                'tags'=>'required',
                'attached_vitals'=>'required',
                'forOrgeanUnlock'=>'required',
                'numberOfAttachedVitals'=>'required',
                'description'=>'required',
            ],[
                'lab_package.required'=>'Please fill test idf field',
                'lab_package.regex'=>'Invalid data in test idf field',
                'providerid.required'=>'Please fill provider id field',
                'providerid.regex'=>'Invalid data in provider id field',
                'package_name.required'=>'Please fill name field',
                'package_name.regex'=>'Invalid data in name field',
                'labtestid.required'=>'Please select lab tests',
                'category.required'=>'Please fill category field',
                'basePrice.required'=>'Please fill base price field',
                'discount.required'=>'Please fill discounts field',
                'basePrice.integer'=>'Please fill numeric value in base price field',
                'sample_type.required'=>'Please fill sample type field',
                'method.required'=>'Please fill method field',
                'description.required'=>'Please fill description field',
                'result_time.required'=>'Please fill result time field',
                'age_group.required'=>'Please fill age group field',
                'gender.required'=>'Please fill gender field',
                'organs.required'=>'Please fill organs field',
                'tags.required'=>'Please fill tags field',
                'attached_vitals.required'=>'Please fill attached vital field',
                'forOrgeanUnlock.required'=>'Please fill for organ unlocked field',
                'numberOfAttachedVitals.required'=>'Please fill number if vital attached'
            ]);
            $inputs = $request->all();
            unset($inputs['_token']);
            $inputs['trash']='0';
            $insertquery = Package::create($inputs);
            if($insertquery){
                return response()->json([
                    'message'=>'data inserted'
                ],200);
            }else{
                return response()->json([
                    'message'=>'data not inserted'
                ],500);
            }
        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function deleteDiagnosticsPackages($id){
        $packagedelete = Package::where('_id',decrypt($id))->update([
            'trash'=>'1'
        ]);
        if($packagedelete){
            return response()->json([
                'message'=>'data deleted'
            ],200);
        }else{
            return response()->json([
                'message'=>'internal server error'
            ],500);
        }
        // dd($id);
    }

    public function editDiagnosticsPackages($id){
        $labtests = LabTest::where('trash','0')->get();
        $editData = Package::where('_id',decrypt($id))->first();
        $organs = Organ::where('trash','0')->get();
        return view('admin.diagnostics.edit-diagnostics-packages',compact('labtests','editData','organs'));
    }

    public function updateDiagnosticsPackages(Request $request,$id){
        try{
            $this->validate($request,[
                'lab_package'=>'required|regex:/^LP-\d{2}$/',
                'providerid'=>'required|regex:/^AHDPL-\d{4}$/',
                'package_name'=>'required|regex:/^[\p{L}\s'.preg_quote("-'").']+$/u',
                'category'=>'required',
                'labtestid'=>'required',
                'basePrice'=>'required|integer',
                'discount'=>'required',
                'sample_type'=>'required',
                'method'=>'required',
                'result_time'=>'required',
                'age_group'=>'required',
                'gender'=>'required',
                'organs'=>'required',
                'tags'=>'required',
                'attached_vitals'=>'required',
                'forOrgeanUnlock'=>'required',
                'numberOfAttachedVitals'=>'required',
                'description'=>'required',
            ],[
                'lab_package.required'=>'Please fill test idf field',
                'lab_package.regex'=>'Invalid data in test idf field',
                'providerid.required'=>'Please fill provider id field',
                'providerid.regex'=>'Invalid data in provider id field',
                'package_name.required'=>'Please fill name field',
                'package_name.regex'=>'Invalid data in name field',
                'labtestid.required'=>'Please select lab tests',
                'category.required'=>'Please fill category field',
                'basePrice.required'=>'Please fill base price field',
                'discount.required'=>'Please fill discounts field',
                'basePrice.integer'=>'Please fill numeric value in base price field',
                'sample_type.required'=>'Please fill sample type field',
                'method.required'=>'Please fill method field',
                'description.required'=>'Please fill description field',
                'result_time.required'=>'Please fill result time field',
                'age_group.required'=>'Please fill age group field',
                'gender.required'=>'Please fill gender field',
                'organs.required'=>'Please fill organs field',
                'tags.required'=>'Please fill tags field',
                'attached_vitals.required'=>'Please fill attached vital field',
                'forOrgeanUnlock.required'=>'Please fill for organ unlocked field',
                'numberOfAttachedVitals.required'=>'Please fill number if vital attached'
            ]);
            $inputs = $request->all();
            unset($inputs['_token']);
            $update = Package::where('_id',decrypt($id))->update($inputs);
            if($update){
                return response()->json([
                    'message'=>'data updated'
                ],200);
            }else{
                return response()->json([
                    'message'=>'data not updated'
                ],500);
            }
        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            throw $e;
        }
        // dd($request->all());
    }
    public function endCustumers()
    {
        return view('admin.customer.endCustumers');
    }

    public function businessClients()
    {
        return view('admin.customer.businessClients');
    }

    public function labsDiagnosisCsv()
    {

    }

    public function listendCustumers()
    {
        $data['end_cust_serv'] = EndCustomerServiceModel::where('trash','0')->where('added_by', 'SSVENDOR1122')->get();
        return view('admin.customer.endCustumerslist',$data);
    }

    public function deletelistendCustumers($id){
        EndCustomerServiceModel::where('_id',decrypt($id))->update([
            'trash'=>'1'
        ]);
        return redirect('/list-end-custumers');
    }
    public function businessClientslist()
    {
        // dd('hello');
        $data['wallet_sum'] = Client_Wallet::where('vendor_id', 'SSVENDOR1122')->sum('wallet_amt');
        $businessClients = BusinessClient::where('trash','0')->get();
        return view('admin.customer.businessClientslist',$data,compact('businessClients'));
    }

    public function deletebusinessClientslist($id){
        // $data = BusinessClient::where('_id',decrypt($id))->first();
        // dd(decrypt($id));
        BusinessClient::where('_id',decrypt($id))->update([
            'trash'=>"1"
        ]);
        return redirect('/list-business-clients');
    }

    public function editbusinessClientslist($id){
        $editData = BusinessClient::where('_id',decrypt($id))->first();
        return view('admin.customer.editbusinessClients',compact('editData'));
    }

    public function updatebusinessClientslist(Request $request,$id){
        try{
            $this->validate($request,[
                "service_name" => "required",
                "bus_client_state" => "required",
                "bus_client_city" => "required",
                "service_category" => "required",
                "del_mode" => "required",
                "ser_pin_code" => "required",
                "time_consume_customer" => "required",
                "cust_eng_day" => "required",
                "per_cust_cost" => "required",
                "description" => "required",
                "bus_client_customer_vendor" => "required",
                "bus_client_customer_vendorname" => "required",
                "is_end_cust" => "required",
                "startDateTime" => "required",
                "endDateTime" => "required",
            ],[
                "service_name.required" => "Please fill service name field",
                "bus_client_state.required" => "Please select state field",
                "bus_client_city.required" => "Please select city field",
                "service_category.required" => "Please select category field",
                "del_mode.required" => "Please select mode of delivery field",
                "ser_pin_code.required" => "Please fill servicable pin codes field",
                "time_consume_customer.required" => "Please select time cosume per customer field",
                "cust_eng_day.required" => "Please fill number of customer can be engaged/day field",
                "per_cust_cost.required" => "Please fill per customer cost",
                "description.required" => "Please fill details field",
                "bus_client_customer_vendor.required" => "Please select vendor type field",
                "bus_client_customer_vendorname.required" => "Please select vendor name  field",
                "is_end_cust.required" => "Please select use for the end customer field",
                "startDateTime.required" => "Please select start date & time field",
                "endDateTime.required" => "Please select start date & time field",
            ]);
            $inputs = $request->all();
            unset($inputs['token']);
            $update = BusinessClient::where('_id',decrypt($id))->update($inputs);
            if($update){
                return response()->json([
                    'message'=>'updated successfully'
                ],200);
            }else{
                return response()->json([
                    'message'=>'Internal Server Error'
                ],500);
            }

        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            throw $e;
        }
        dd($request->all());
    }
}
