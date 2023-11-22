<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use App\Models\SetPermission;
use App\Models\FrontFunctions;
use Illuminate\Support\Facades\Redirect;

class RolesPrivilegesController extends Controller
{
    public function rolesNew(Request $request)
    {
        if($request->isMethod('post')){

            $request->validate([
                'role_name' => 'required|unique:ec_roles_type,title',
                'status' => 'required|in:active,inactive',
                'designation_description' => 'nullable|min:1',
            ]);

            $role = new Roles();
            $role->uuid = uniqid();
            $role->title = $request->role_name;
            $role->status = $request->status;
            $role->editable = 'yes';
            $role->deletable = 'yes';
            $role->vip = 'no';
            $role->created_at = now()->timestamp;
            $role->updated_at = now()->timestamp;
            if ($role->save()) {
                return Redirect::route('list.roles')->with('success', 'Home Register successfully.');
            } else {
                return Redirect::back()->with('errors', 'Home was not register correctly.');
            }

        }else{
            return view('admin.roles.create');
        }

    }
    public function rolesList()
    {

        FrontFunctions::truncate();           //   Remove All Records

        // Testing Function Create
        _registerFunction(['function_name' => 'department_list','alias' => 'Department List','category' => 'Department Management']);
        _registerFunction(['function_name' => 'department_edit','alias' => 'Department Edit','category' => 'Department Management']);
        _registerFunction(['function_name' => 'department_remove','alias' => 'Department Remove','category' => 'Department Management']);
        _registerFunction(['function_name' => 'department_create','alias' => 'Department Create','category' => 'Department Management']);

        _registerFunction(['function_name' => 'user_list','alias' => 'user List','category' => 'User Management']);
        _registerFunction(['function_name' => 'user_edit','alias' => 'user Edit','category' => 'User Management']);
        _registerFunction(['function_name' => 'user_remove','alias' => 'user Remove','category' => 'User Management']);
        _registerFunction(['function_name' => 'user_create','alias' => 'user Create','category' => 'User Management']);

        _registerFunction(['function_name' => 'offer_list','alias' => 'offer List','category' => 'offer Management']);
        _registerFunction(['function_name' => 'offer_edit','alias' => 'offer Edit','category' => 'offer Management']);
        _registerFunction(['function_name' => 'offer_remove','alias' => 'offer Remove','category' => 'offer Management']);
        _registerFunction(['function_name' => 'offer_create','alias' => 'offer Create','category' => 'offer Management']);

        _registerFunction(['function_name' => 'hello_list','alias' => 'hello List','category' => 'hello Management']);
        _registerFunction(['function_name' => 'hello_edit','alias' => 'hello Edit','category' => 'hello Management']);
        _registerFunction(['function_name' => 'hello_remove','alias' => 'hello Remove','category' => 'hello Management']);
        _registerFunction(['function_name' => 'hello_create','alias' => 'hello Create','category' => 'hello Management']);

        return view('admin.roles.list', [
            'roles' => Roles::get()
        ]);

    }
    public function privilegesList(Request $request, $roleid)
    {
        $roleid_get = lock($roleid,'decrypt');
        $infoGet = Roles::find($roleid_get);
        if($infoGet){
            if($infoGet->editable == 'no'){
                return redirect()->route('dashboard.home')->withInput()->with( 'flash_array', ['error' => 'Role not editable.'] );
            }
        }else{
            return redirect()->route('dashboard.home')->withInput()->with( 'flash_array', ['error' => 'Role not found.'] );
        }

        $encrpyt_roldeid = $roleid;
        $role_get_row = Roles::find($roleid_get);

        // $role_get_row = _fetch_table_row_data($table='roles_type', $whereCondition=array('id'=>$roleid_get));
        // $front_function_cat_alias = _fetch_front_function_cat_alias();
        // prx($front_function_cat_alias);

        $front_function_cat_alias = FrontFunctions::groupBy('category')->get(['uuid', 'function_name', 'controller_name', 'alias', 'category', 'status', 'created_on']);
        if($front_function_cat_alias){
            foreach ($front_function_cat_alias as $key => $value) {
                $cat_data = recurse_fron_cat_data($value['category']);
                if(!empty($cat_data)){
                    $front_function_cat_alias[$key]['category_data'] = $cat_data;
                }
                else{
                    $front_function_cat_alias[$key]['category_data'] = array();
                }
            }
        }else{
            $front_function_cat_alias = [];
        }

        /*
        * --------------------------------------------------------------------
        * POST METHOD FOR FORM SUBMISSION
        * --------------------------------------------------------------------
        */
        if ( $request->isMethod('post') ) {

            /* =====[ VALIDATION :: START ]===== */
            $request->validate([
                'permission_alias' => 'required',
            ]);

            // $rules = [
            //     "permission_alias" => [
            //         "label" => "Roles Capability",
            //         "rules" => "required",
            //     ],
            // ];

            // if (!$this->validate($rules)){
            //     $errors = $this->validator->getErrors();
            //     return $this->response->setJSON(['success' => false, 'msg' => reset($errors), 'errors' => $errors, 'data' => null]);
            // }
            /* =====[ VALIDATION :: END ]===== */



            /* ====[ Roles & Permission ]==== */
            //if((!authChecker('admin', 'rolesManagement_edit'))) { return redirect()->to(route_to('access.denied')); }

            // $roleid_get;
            $postData = $request->all();
                $permission_alias = $postData['permission_alias'];
                $array_get = array();
                if(!empty($permission_alias)){
                    foreach ($permission_alias as $key => $value) {
                        if(!empty($value)){
                            $array_get[] =  $value;
                        }
                    }
                }
                $permission_alias = $array_get;
                if(!empty($permission_alias)){

                    $permission_alias_val = array_values($permission_alias);
                    $permission_alias = implode(',', $permission_alias);

                    // prx( $roleid_get );

                    $verify_set_permission_tbl =  _fetch_table_row_data($table='set_permission',$whereCondition=array('role_id'=>$roleid_get));
                    if(!empty($verify_set_permission_tbl)){

                        $update_data = array( 'function_id'=>$permission_alias );
                        _update_table_common( $table='set_permission', $update_data, $whereCondition=array('role_id'=>$roleid_get) );
                        return response()->json(['success' => true,'msg' => 'Permission Updated Successfully','errors' => null,'data' => null]);

                    }else{

                        $insert_data = array('role_id'=>$roleid_get, 'function_id'=>$permission_alias );
                        $result = _insert_MONGODB( $table='set_permission', $insert_data);
                        return response()->json(['success' => true,'msg' => 'Permission Added Successfully','errors' => null,'data' => null]);

                    }
                }
                else{

                    return response()->json(['success' => false,'msg' => 'Please Select Permission.','errors' => null,'data' => null]);

                }

        }

        /*
        * --------------------------------------------------------------------
        * GET METHOD FOR RETURN VIEW
        * --------------------------------------------------------------------
        */

        $permisson_get_row = SetPermission::where(['role_id'=>$roleid_get])->first();

        // $permisson_get_row = _fetch_table_row_data($table='ec_set_permission', $whereCondition=array('role_id'=>$roleid_get));

        return view('admin.roles.privileges-list')
        ->with(compact('permisson_get_row'))
        ->with(compact('roleid_get'))
        ->with(compact('encrpyt_roldeid'))
        ->with(compact('role_get_row'))
        ->with(compact('front_function_cat_alias'));


        /* ====[ Roles & Permission ]==== */
        //if((!authChecker('admin', 'rolesManagement_edit'))) { return redirect()->to(route_to('access.denied')); }

        // dd($datasend);
        // return view('dashboard/setting/roles', $datasend);



            // $permisson_get_row = $datasend['permisson_get_row'];
            // $roleid_get = $datasend['roleid_get'];
            // $role_get_row = $datasend['role_get_row'];
            // $front_function_cat_alias = $datasend['front_function_cat_alias'];

            // return view('admin.roles.privileges-list', compact('permisson_get_row', 'roleid_get', 'role_get_row', 'front_function_cat_alias'));


        // return view('admin.roles.privileges-list', compact(['permisson_get_row', 'roleid_get', 'encrpyt_roldeid', 'role_get_row', 'front_function_cat_alias']));



    }
    public function rolesEdit(Request $request, $roleid)
    {
        if($request->isMethod('post')){

            $request->validate([
                'role_name' => 'required|unique:ec_roles_type,title,'.lock($roleid, 'decrypt'),
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

        }else{
            $getInfo = Roles::find(lock($roleid, 'decrypt'));
            return view('admin.roles.edit', compact('roleid', 'getInfo'));
        }

    }

    public function rolesRemove(Request $request, $roleid)
    {
        $role = Roles::find(lock($roleid, 'decrypt'));
        if($role){
            if($role->deletable == 'yes'){
                $role->delete();
                return Redirect::route('list.roles')->with('success', 'Role removed successfully');
            }else{
                return Redirect::back()->with('errors', 'Deletable is disabled on this department.');
            }
        }else{
            return Redirect::back()->with('errors', 'Deletable is disabled on this department.');
        }
    }

}
