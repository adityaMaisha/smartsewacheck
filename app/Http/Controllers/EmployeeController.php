<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Employee;
use App\Models\countries;
use App\Models\states;
use App\Models\cities;
use App\Models\Client_Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function employeeList()
    {
        try {

            if (request()->isMethod('post')) {
                $html = '';
                $results = Employee::orderBy('created_at', 'desc')->get();

                if ($results->isEmpty()) {
                    $emptyImage = asset('dashboard_assets/media/illustrations/sketchy-1/1.png');
                    $createNewCustomer = route('new.employee');
                    $html = <<<TABLEEMPTY
<h2 class="text-center fs-2x fw-bold mb-0">No Employees Found</h2>
<p class="text-center text-gray-400 fs-4 fw-semibold py-7">Right now, there are no Employees. If you want to create a Employees, please click on the link. <br><br> <a href="{$createNewCustomer}" class="btn btn-primary border-radius-50"><i class="fa fa-plus" aria-hidden="true"></i> Create New Employees</a> </p>
<div class="text-center pb-15 px-5">
<img src="{$emptyImage}" alt="" class="mw-100 h-200px h-sm-325px">
</div>
TABLEEMPTY;

                    return response()->json(['success' => true, 'data' => $html, 'msg' => 'No records found.']);
                }

                $tableHeader = <<<TABLEHEADER
                <table class="table table-striped table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th class="wd-20p">Sno.</th>
                        <th class="wd-25p">Employee ID</th>
                        <th class="wd-20p">Name</th>
                        <th class="wd-15p">Department</th>
                        <th class="wd-20p">Email</th>
                        <th class="wd-20p">Contact</th>
                        <th class="wd-20p">Acc. Status</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                </thead>
                <tbody>
                {{TABLE_HTML_BODY}}
                </tbody>
                </table>
TABLEHEADER;

                $i = 1;
                foreach($results as $result) {

                    $recordID = lock($result->_id);
                    $html .= '<tr>';
                    $html .= '<td scope="row">'.$i.'</td>';
                    $html .= '<td scope="row">' . (!empty($result->employee_code) ? $result->employee_code : '-') . '</td>';
                    $html .= '<td scope="row">' . (!empty($result->employee_first_name) ? $result->employee_first_name : '') . ' ' . (!empty($result->employee_last_name) ? $result->employee_last_name : '') . '</td>';
                    $html .= '<td scope="row">' . (!empty($result->department_uuid) ? $result->department_uuid : '-') . '</td>';
                    $html .= '<td scope="row">' . (!empty($result->email_id) ? $result->email_id : '-') . '</td>';
                    $html .= '<td scope="row">' . (!empty($result->mobile_number) ? $result->mobile_number : '-') . '</td>';
                    $itemStatus = $result->employee_status == 'active' ? 'checked' : '';
                    $html .= '<td><div class="form-check form-switch" style="text-align: center;"> <input class="form-check-input" type="checkbox" onClick="ItemStatusToggle(\''.$recordID.'\')" role="switch" '.$itemStatus.' ></div></td>';
                    $html .= '<td>';
                    $html .= '<div class="dropdown">
                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple  dropdown-toggle" data-bs-toggle="dropdown" type="button"><i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 18px;"></i></button>
                                <div class="dropdown-menu tx-13">
                                    <!-- <a class="dropdown-item" href="javascript:void(0);">View</a> -->
                                    <a class="dropdown-item" href="'.route('edit.employee', $recordID).'">Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onClick="ItemRemove(\''.$recordID.'\')" >Delete</a>
                                </div>
                             </div>';
                    $html .= '</td>';

                    $html .= '</tr>';
                    $i++;
                }

                $html = str_replace('{{TABLE_HTML_BODY}}', $html, $tableHeader);

                return response()->json(['success' => true, 'data' => $html, 'msg' => 'Fetch records successfully.']);
            } else {
                return view('admin.employee.employee_list');
            }
        } catch (\Exception $e) {
            // Handle the exception as needed
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine()]);
        }
    }

    public function employeeNew(Request $request)
    {
        try {

            if ($request->isMethod('post')) {

                $validator = Validator::make($request->all(), [
                    'department_uuid' => 'required',
                    'date_of_birth' => 'required|date|before_or_equal:today',
                    'employee_first_name' => 'required|string',
                    'employee_last_name' => 'required|string',
                    'designation' => 'required',
                    'date_of_joining' => 'nullable|date|before_or_equal:today',
                    'gender' => 'required|in:male,female,other',
                    'email_id' => 'required|email|unique:employees,email_id', // Assuming "employees" is your table name
                    'mobile_number' => 'nullable|digits:10',
                    'blood_group' => 'nullable|string',
                    'country' => 'required|exists:countries,id', // Assuming "countries" is your table name
                    'state' => 'required|exists:states,id', // Assuming "states" is your table name
                    'city' => 'required|exists:cities,id', // Assuming "cities" is your table name
                    'address' => 'required|string',
                    'password' => 'required',
                    'adhaar_card_number' => 'required',
                    'pin_code' => 'nullable|numeric',
                    'emergency_contact' => 'required|digits:10',
                    'office_email' => 'required|email|unique:employees,office_email',
                    'office_mobile' => 'nullable|digits:10',
                    'pan_card_number' => 'required|string|regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/', // Assuming PAN card regex
                    'address_proof_id_no' => 'nullable|string',
                    'employee_profile' => 'image|mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw|max:2048', // Assuming it's an image
                    'upload_pan_card_attachment' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048',
                    'upload_adhaar_card_attachment' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048',
                    'upload_resume_attachment' => 'required|mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048',
                    'upload_other_documents' => 'required|array|min:1|max:10',
                    'upload_other_documents.*' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048',
                    // 'upload_resume_attachment' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048',
                    // 'upload_other_documents' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048',
                    // 'upload_id_proof_attachment' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048', // Assuming it's an image
                    'employee_bank_name' => 'required|string',
                    'bank_account_holder_name' => 'required|string',
                    'bank_account_type' => 'required|in:saving,current',
                    'right_to_access' => 'required|in:active,inactive',
                    'bank_account_number' => 'required|string',
                    'confirm_account_number' => 'required|string|same:bank_account_number',
                    'bank_ifsc_code' => 'required|string',
                    'bank_branch' => 'required|string',
                    'reference_name' => 'nullable|string',
                    'bank_city' => 'required|string',
                ],[
                    'department_uuid.required' => 'Please choose a department.',
                    'date_of_birth.required' => 'The date of birth field is required.',
                    'employee_first_name.required' => 'Please enter the first name.',
                    'employee_last_name.required' => 'Please enter the last name.',
                    'employee_profile.image' => 'The employee profile must be an image (jpeg, bmp, png, jpg, webp, tiff, tif, raw) with a maximum size of 2MB.',
                    'date_of_joining.date' => 'Please enter a valid date for the date of joining.',
                    'gender.required' => 'Please select a gender.',
                    'email_id.required' => 'Please enter an email address.',
                    'email_id.email' => 'Please enter a valid email address.',
                    'email_id.unique' => 'This email address is already in use.',
                    'mobile_number.digits' => 'The mobile number must be exactly 10 digits.',
                    'country.required' => 'Please select a country.',
                    'state.required' => 'Please select a state.',
                    'city.required' => 'Please select a city.',
                    'address.required' => 'Please enter an address.',
                    'emergency_contact.digits' => 'The emergency contact must be exactly 10 digits.',
                    'office_email.required' => 'Please enter an office email address.',
                    'office_email.email' => 'Please enter a valid office email address.',
                    'pan_card_number.required' => 'Please enter a PAN card number.',
                    'pan_card_number.regex' => 'Please enter a valid PAN card number (Example: ABCTY1234D).',
                    'upload_pan_card_attachment.image' => 'The PAN card attachment must be an image or Pdf with a maximum size of 2MB.',
                    'upload_id_proof_attachment.image' => 'The ID proof attachment must be an image or Pdf with a maximum size of 2MB.',
                    'upload_other_documents.image' => 'The other documents attachment must be an image or Pdf with a maximum size of 2MB.',
                    'employee_bank_name.required' => 'Please enter the bank name.',
                    'bank_account_holder_name.required' => 'Please enter the bank account holder name.',
                    'bank_account_type.required' => 'Please select a bank account type.',
                    'bank_account_type.in' => 'Please select a valid bank account type.',
                    'bank_account_number.required' => 'Please enter the bank account number.',
                    'confirm_account_number.required' => 'Please confirm the bank account number.',
                    'confirm_account_number.same' => 'The confirm account number must match the bank account number.',
                    'bank_ifsc_code.required' => 'Please enter the IFSC code.',
                    'bank_branch.required' => 'Please enter the bank branch.',
                    'reference_name.string' => 'The reference field must be a string.',
                ]);

                if ($validator->fails()) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => $validator->errors()->first()]);
                    } else {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                }

                $employee = new Employee([
                    'employee_code' => strtoupper(uniqid()),
                    'department_uuid' => $request->input('department_uuid', NULL),
                    'date_of_birth' => $request->has('date_of_birth') ? date('Y-m-d', strtotime($request->input('date_of_birth'))) : NULL,
                    'employee_first_name' => $request->input('employee_first_name', NULL),
                    'employee_last_name' => $request->input('employee_last_name', NULL),
                    'date_of_joining' => $request->has('date_of_joining') ? date('Y-m-d', strtotime($request->input('date_of_joining'))) : NULL,
                    'gender' => $request->input('gender', NULL),
                    'designation' => $request->input('designation', NULL),
                    'email_id' => $request->input('email_id', NULL),
                    'password' => Hash::make($request->input('password')),                          // Hash Make Password
                    'mobile_number' => $request->input('mobile_number', NULL),
                    'blood_group' => $request->input('blood_group', NULL),
                    'country' => $request->input('country', NULL),
                    'state' => $request->input('state', NULL),
                    'city' => $request->input('city', NULL),
                    'address' => $request->input('address', NULL),
                    'adhaar_card_number' => $request->input('adhaar_card_number', NULL),
                    'pin_code' => $request->input('pin_code', NULL),
                    'emergency_contact' => $request->input('emergency_contact', NULL),
                    'office_email' => $request->input('office_email', NULL),
                    'office_mobile' => $request->input('office_mobile', NULL),
                    'pan_card_number' => $request->input('pan_card_number', NULL),
                    'address_proof_id_no' => $request->input('address_proof_id_no', NULL),
                    'employee_bank_name' => $request->input('employee_bank_name', NULL),
                    'bank_account_holder_name' => $request->input('bank_account_holder_name', NULL),
                    'bank_account_type' => $request->input('bank_account_type', NULL),
                    'bank_account_number' => $request->input('bank_account_number', NULL),
                    'confirm_account_number' => $request->input('confirm_account_number', NULL),
                    'bank_ifsc_code' => $request->input('bank_ifsc_code', NULL),
                    'bank_branch' => $request->input('bank_branch', NULL),
                    'bank_city' => $request->input('bank_city', NULL),
                    'reference_name' => $request->input('reference_name', NULL),
                    'employee_status' => $request->input('right_to_access', NULL),
                    'created_at' => date('Y-m-d H:i:s') ?? NULL,
                    'updated_at' => date('Y-m-d H:i:s') ?? NULL,
                ]);

                $uploadedFiles = [];

                if ($request->hasFile('upload_other_documents')) {
                    $files = $request->file('upload_other_documents');
                    foreach ($files as $file) {
                        if ($file->isValid()) {
                            $filePath = $file->storePublicly('documents', 'public');
                            $uploadedFiles['upload_other_documents'][] = basename($filePath); // Extract the file name
                        }
                    }
                }

                $fileInputs = [
                    'employee_profile',
                    'upload_pan_card_attachment',
                    'upload_adhaar_card_attachment',
                    'upload_resume_attachment',
                ];

                foreach ($fileInputs as $inputName) {
                    if ($request->hasFile($inputName) && $request->file($inputName)->isValid()) {
                        $filePath = $request->file($inputName)->storePublicly('documents', 'public');
                        $uploadedFiles[$inputName] = basename($filePath); // Extract the file name
                    }
                }

                if (array_key_exists('upload_other_documents', $uploadedFiles)) {
                    $uploadedFiles['upload_other_documents'] = implode(',', $uploadedFiles['upload_other_documents']);
                }


                $employee->fill($uploadedFiles);

                if ($employee->save()) {
                    return response()->json(['success' => true, 'errors' => null, 'message' => 'Employee Created Successfully']);
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

    public function employeeEdit(Request $request, $employeeID)
    {
        try {

            if ($request->isMethod('post')) {

                $validator = Validator::make($request->all(), [
                    'department_uuid' => 'required',
                    'date_of_birth' => 'required|date|before_or_equal:today',
                    'employee_first_name' => 'required|string',
                    'employee_last_name' => 'required|string',
                    'employee_profile' => 'image|mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw|max:2048', // Assuming it's an image
                    'date_of_joining' => 'nullable|date|before_or_equal:today',
                    'gender' => 'required|in:male,female,other',
                    'email_id' => 'required|email|unique:employees,email_id,' . lock($employeeID, 'decrypt') . ',_id',
                    'mobile_number' => 'nullable|digits:10',
                    'blood_group' => 'nullable|string',
                    'country' => 'required|exists:countries,id', // Assuming "countries" is your table name
                    'state' => 'required|exists:states,id', // Assuming "states" is your table name
                    'city' => 'required|exists:cities,id', // Assuming "cities" is your table name
                    'address' => 'required|string',
                    'designation' => 'required',
                    'adhaar_card_number' => 'required',
                    'pin_code' => 'nullable|numeric',
                    'emergency_contact' => 'required|digits:10',
                    'office_email' => 'required|email',
                    'office_mobile' => 'nullable|digits:10',
                    'pan_card_number' => 'required|string|regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/', // Assuming PAN card regex
                    'address_proof_id_no' => 'nullable|string',
                    'upload_pan_card_attachment' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048', // Assuming it's an image
                    'upload_id_proof_attachment' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048', // Assuming it's an image
                    'upload_other_documents' => 'required|array|min:1|max:10',
                    'upload_other_documents.*' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048',
                    //'upload_other_documents' => 'mimes:jpeg,bmp,png,jpg,webp,tiff,tif,raw,pdf|max:2048', // Assuming it's an image
                    'employee_bank_name' => 'required|string',
                    'bank_account_holder_name' => 'required|string',
                    'bank_account_type' => 'required|in:saving,current',
                    'bank_account_number' => 'required|string',
                    'confirm_account_number' => 'required|string|same:bank_account_number',
                    'bank_ifsc_code' => 'required|string',
                    'bank_branch' => 'required|string',
                    'reference_name' => 'nullable|string',
                    'bank_city' => 'required|string',
                ],[
                    'department_uuid.required' => 'Please choose a department.',
                    'date_of_birth.required' => 'The date of birth field is required.',
                    'employee_first_name.required' => 'Please enter the first name.',
                    'employee_last_name.required' => 'Please enter the last name.',
                    'employee_profile.image' => 'The employee profile must be an image (jpeg, bmp, png, jpg, webp, tiff, tif, raw) with a maximum size of 2MB.',
                    'date_of_joining.date' => 'Please enter a valid date for the date of joining.',
                    'gender.required' => 'Please select a gender.',
                    'email_id.required' => 'Please enter an email address.',
                    'email_id.email' => 'Please enter a valid email address.',
                    'email_id.unique' => 'This email address is already in use.',
                    'mobile_number.digits' => 'The mobile number must be exactly 10 digits.',
                    'country.required' => 'Please select a country.',
                    'state.required' => 'Please select a state.',
                    'city.required' => 'Please select a city.',
                    'address.required' => 'Please enter an address.',
                    'emergency_contact.digits' => 'The emergency contact must be exactly 10 digits.',
                    'office_email.required' => 'Please enter an office email address.',
                    'office_email.email' => 'Please enter a valid office email address.',
                    'pan_card_number.required' => 'Please enter a PAN card number.',
                    'pan_card_number.regex' => 'Please enter a valid PAN card number (Example: ABCTY1234D).',
                    'upload_pan_card_attachment.image' => 'The PAN card attachment must be an image or Pdf with a maximum size of 2MB.',
                    'upload_id_proof_attachment.image' => 'The ID proof attachment must be an image or Pdf with a maximum size of 2MB.',
                    'upload_other_documents.image' => 'The other documents attachment must be an image or Pdf with a maximum size of 2MB.',
                    'employee_bank_name.required' => 'Please enter the bank name.',
                    'bank_account_holder_name.required' => 'Please enter the bank account holder name.',
                    'bank_account_type.required' => 'Please select a bank account type.',
                    'bank_account_type.in' => 'Please select a valid bank account type.',
                    'bank_account_number.required' => 'Please enter the bank account number.',
                    'confirm_account_number.required' => 'Please confirm the bank account number.',
                    'confirm_account_number.same' => 'The confirm account number must match the bank account number.',
                    'bank_ifsc_code.required' => 'Please enter the IFSC code.',
                    'bank_branch.required' => 'Please enter the bank branch.',
                    'reference_name.string' => 'The reference field must be a string.',
                ]);

                if ($validator->fails()) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => $validator->errors()->first()]);
                    } else {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                }

                try{

                    $employee = Employee::findOrFail( lock($employeeID, 'decrypt') );
                    $employee->fill([
                        'department_uuid' => $request->input('department_uuid', $employee->department_uuid),
                        'date_of_birth' => $request->has('date_of_birth') ? date('Y-m-d', strtotime($request->input('date_of_birth'))) : $employee->date_of_birth,
                        'employee_first_name' => $request->input('employee_first_name', $employee->employee_first_name),
                        'employee_last_name' => $request->input('employee_last_name', $employee->employee_last_name),
                        'date_of_joining' => $request->has('date_of_joining') ? date('Y-m-d', strtotime($request->input('date_of_joining'))) : $employee->date_of_joining,
                        'gender' => $request->input('gender', $employee->gender),
                        'email_id' => $request->input('email_id', $employee->email_id),
                        'mobile_number' => $request->input('mobile_number', $employee->mobile_number),
                        'blood_group' => $request->input('blood_group', $employee->blood_group),
                        'country' => $request->input('country', $employee->country),
                        'state' => $request->input('state', $employee->state),
                        'city' => $request->input('city', $employee->city),
                        'adhaar_card_number' => $request->input('adhaar_card_number', $employee->adhaar_card_number),
                        'address' => $request->input('address', $employee->address),
                        'pin_code' => $request->input('pin_code', $employee->pin_code),
                        'designation' => $request->input('designation', $employee->designation),
                        'emergency_contact' => $request->input('emergency_contact', $employee->emergency_contact),
                        'office_email' => $request->input('office_email', $employee->office_email),
                        'office_mobile' => $request->input('office_mobile', $employee->office_mobile),
                        'pan_card_number' => $request->input('pan_card_number', $employee->pan_card_number),
                        'address_proof_id_no' => $request->input('address_proof_id_no', $employee->address_proof_id_no),
                        'employee_bank_name' => $request->input('employee_bank_name', $employee->employee_bank_name),
                        'bank_account_holder_name' => $request->input('bank_account_holder_name', $employee->bank_account_holder_name),
                        'bank_account_type' => $request->input('bank_account_type', $employee->bank_account_type),
                        'bank_account_number' => $request->input('bank_account_number', $employee->bank_account_number),
                        'confirm_account_number' => $request->input('confirm_account_number', $employee->confirm_account_number),
                        'bank_ifsc_code' => $request->input('bank_ifsc_code', $employee->bank_ifsc_code),
                        'bank_branch' => $request->input('bank_branch', $employee->bank_branch),
                        'bank_city' => $request->input('bank_city', $employee->bank_city),
                        'reference_name' => $request->input('reference_name', $employee->reference_name),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    if( !empty($request->input('password')) ){
                        $employee->fill([
                            'password' => Hash::make($request->input('password')),
                        ]);
                    }

                    $uploadedFiles = [];

                    if ($request->hasFile('upload_other_documents')) {
                        $files = $request->file('upload_other_documents');
                        foreach ($files as $file) {
                            if ($file->isValid()) {
                                $filePath = $file->storePublicly('documents', 'public');
                                $uploadedFiles['upload_other_documents'][] = basename($filePath); // Extract the file name
                            }
                        }
                    }

                    $fileInputs = [
                        'employee_profile',
                        'upload_pan_card_attachment',
                        'upload_adhaar_card_attachment',
                        'upload_resume_attachment',
                    ];

                    foreach ($fileInputs as $inputName) {
                        if ($request->hasFile($inputName) && $request->file($inputName)->isValid()) {
                            $filePath = $request->file($inputName)->storePublicly('documents', 'public');
                            $uploadedFiles[$inputName] = basename($filePath); // Extract the file name
                        }
                    }

                    if (array_key_exists('upload_other_documents', $uploadedFiles)) {
                        $uploadedFiles['upload_other_documents'] = implode(',', $uploadedFiles['upload_other_documents']);
                        $uploadedFiles['upload_other_documents'] .= ',';
                        $uploadedFiles['upload_other_documents'] .= $employee->upload_other_documents;
                        $uploadedFiles['upload_other_documents'] = trim($uploadedFiles['upload_other_documents'], ',');
                    }

                    $employee->fill($uploadedFiles);

                    if($employee->save()){
                        return response()->json(['success' => true, 'errors' => NULL, 'message' => 'Changes Saved Successfully']);
                    }else{
                        return response()->json(['success' => false, 'errors' => NULL, 'message' => 'Failed']);
                    }

                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                    return response()->json(['success' => false, 'errors' => NULL, 'message' => 'Employee not found']);
                }

            }else{

                return view('admin.employee.employee_edit', [
                    'getInfo' => Employee::where('_id', lock($employeeID, 'decrypt'))->first(),
                    'roles_list' => Roles::where('status', 'active')->get(),
                    'countries' => countries::all(),
                    'employeeID' => $employeeID
                ]);

            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e->getMessage(), 'message' => 'Unexpected Failed']);
        }
    }

    public function employeeAction(Request $request)
    {
        try {

            $employeeID = $request->uid ?? NULL;

            if ($request->isMethod('post')) {
                $employee = Employee::find(lock($employeeID, 'decrypt'));
                if (!$employee) {
                    return response()->json(['success' => false, 'errors' => NULL, 'message' => 'Employee not found.']);
                }
                if ($employee->delete()) {
                    return response()->json(['success' => true, 'errors' => NULL, 'message' => 'Employee removed successfully!']);
                } else {
                    return response()->json(['success' => false, 'errors' => NULL, 'message' => 'Employee removal failed.']);
                }
            } else {
                $employee = Employee::find(lock($employeeID, 'decrypt'));
                if (!$employee) {
                    return response()->json(['success' => false, 'errors' => NULL, 'message' => 'Employee not found.']);
                }
                $employee->employee_status = $employee->employee_status === 'active' ? 'inactive' : 'active';
                if ($employee->save()) {
                    return response()->json(['success' => true, 'errors' => NULL, 'message' => 'Changes saved successfully!']);
                } else {
                    return response()->json(['success' => false, 'errors' => NULL, 'message' => 'Changes not saved properly.']);
                }
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e->getMessage(), 'message' => 'Unexpected Failed']);
        }
    }

    public function loginProcess(Request $request)
    {
        try {

            if ($request->isMethod('post')) {

                $email = $request->user_email;
                $password = $request->user_password;
                $userDetails = Employee::where('office_email', $email)->first();
                
                if (!empty($userDetails) && Hash::check($password, $userDetails->password)) {
                    if ($userDetails->employee_status != 'active') {
                        return response()->json(['success' => false, 'title' => '', 'msg' => 'User Deactive. Contact executive for more info.']);
                    }
                    $request->session()->put('employee_code', lock($userDetails->employee_code));
                    $request->session()->put('department_uuid', lock($userDetails->department_uuid));
                    $request->session()->put('token', lock($userDetails->id));
                    return response()->json(['success' => true, 'title' => 'Login Successful', 'msg' => 'Welcome back!']);
                } else {
                    return response()->json(['success' => false, 'title' => 'Login Failed', 'msg' => 'Incorrect username or password. Please try again.']);
                }
            } else {
                return view('admin.login');
            }
        } catch (\Exception $e) {
            return response()->json(['success' => 500, 'msg' => $e->getMessage()]);
        }
    }

    public function dashboardPage()
    {
        return view('admin.dashboard.dashboard_home');
    }

    public function statesList(Request $request)
    {
        $getStates = states::where('country_id', $request->country_id)->get();
        $html = "";
        foreach ($getStates as $state) {
            $html .= "<option value=" . $state->id . ">" . str_replace(['-', '/', '_', '\\', '\''], '', $state->name) . "</option>";
        }
        return response()->json(['solve' => true, 'html_data' => $html]);
    }

    public function CitiesList(Request $request)
    {
        $getCities = cities::where('state_id', $request->state_id)->get();
        $html = "";
        foreach ($getCities as $city) {
            $html .= "<option value=" . $city->id . ">" . str_replace(['-', '/', '_', '\\', '\''], '', $city->name) . "</option>";
        }
        return response()->json(['solve' => true, 'html_data' => $html]);
    }

    public function vendor_dashboard()
    {
        $data['total_wallet_amt'] = Client_Wallet::where('vendor_id', 'SSVENDOR1122')->sum('wallet_amt');
        return view('admin.dashboard.vendor_dashboard',$data);
    }

}
