<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organ;
use Illuminate\Validation\ValidationException;

class OrganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getDatas = Organ::where('trash','0')->get();
        return view('admin.products.organs.index',compact('getDatas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.organs.create');
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
            $this->validate($request,[
                "name"=>'required',
                "3d_image"=>'required',
                "icon"=>'required',
            ],[
                "name.required"=>'Please fill organ name field',
                "3d_image.required"=>'Please upload Organ 3D Image',
                "icon.required"=>'Please upload',
            ]);
            $inputs= $request->all();
            unset($inputs['_token']);
            if($request->hasFile('3d_image')){
                $d3file=$request->file('3d_image')->store('organs_file','public');
                $inputs['3d_image']=$d3file;
            }
            if($request->hasFile('icon')){
                $iconfile=$request->file('icon')->store('organs_file','public');
                $inputs['icon']=$iconfile;
            }
            $inputs['trash']='0';
            $insert = Organ::create($inputs);
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
        $editData = Organ::where('_id',decrypt($id))->first();
        return view('admin.products.organs.edit',compact('editData'));
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
            $this->validate($request,[
                "name"=>'required'
            ],[
                "name.required"=>'Please fill organ name field'
            ]);
            $inputs= $request->all();
            unset($inputs['_token']);
            if($request->hasFile('d3_image')){
                $deleteFile = Organ::where('_id',decrypt($id))->first();
                unlink(public_path($deleteFile->d3_image));
                $d3file=$request->file('d3_image')->store('organs_file','public');
                $inputs['d3_image']=$d3file;
            }
            if($request->hasFile('icon')){
                $deleteFile1 = Organ::where('_id',decrypt($id))->first();
                unlink(public_path($deleteFile1->icon));
                $iconfile=$request->file('icon')->store('organs_file','public');
                $inputs['icon']=$iconfile;
            }
            $update = Organ::where('_id',decrypt($id))->update($inputs);
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
        Organ::where('_id',decrypt($id))->update([
            'trash'=>'1'
        ]);
        return response()->json([
            'message'=>'delete successfull'
        ],200);
    }
}
