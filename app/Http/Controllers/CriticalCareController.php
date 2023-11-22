<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CriticalCare;
class CriticalCareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criticalcare = CriticalCare::where('trash','0')->get();
        return view('admin.products.criticalcare.index',compact('criticalcare'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.products.criticalcare.create");
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
                'name'=>'required',
                'image'=>'required'
            ],[
                'name.required'=>'Please fill name home care name field',
                'image.required'=>'Please upload a home care image'
            ]);
            $input = $request->all();
            unset($input['_token']);
            if($request->hasFile('image')){
                $file = $request->file('image')->store('criticalcarefiles','public');
                $input['image'] = $file;
            }
            $input['trash']="0";
            $insert = CriticalCare::create($input);
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
        $editData = CriticalCare::where('_id',decrypt($id))->first();
        return view('admin.products.criticalcare.edit',compact('editData'));
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
                'name'=>'required'
            ],[
                'name.required'=>'Please fill name home care name field'
            ]);
            $input = $request->all();
            unset($input['_token']);
            if($request->hasFile('image')){
                $deleteFile = CriticalCare::where('_id',decrypt($id))->first();
                unlink(public_path($deleteFile->image));
                $file = $request->file('image')->store('criticalcarefiles','public');
                $input['image'] = $file;
            }
            $update = CriticalCare::where('_id',decrypt($id))->update($input);
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
        CriticalCare::where('_id',decrypt($id))->update([
            'trash'=>'1'
        ]);
        return response()->json([
            'message'=>'delete successfull'
        ],200);
    }
}
