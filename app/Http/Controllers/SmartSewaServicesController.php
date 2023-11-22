<?php

namespace App\Http\Controllers;

use App\Models\EndCustomerServiceModel;
use App\Models\BusinessClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SmartSewaServicesController extends Controller
{
    public function endcustomer_service(Request $request)
    {
        try {

            if ($request->isMethod('post')) {

                $validator = Validator::make($request->all(), [
                    'service_name' => 'required',
                    'service_category' => 'required',
                    'del_mode' => 'required',
                    'service_price' => 'required',
                    'disease' => 'required',
                    'attach_organ' => 'required',
                    'time_consume' => 'required',
                    'service_pincode' => 'required',
                    'ser_details' => 'required',
                    'customer_gender' => 'required',
                    'ageGroup' => 'required', // Assuming "countries" is your table name
                    'startDateTime' => 'required', // Assuming "states" is your table name
                    'endDateTime' => 'required', // Assuming "cities" is your table name
                ], [
                    'service_name.required' => 'Enter Service Name',
                    'service_category.required' => 'Select Service Category',
                    'del_mode.required' => 'Select Delivery Mode',
                    'service_price.required' => 'Enter Service Price',
                    'disease.required' => 'Select disease',
                    'attach_organ.required' => 'Select Organ',
                    'time_consume.required' => 'Enter Consume time',
                    'service_pincode.required' => 'Enter Service Pincode',
                    'ser_details.required' => 'Enter Service Details',
                    'customer_gender.required' => 'Select gender',
                    'ageGroup.required' => 'Enter age group',
                    'startDateTime.required' => 'Select start date',
                    'endDateTime.required' => 'Select end date',

                ]);

                if ($validator->fails()) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => $validator->errors()->first()]);
                    } else {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                }

                $end_cust_service = new EndCustomerServiceModel();
                $end_cust_service->added_by = 'SSVENDOR1122';
                $end_cust_service->service_name = $request->service_name;
                $end_cust_service->service_category = $request->service_category;
                $end_cust_service->del_mode = $request->del_mode;
                $end_cust_service->service_price = $request->service_price;
                $end_cust_service->disease = $request->disease;
                $end_cust_service->attach_organ = $request->attach_organ;
                $end_cust_service->time_consume = $request->time_consume;
                $end_cust_service->service_pincode = $request->service_pincode;
                $end_cust_service->ser_details = $request->ser_details;
                $end_cust_service->customer_gender = $request->customer_gender;
                $end_cust_service->ageGroup = $request->ageGroup;
                $end_cust_service->startDateTime = $request->startDateTime;
                $end_cust_service->endDateTime = $request->endDateTime;
                $end_cust_service->trash = "0";
                $end_cust_service->flag = "1";

                if ($end_cust_service->save()) {
                    return response()->json(['success' => true, 'errors' => null, 'message' => 'Service Added Successfully']);
                } else {
                    return response()->json(['success' => false, 'errors' => null, 'message' => 'Failed']);
                }
            } else {

                return view('admin.customer.endCustumers');
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e->getMessage(), 'message' => 'Unexpected Failed']);
        }
    }

    public function get_data_edit(Request $request, $end_cust_id)
    {
        $data['end_cust_serv'] = EndCustomerServiceModel::where('_id', $end_cust_id)->first();
        return view('admin.customer.edit_endCustumers', $data);
    }

    public function update_endcustomer_service(Request $request)
    {
        $update = EndCustomerServiceModel::where('_id', $request->id)->update([
            'added_by' => 'SSVENDOR1122',
            'service_name' => $request->service_name,
            'service_category' => $request->service_category,
            'del_mode' => $request->del_mode,
            'service_price' => $request->service_price,
            'disease' => $request->disease,
            'attach_organ' => $request->attach_organ,
            'time_consume' => $request->time_consume,
            'service_pincode' => $request->service_pincode,
            'ser_details' => $request->ser_details,
            'customer_gender' => $request->customer_gender,
            'ageGroup' => $request->ageGroup,
            'startDateTime' => $request->startDateTime,
            'endDateTime' => $request->endDateTime,
            "updated_at"=>date('Y-m-d H:i:s')
        ]);

        if ($update) {
            return response()->json(['success' => true, 'errors' => null, 'message' => 'Service Updated Successfully']);
        } else {
            return response()->json(['success' => false, 'errors' => null, 'message' => 'Failed']);
        }

    }

    public function status_endcustomer_service($id){
        $flagcheck = EndCustomerServiceModel::where('_id',decrypt($id))->first();
        // dd($flagcheck);
        if($flagcheck->flag == '1'){
            $flagstatus ='0';
        }else{
            $flagstatus ='1';
        }
        EndCustomerServiceModel::where('_id',decrypt($id))->update([
            'flag'=>$flagstatus
        ]);
        return redirect('/list-end-custumers');
    }
    public function business_client_services(Request $request)
    {
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
            unset($inputs["_token"]);
            $inputs['trash']="0";
            // dd($inputs);
            $insert = BusinessClient::create($inputs);
            if($insert){
                return response()->json([
                    'message'=>'insert successfull'
                ],200);
            }else{
                return response()->json([
                    'message'=>'Internal server error'
                ],500);
            }

        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            throw $e;
        }
        // businessClient
        dd($request->all());
    }
    public function delete_endcustomer_service($id){
        // EndCustomerServiceModel

    }
}
