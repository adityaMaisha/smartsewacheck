<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function customerNew(Request $request)
    {
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'middle_name' => 'nullable|string',
                'last_name' => 'nullable|string',
                'gender' => 'required|in:male,female,other',
                'date_of_birth' => 'nullable',
                'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-,',
                'email_address' => 'required|email|unique:customer,email_address',
                'mobile_number' => 'required|digits:10|unique:customer,mobile_number',
                'login_password' => 'required',
                'address' => 'nullable',
            ]);

            $validator->setAttributeNames([
                'first_name' => 'First Name',
                'middle_name' => 'Middle Name',
                'last_name' => 'Last Name',
                'gender' => 'Gender',
                'date_of_birth' => 'Date of Birth',
                'blood_group' => 'Blood Group',
                'email_address' => 'Email Address',
                'mobile_number' => 'Mobile Number',
                'login_password' => 'Login Password',
                'address' => 'Address',
            ]);

            $validator->setCustomMessages([
                'required' => ':attribute is required.',
                'regex' => ':attribute should only contain alphabets and spaces.',
                'in' => 'Please select a valid :attribute.',
                'email' => 'Invalid email address for :attribute.',
                'digits' => ':attribute should be exactly 10 digits.',
                'min' => ':attribute should be at least :min characters long.',
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => $validator->errors()->first()]);
                } else {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }

            $customer = new Customer();
            $customer->uuid = uniqid();
            $customer->client_id = NULL;
            $customer->first_name = $request->first_name ?? NULL;
            $customer->middle_name = $request->middle_name ?? NULL;
            $customer->last_name = $request->last_name ?? NULL;
            $customer->gender = $request->gender ?? NULL;
            $customer->date_of_birth = $request->date_of_birth ?? NULL;
            $customer->blood_group = $request->blood_group ?? NULL;
            $customer->email_address = $request->email_address ?? NULL;
            $customer->mobile_number = $request->mobile_number ?? NULL;
            $customer->login_password = Hash::make($request->login_password) ?? NULL;
            $customer->address = $request->address ?? NULL;
            $customer->subcribtion_status = NULL;
            $customer->status = 'active';
            if ($customer->save()) {
                $response = $request->ajax() ? response()->json(['success' => true, 'errors' => '', 'message' => 'Customer registered successfully.']) : redirect()->route('list.roles')->with('success', 'Customer registered successfully.');
            } else {
                $response = $request->ajax() ? response()->json(['success' => false, 'errors' => 'Customer was not registered correctly', 'message' => 'Customer was not registered correctly.']) : redirect()->back()->with('errors', 'Customer was not registered correctly.');
            }

            return $response;
        } else {
            return view('admin.customer.create');
        }
    }


    public function customersList()
    {

        return view('admin.customer.list', [
            'customers' => Customer::get()
        ]);
    }

    public function customerEdit(Request $request, $roleid)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'role_name' => 'required|unique:ec_roles_type,title,' . lock($roleid, 'decrypt'),
                'status' => 'required|in:active,inactive',
                'designation_description' => 'nullable|min:1',
            ]);

            $role = Roles::find(lock($roleid, 'decrypt'));
            $role->title = $request->role_name;
            $role->status = $request->status;
            $role->designation_description = $request->designation_description;
            $role->updated_at = now()->timestamp;
            if ($role->save()) {
                return Redirect::route('list.roles')->with('success', 'Role changes saved');
            } else {
                return Redirect::back()->with('errors', 'Role was not changes saved correctly.');
            }
        } else {

            // $getInfo = Roles::find(lock($roleid, 'decrypt'));
            // return view('admin.roles.edit', compact('roleid', 'getInfo'));
            return view('admin.customer.edit');

        }
    }

    public function customersRemove(Request $request, $roleid)
    {
        $role = Roles::find(lock($roleid, 'decrypt'));
        if ($role) {
            if ($role->deletable == 'yes') {
                $role->delete();
                return Redirect::route('list.roles')->with('success', 'Role removed successfully');
            } else {
                return Redirect::back()->with('errors', 'Deletable is disabled on this department.');
            }
        } else {
            return Redirect::back()->with('errors', 'Deletable is disabled on this department.');
        }
    }
}
