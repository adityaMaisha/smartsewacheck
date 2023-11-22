<?php

use App\Models\FrontFunctions;
use App\Models\DiagnosticsImport as DiagnosticsImportModel;

if ( !function_exists( "lock" ) ) {
    function lock( $string, $action = 'encrypt' )
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'DHP_MONGO_KG_3050'; // user define private key
        $secret_iv = '43240425234203263'; // user define secret key
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 ); // sha256 is hash_hmac_algo
        if ( $action == 'encrypt') {
            $output = openssl_encrypt( json_encode( $string ), $encrypt_method, $key, 0, $iv );
            $output = base64_encode( $output );
        } else if ( $action == 'decrypt') {
            $output = json_decode( openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv ) );
        }
        return $output;
    }
}


if ( !function_exists( "prx" ) ) {
    function prx( $x, $exit = 0 )
    {
        echo '<h1 style="top:0;position:fixed;color:white;background:red;text-align:center;width:30%;right:0;">PAGE UNDER CONSTRACTION</h1>';
        echo $res = "<pre>";
        if ( is_array( $x ) || is_object( $x ) ) {
            echo print_r( $x );
        } else {
            echo var_dump( $x );
        }
        echo "</pre>";
        if ( $exit == 0 ) {die();}
    }
}


if ( !function_exists( "pr" ) ) {
    function pr( $x, $exit = 0 )
    {
        echo $res = "<pre>";
        if ( is_array( $x ) || is_object( $x ) ) {
            print_r( $x );
        } else {
            echo var_dump( $x );
        }
        echo "</pre>";
        if ( $exit == 0 ) {die();}
    }
}

/*
* --------------------------------------------------------------------
* Roles and Privilege
* --------------------------------------------------------------------
*/

if (!function_exists('_registerFunction')) {function _registerFunction($whereCondition)
    {
        $existingFunction = FrontFunctions::where($whereCondition)->first();

        if (!$existingFunction) {
            $defaultValues = [
                'uuid' => uniqid(),
                'controller_name' => 'admin',
                'status' => 1,
                'created_on' => now(),
            ];

            $dataToInsert = array_merge($defaultValues, $whereCondition);
            FrontFunctions::create($dataToInsert);
        }
    }

}

/*
    _registerFunction(['function_name' => 'customer_schedule_list','alias' => 'Customer Schedule List','category' => 'Customer Schedule Management']);
*/


/*
* --------------------------------------------------------------------
* Query Helper
* --------------------------------------------------------------------
*/

if (!function_exists('_get')) {
    function _get($table)
    {
        return DB::table($table)->get()->all();
    }
}

/*
_get('vt_roles');
*/

if (!function_exists('_getOrderBy')) {
    function _getOrderBy($table, $orderBy = 'DESC')
    {
        return DB::table($table)->orderBy('id', $orderBy)->get()->all();
    }
}

/*
_getOrderBy('vt_roles');
*/

if (!function_exists('_getWhere')) {
    function _getWhere($table, $whereCondition, $multipleRow = 'no')
    {
        $builder = DB::table($table)->where($whereCondition);

        if ($multipleRow === 'no') {
            return $builder->first();
        } else {
            return $builder->get()->all();
        }
    }
}

/*
_getWhere('vt_roles', ['id' => 1]); // Single Data
_getWhere('vt_roles', ['plan' => 2], 'yes'); // Multiple Data
_getWhere('vt_roles', ['plan' => 2, 'id != ' => 123], 'yes'); // Multiple Data
*/

if (!function_exists('_getWhereCount')) {
    function _getWhereCount($table, $whereCondition, $multipleRow = 'no')
    {
        $builder = DB::table($table)->where($whereCondition);

        if ($multipleRow === 'no') {
            $resultCount = $builder->get()->first();
            return $resultCount ? 1 : 0;
        } else {
            return $builder->count();
        }
    }
}

/*
_getWhereCount('vt_roles', ['id' => 1]); // Single Data
_getWhereCount('vt_roles', ['plan' => 2], 'yes'); // Multiple Data
_getWhereCount('vt_roles', ['plan' => 2, 'id != ' => 123], 'yes'); // Multiple Data
*/

if (!function_exists('_getWhereCommaSeprated')) {
    function _getWhereCommaSeprated($table, $ids, $columnName = 'id')
    {
        return DB::table($table)->whereIn($columnName, explode(",", $ids))->get()->all();
    }
}

/*
_getWhereCommaSeprated('vt_question_bank', '80,121,83,84,114');
_getWhereCommaSeprated('vt_question_bank', '80,121,83,84,114', 'question_id');
*/

if (!function_exists('_getWhereIn')) {
    function _getWhereIn($table, $whereCondition, $columnName = 'id')
    {
        try {
            return DB::table($table)->whereIn($columnName, $whereCondition)->get()->all();
        } catch (Exception $e) {
            return $e->getMessage() ?? '';
        }
    }
}

