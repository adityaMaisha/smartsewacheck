<?php

namespace App\Http\Controllers;

use App\Models\countries;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function end_customer_order()
    {
        return view('admin.order.end_customer_order');
    }

    public function business_clients_order()
    {
        return view('admin.order.business_clients_order');
    }

    public function assign_lab()
    {
        return view('admin.order.assign_lab');
    }

    public function business_clients_order_view()
    {
        return view('admin.order.view_business_client_order');
    }

    public function assign_lab_form()
    {
        return view('admin.order.assign_lab_form');
    }

    public function send_data_to_lab(Request $request)
    {
        try {

            if ($request->isMethod('post')) {

                $validator = Validator::make($request->all(), [
                    'assign_lab' => 'required',
                    'barcode' => 'required',
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'dob' => 'required',
                    'age' => 'required',
                    'mobile' => 'required|digits:10',
                    'email' => 'required|email',
                    'pin_code' => 'required|numeric|digits:6',
                    'institution' => 'required',
                    'physician' => 'required',
                    'physician_name' => 'required|string',
                    'requested_by_email' => 'required|email',
                    'test' => 'required',
                    'panel' => 'required',
                    'specimen_name' => 'required',
                    'quantity' => 'required'
                ], [
                    'assign_lab.required' => 'Please choose a LAB.',
                    'barcode.required' => 'Enter Barcode',
                    'first_name.required' => 'Please enter the first name.',
                    'last_name.required' => 'Please enter the last name.',
                    'dob.date' => 'Enter Date Of Birth',
                    'age.required' => 'Enter age',
                    'mobile.digits' => 'The mobile number must be exactly 10 digits.',
                    'email.required' => 'Please enter an email address.',
                    'pin_code.required' => 'Pin code must be exactly 6 digits',
                    'institution.required' => 'Please enter institution code.',
                    'physician.required' => 'Please enter physician code.',
                    'physician_name.required' => 'Please enter physician name.',
                    'requested_by_email.required' => 'Please enter requested email.',
                    'test.required' => 'Please enter test',
                    'panel.required' => 'Please enter panel',
                    'specimen_name.required' => 'Please enter specimen name',
                    'panel.required' => 'Please enter panel',
                    'quantity.required' => 'Please enter quantity',



                ]);

                if ($validator->fails()) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => $validator->errors()->first()]);
                    } else {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                }


                


                $url = 'https://lims-test.corediagnostics.in/api/collection/createcollection';
                $ch = curl_init($url);
                $lab_data['priority'] = $request->priority ?? '';
                $lab_data['barcode'] = $request->barcode;
                $lab_data['pod_number'] = $request->pod_number ?? '';
                $lab_data['first_name'] = $request->first_name;
                $lab_data['last_name'] = $request->last_name;
                $lab_data['dob'] = $request->dob;
                $lab_data['age'] = $request->age;
                $lab_data['gender'] = $request->gender;
                $lab_data['uid_number'] = $request->uid_number ?? '';
                $lab_data['mrn_number'] = $request->mrn_number ?? '';
                $lab_data['mobile'] = $request->mobile;
                $lab_data['email'] = $request->email;
                $lab_data['pin_code'] = $request->pin_code ?? '';
                $lab_data['address'] = $request->address ?? '';
                $lab_data['client'] = $request->client ?? '';
                $lab_data['institution'] = $request->institution;
                $lab_data['physician'] = $request->physician;
                $lab_data['physician_name'] = $request->physician_name;
                $lab_data['physician_city'] = $request->physician_city ?? '';
                $lab_data['physician_address'] = $request->physician_address ?? '';
                $lab_data['physician_number'] = $request->physician_number ?? '';
                $lab_data['temperature'] = $request->temperature ?? '';
                $lab_data['clinicalhistoryattached'] = $request->clinicalhistoryattached ?? '';
                $lab_data['historyofsmoking'] = $request->historyofsmoking ?? '';
                $lab_data['pasthistoryofcancer'] = $request->pasthistoryofcancer ?? '';
                $lab_data['diabetes'] = $request->diabetes ?? '';
                $lab_data['drugintakeifany'] = $request->drugintakeifany ?? '';
                $lab_data['radiologicalendoscopicfindings'] = $request->radiologicalendoscopicfindings ?? '';
                $lab_data['otherhistory'] = $request->otherhistory ?? '';
                $lab_data['other_hist_desc'] = $request->other_hist_desc ?? '';
                $lab_data['requested_by_email'] = $request->requested_by_email;

                // $cnt = count($request->specimen_barcode);
                // echo $cnt;exit;
                $sp_barcode = $request->specimen_barcode;
                $sp_name = $request->specimen_name;
                $sp_cont_title = $request->container_title;
                $sp_preservation_title = $request->preservation_title;
                $sp_minimum_vol_weight = $request->minimum_vol_weight;
                $sp_unit_name = $request->unit_name;
                $sp_quantity = $request->quantity;
                
                $specimen = []; // Initialize an empty array to hold specimens

                for ($y = 0; $y < count($sp_barcode); ++$y) {
                    $lab_data['specimen'][$y]['specimen_barcode'] = $sp_barcode[$y];
                    $lab_data['specimen'][$y]['specimen_name'] = $sp_name[$y];
                    $lab_data['specimen'][$y]['container_title'] = $sp_cont_title[$y];
                    $lab_data['specimen'][$y]['preservation_title'] = $sp_preservation_title[$y];
                    $lab_data['specimen'][$y]['minimum_vol_weight'] = $sp_minimum_vol_weight[$y];
                    $lab_data['specimen'][$y]['unit_name'] = $sp_unit_name[$y];
                    $lab_data['specimen'][$y]['quantity'] = $sp_quantity[$y];
                    
                    
                    // $specimen[] = [
                    //     'specimen_barcode' => $sp_barcode[$y],
                    //     'specimen_name' => $sp_name[$y],
                    //     'container_title' => $sp_cont_title[$y],
                    //     'preservation_title' => $sp_preservation_title[$y],
                    //     'minimum_vol_weight' => $sp_minimum_vol_weight[$y],
                    //     'unit_name' => $sp_unit_name[$y],
                    //     'quantity' => $sp_quantity[$y],
                    // ];
                }
                // $test = [
                //     'test' => $request->test,
                // ];

                $lab_data['test'][] = $request->test;
                $lab_data['panel'][] = $request->panel;

                // $panel = [
                //     'panel' => $request->panel,
                // ];

                // $lab_data['test'] = $test;
                // $lab_data['panel'] = $panel;
                $lab_data['api_key'] = 'GJ9jOG1w7T6QnbF9SDIqM43C5dTvnVs1jBoF6J2Z2gEh4peyDgz2sCcnLKXI7mCC';
                


                //test for postman

                // $url = 'https://lims-test.corediagnostics.in/api/collection/create-collection';
                // $data = array(
                //     'priority' => $request->priority,
                //     'barcode' => $request->barcode,
                //     'pod_number' => $request->pod_number,
                //     'first_name' => $request->first_name,
                //     'last_name' => $request->last_name,
                //     'dob' => $request->dob,
                //     'age' => $request->age,
                //     'gender' => $request->gender,
                //     'uid_number' => $request->uid_number,
                //     'mrn_number' => $request->mrn_number,
                //     'pin_code' => $request->pin_code,
                //     'address' => $request->address,
                //     'client' => $request->client,
                //     'institution' => $request->institution,
                //     'temperature' => $request->temperature,
                //     'clinicalhistoryattached' => $request->clinicalhistoryattached,
                //     'historyofsmoking' => $request->historyofsmoking,
                //     'pasthistoryofcancer' => $request->pasthistoryofcancer,
                //     'diabetes' => $request->diabetes,
                //     'drugintakeifany' => $request->drugintakeifany,
                //     'radiologicalendoscopicfindings' => $request->radiologicalendoscopicfindings,
                //     'otherhistory' => $request->otherhistory,
                //     'other_hist_desc' => $request->other_hist_desc,
                //     'api_key' => 'GJ9jOG1w7T6QnbF9SDIqM43C5dTvnVs1jBoF6J2Z2gEh4peyDgz2sCcnLKXI7mCC'
                // );

                // $data['specimen'] = $specimen;
                // $data['test'] = $test;
                // $data['panel'] = $panel;

                // //echo json_encode($data);exit;

                // // File to upload
                // $filePath = '/path/to/file';

                // Initialize cURL session
                

                // Set cURL options
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $lab_data);
                // Execute cURL request
                $response = curl_exec($ch);
                print_r($response);exit;
                // Check for errors
                if (curl_errno($ch)) {
                    echo 'cURL Error: ' . curl_error($ch);
                } else {
                    // Print the response
                    echo $response;
                }

                // Close cURL session
                curl_close($ch);
                exit;

                if ($response) {
                    return response()->json(['success' => true, 'errors' => null, 'resp' => 'LAB Assign Successfully']);
                } else {
                    return response()->json(['success' => false, 'errors' => null, 'message' => 'Failed']);
                }
            } else {

                return view('admin.employee.employee_create', [
                    'roles_list' => Roles::where('status', 'active')->get(),
                    'countries' => countries::all()
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e->getMessage(), 'message' => 'Unexpected Failed']);
        }
    }
}
