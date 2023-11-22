<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Models\SmartHealthCheckupModel;

class SmartHealthCheckup extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getDatas = SmartHealthCheckupModel::where('trash','0')->get();
        return view('admin.products.smarthealthcheckup.index',compact('getDatas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.smarthealthcheckup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // smart_health_checkup_files
        try{
            $this->validate($request,[
                "checkup_name"=>'required',
                "checkup_price"=>'required',
                "discount_price"=>'required',
                "description"=>'required',
                "instructions"=>'required',
                "checkup_image"=>'required',
            ],[
                "checkup_name.required"=>"Please fill checkup name field",
                "checkup_price.required"=>"Please fill checkup price field",
                "discount_price.required"=>"Please fill discount price field",
                "description.required"=>"Please fill description field",
                "instructions.required"=>"Please fill instruction field",
                "checkup_image.required"=>"Please upload an image",
            ]);
            $inputs = $request->all();
            if($request->hasFile('checkup_image')){
                $file = $request->file('checkup_image')->store('smart_health_checkup_files','public');
                $inputs['checkup_image']=$file;
            }
            $inputs['trash']="0";
            $insert = SmartHealthCheckupModel::create($inputs);
            if($insert){
                return response()->json([
                    'message'=>'insert successfull'
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = SmartHealthCheckupModel::where('_id',decrypt($id))->first();
        return view('admin.products.smarthealthcheckup.edit',compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd('hello');
        try{
            // dd($request->all());
            $this->validate($request,[
                "name"=>'required',
                "checkup_price"=>'required',
                "discount_price"=>'required',
                "description"=>'required',
                "instructions"=>'required',
            ],[
                "name.required"=>"Please fill checkup name field",
                "checkup_price.required"=>"Please fill checkup price field",
                "discount_price.required"=>"Please fill discount price field",
                "description.required"=>"Please fill description field",
                "instructions.required"=>"Please fill instruction field",
            ]);
            $inputs = $request->all();
            if($request->hasFile('checkup_image')){
                $deleteFile = SmartHealthCheckupModel::where('_id',decrypt($id))->first();
                unlink(public_path($deleteFile->checkup_image));
                $file = $request->file('checkup_image')->store('smart_health_checkup_files','public');
                $inputs['checkup_image']=$file;
            }
            $inputs['trash']="0";
            unset($inputs['_token']);

            $update = SmartHealthCheckupModel::where('_id',decrypt($id))->update($inputs);
            if($update){
                return response()->json([
                    'message'=>'update successfull'
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = SmartHealthCheckupModel::where('_id',decrypt($id))->update([
            'trash'=>'1'
        ]);
        if($delete){
            return response()->json([
                'message'=> 'deleted successfull'
            ],200);
        }else{
            return response()->json([
                'message'=> 'Internal Server Error'
            ],500);
        }
        // dd(decrypt($id));
    }
}
