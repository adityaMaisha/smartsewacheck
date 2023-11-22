<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\LabTest;
use App\Models\SmartHealthCheckupModel;
use App\Models\Package;
use Illuminate\Validation\ValidationException;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::where('trash','0')->get();
        return view('admin.products.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            // dd($request->all());
            $this->validate($request,[
                "banner_name" => "required",
                "category" => "required",
                "offer_on" => "required",
                "discountper" => "required",
                "banner_image"=>"required"
            ],[
                "banner_name.required"=>"Please fill banner name field",
                "category.required"=>"Please select category field",
                "offer_on.required"=>"Please select offer on field",
                "discountper.required"=>"Please fill discount % field",
                "banner_image.required"=>"Please upload an image",
            ]);
            $input = $request->all();
            unset($input['_token']);
            $input['trash'] = '0';
            $input['status'] = "1";
            if($request->hasFile('banner_image')){
                $file = $request->file('banner_image')->store('banner_files','public');
                $input['banner_image']=$file;
            }
            $insert = Banner::create($input);
            $url = url('/').'/api/getbanners/'.$insert->_id;
            $insertUrl = Banner::where('_id',$insert->_id)->update([
                'url'=>$url
            ]);
            if($insertUrl){
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
        // dd('hello');
        $editData = Banner::where('_id',decrypt($id))->first();
        return view('admin.products.banner.edit',compact('editData'));
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
        try{
            // dd($request->all());
            $this->validate($request,[
                "banner_name" => "required",
                "category" => "required",
                "offer_on" => "required",
                "discountper" => "required"
            ],[
                "banner_name.required"=>"Please fill banner name field",
                "category.required"=>"Please select category field",
                "offer_on.required"=>"Please select offer on field",
                "discountper.required"=>"Please fill discount % field"
            ]);
            $input = $request->all();
            unset($input['_token']);
            if($request->hasFile('banner_image')){
                $file = $request->file('banner_image')->store('banner_files','public');
                $input['banner_image']=$file;
            }
            $insert = Banner::where('_id',decrypt($id))->update($input);
            if($insert){
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
        Banner::where('_id',decrypt($id))->update([
            'trash'=>'1'
        ]);
        return response()->json([
            'message'=>'Delete successfull'
        ],200);
    }

    public function getlist(Request $request){
        $modelInstance = app("App\\Models\\$request->data");
        $data = $modelInstance::where('trash','0')->get();
        // $modelName = $request->data;
        // $modelInstance = app("App");
        return response()->json([
            'message'=>'data retrieved',
            'data'=>$data
        ],200);
    }

    public function changeStatus(Request $request){
        Banner::where('_id',decrypt($request->id))->update([
            'status'=>$request->data
        ]);
        return response()->json([
            'message'=>'status changed'
        ],200);
    }
}