/*
_getWhereIn('users', [1, 2, 3, 4, 5]); // WHERE id IN (1, 2, 3, 4, 5);
_getWhereIn('users', [1, 2, 3, 4, 5], 'UserProfileID'); // WHERE UserProfileID IN (1, 2, 3, 4, 5);
*/

if (!function_exists('_getWhereNotIn')) {
    function _getWhereNotIn($table, $whereCondition, $columnName = 'id')
    {
        try {
            return DB::table($table)->whereNotIn($columnName, $whereCondition)->get()->all();
        } catch (Exception $e) {
            return $e->getMessage() ?? '';
        }
    }
}

/*
_getWhereNotIn('users', [1, 2, 3, 4, 5]); // WHERE id NOT IN (1, 2, 3, 4, 5);
_getWhereNotIn('users', [1, 2, 3, 4, 5], 'UserProfileID'); // WHERE UserProfileID NOT IN (1, 2, 3, 4, 5);
*/

if (!function_exists('_updateWhere')) {
    function _updateWhere($table, $whereCondition, $data)
    {
        $builder = DB::table($table)->where($whereCondition);

        return $builder->update($data);
    }
}

/*
_updateWhere('user_profile', ['id' => $userid], [
    'status' => 'active',
]);
*/

if (!function_exists('_insert')) {
    function _insert($table, $data)
    {
        $builder = DB::table($table);

        if ($builder->insert($data)) {
            return DB::getPdo()->lastInsertId();
        } else {
            return false;
        }
    }
}

/*
_insert('users', ['fname'=>'abc', 'lname'=>'xyz']);
*/

if (!function_exists('_delete')) {
    function _delete($table, $where)
    {
        $builder = DB::table($table)->where($where);

        return $builder->delete();
    }
}

/*
_delete('users', ['id' => 1, 'status' => 'inactive']);
*/

if (!function_exists('_tableColumn')) {
    function _tableColumn($table)
    {
        try {
            $columns = DB::select('SHOW COLUMNS FROM ' . $table);
            $columnArray = [];

            foreach ($columns as $column) {
                $columnArray[$column->Field] = '';
            }

            return $columnArray;
        } catch (Exception $e) {
            return $e->getMessage() ?? '';
        }
    }
}

/*
_tableColumn('users')   // Return users table column name
*/


function updateOrCreate($table, $data, $where = [])
{
    $query = DB::table($table)->select('id')->where($where)->limit(1)->get();
    $row = $query->first();
    if ($row) {
        DB::table($table)->where($where)->update($data);
        return $row->id;
    } else {
        DB::table($table)->insert($data);
        return DB::getPdo()->lastInsertId();
    }
}

/*

$isUpdateOrCreate = updateOrCreate('users', [
    'employee_id' => lock($uid, 'decrypt'),
    'document_name' => $this->request->getPost('doc_passport_name'),
    'doc_type' => 'passport',
    'attachment' => $passport_attachments_files,
    'document_number' => $this->request->getPost('doc_passport_no'),
    'document_date_of_issue' => $this->request->getPost('doc_passport_date_of_issue'),
    'document_date_of_expiry' => $this->request->getPost('doc_passport_date_of_expiry'),
    'updated_at' => date('Y-m-d H:i:s'),
], [
    'employee_id' => lock($uid, 'decrypt')          // WHERE CONDITION
]);

if ($isUpdateOrCreate !== false) {
    echo 'Record updated or created successfully. ID: ' . $isUpdateOrCreate;
} else {
    echo 'Error updating or creating record.';
}
*/

function recurse_fron_cat_data($cat_name)
{
    return FrontFunctions::where('category', $cat_name)->get();
    // return $data = FrontFunctions::select('front_functions.*')->where('category', $cat_name)->get()->toArray();
}

function _fetch_table_row_data($table, $whereCondition)
{
    $builder = DB::table($table);
    if (!empty($whereCondition)) {
        $builder = $builder->where($whereCondition);
    }
    return $builder->first();
}

// function _fetch_front_function_cat_alias()
// {
//     $builder = DB::table('ec_front_functions as f')->select('f.*')->groupBy('f.category');
//     $data = $builder->get()->toArray();

//     if (!empty($data)) {
//         foreach ($data as $key => $value) {
//             $cat_data = recurse_fron_cat_data($value->category);

//             if (!empty($cat_data)) {
//                 $data[$key]->category_data = $cat_data;
//             } else {
//                 $data[$key]->category_data = array();
//             }
//         }
//         return $data;
//     } else {
//         $data = array();
//     }
// }


// if (!function_exists('_fetch_front_function_cat_alias')) {
//     function _fetch_front_function_cat_alias()
//     {
//         $builder = DB::table('ec_front_functions as f');
//         $builder->select('f.category', DB::raw('MAX(f.function_id) as function_id'));
//         $builder->groupBy('f.category');
//         $data = $builder->get()->toArray();
//         if (!empty($data)) {
//             foreach ($data as $key => $value) {
//                 $cat_data = recurse_fron_cat_data($value->category);

//                 if (!empty($cat_data)) {
//                     $data[$key]->category_data = $cat_data;
//                 } else {
//                     $data[$key]->category_data = [];
//                 }
//             }
//             return $data;
//         } else {
//             return [];
//         }
//     }
// }


function _fetch_front_function_cat_alias()
{

    $data = FrontFunctions::groupBy('category')->get(['uuid', 'function_name', 'controller_name', 'alias', 'category', 'status', 'created_on'])->toArray();
    prx( $data );


    $data = FrontFunctions::get()->toArray();
    $collection = collect($data);
    $groupedData = $collection->groupBy('category');

    // $data = FrontFunctions::select('*')
    // ->groupBy('category')
    // ->get()->toArray();


/*



    $db = \Config\Database::connect();
    $builder = $db->table( 'front_functions as f' );
    $builder->select( 'f.*' );
    $builder->groupBy( 'f.category' );
    $data = $builder->get()->getResultArray();

    if(!empty($data)){
        foreach ($data as $key => $value) {
            $cat_data = recurse_fron_cat_data($value['category']);

            if(!empty($cat_data)){
                $data[$key]['category_data'] = $cat_data;
            }
            else{
                $data[$key]['category_data'] = array();
            }
        }
        return $data;

    }
    else{
        $data = array();
    }



*/

}




if (!function_exists('_update_table_common')) {
    function _update_table_common($table, $data, $whereCondition)
    {
        $builder = DB::table($table)->where($whereCondition);

        return $builder->update($data);
    }
}



if (!function_exists('authChecker')) {
    function authChecker($controller = 'admin', $function_name)
    {

        try {

            if (is_array($function_name) && !empty($function_name)) {
                $role_id = '64f075480be38'; //  TABLE = roles_type ||  column = uuid
                if ($role_id) {
                    $getRolesInfo = _getWhere('roles_type', ['uuid' => $role_id]);
                    if ($getRolesInfo) {
                        if ($getRolesInfo['vip'] == 'yes') {
                            return true; // ALL OK || VIP USER or SUPER ADMIN
                        }
                    }

                    $FrontFunctions = DB::table('front_functions')
                        ->where('controller_name', $controller)
                        ->whereIn('function_name', $function_name)
                        ->get()
                        ->toArray();

                    if ($FrontFunctions) {
                        $role_id_uuid = $getRolesInfo['_id']->__toString();
                        $AccessID = array_column($FrontFunctions, 'uuid');
                        $userPermission = DB::table('set_permission')
                            ->where('role_id', $role_id_uuid)
                            ->first();

                        if ($userPermission) {
                            $functionStringList = $userPermission['function_id'];
                            $function_ARRAY = explode(',', $functionStringList);
                            if (count(array_intersect($AccessID, $function_ARRAY)) > 0) {
                                return true; // ALL OK
                            } else {
                                return false; // false;
                            }
                        } else {
                            return false; // Permission ID Not Found
                        }
                    } else {
                        return false; // Function ID Not Found
                    }
                } else {
                    return false; // Role ID Not Found
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}


/* ====[ Roles & Permission ]==== */
/*
        // Controller

        // <==[ Accessibility Checker :: START ]==>
        if( !authChecker('admin', [
            'manpower_management_category_create',
        ]) ){
            return redirect()->route('dashboard.index')->withInput()->with( 'flash_array', ['access_denied' => 'access_denied'] );
        }
        // <==[  Accessibility Checker :: END  ]==>


        // View
        <?php if(authChecker('admin', [
            'dashboard_total_manpower',
            'manpower_management_category_list',
            'manpower_management_category_remove',
            'manpower_management_category_edit'
            ])): ?>

            ...HTML...

        <?php endif; ?>



*/


function testSachin($row){

    // echo '<pre>';
    // print_r([
    //     $row[0],
    //     $row[1],
    //     $row[2],
    //     $row[3],
    //     $row[4],
    //     $row[5],
    //     $row[6],
    //     $row[7],
    //     $row[8],
    //     $row[9],
    //     $row[10],
    //     $row[11],
    //     $row[12],
    //     $row[13],
    //     $row[14],
    //     $row[15],
    //     $row[16],
    //     $row[17],
    //     $row[18],
    //     $row[19],
    // ]);
    // echo '</pre>';
// dd('hi');
    // _insert('test123', ['fname'=> 123, 'lname'=> 3234]);
// die();
    $diagnosticsImport = new DiagnosticsImportModel;
    $diagnosticsImport->uid = uniqid();
    $diagnosticsImport->testIdF = 'hello';
    $diagnosticsImport->save();
    sleep(1);
dd('sachin');
    die();

}
