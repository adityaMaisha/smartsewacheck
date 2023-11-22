<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabTest;
use App\Models\Organ;
use Illuminate\Validation\ValidationException;

class LabTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('products.labtest');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organs = Organ::where('trash','0')->get();
        return view('admin.products.lab_test.create',compact('organs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try{
            $this->validate($request,[
                'test_idf'=>'required|regex:/^LT-\d{2}$/|unique:labTest,test_idf',
                'providerId'=>'required|regex:/^AHDPL-\d{4}$/',
                'name'=>'required',
                'category'=>'required',
                'basePrice'=>'required|integer',
                'sampleType'=>'required',
                'method'=>'required',
                'description'=>'required',
                'resultTime'=>'required',
                'gender'=>'required',
                'organs'=>'required',
                'tags'=>'required',
                'attachedVitals'=>'required',
                'forOraganUnlock'=>'required',
                'numberofVitalAttached'=>'required'
            ],[
                'test_idf.required'=>'Please fill test idf field',
                'test_idf.unique'=>'Test idf already taken',
                'test_idf.regex'=>'Invalid data in test idf field',
                'providerId.required'=>'Please fill provider id field',
                'providerId.regex'=>'Invalid data in provider id field',
                'name.required'=>'Please fill name field',
                'category.required'=>'Please fill category field',
                'basePrice.required'=>'Please fill base price field',
                'basePrice.integer'=>'Please fill numeric value in base price field',
                'sampleType.required'=>'Please fill sample type field',
                'method.required'=>'Please fill method field',
                'description.required'=>'Please fill description field',
                'resultTime.required'=>'Please fill result time field',
                'gender.required'=>'Please fill gender field',
                'organs.required'=>'Please fill organs field',
                'tags.required'=>'Please fill tags field',
                'attachedVitals.required'=>'Please fill attached vital field',
                'forOraganUnlock.required'=>'Please fill for organ unlocked field',
                'numberofVitalAttached.required'=>'Please fill number if vital attached'
            ]);
            $inputs = $request->all();
            unset($inputs['_token']);
            $inputs['trash']="0";
            $insertquery = LabTest::create($inputs);
            if($insertquery){
                return response()->json([
                    'message'=>'data inserted'
                ],200);
            }else{
                return response()->json([
                    'message'=>'data not inserted'
                ],500);
            }

        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            throw $e;
        }
        // dd($request->all());
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
        $editDatas = LabTest::where('_id',decrypt($id))->first();
        $organs = Organ::where('trash','0')->get();
        return view('admin.products.lab_test.edit',compact('editDatas','organs'));
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
        // dd();
        $inputs = $request->all();
        unset($inputs['_token']);
        $updateData = LabTest::where('_id',decrypt($id))->update($inputs);
        if($updateData){
            return response()->json([
                'message'=>'data updated'
            ],200);
        }else{
            return response()->json([
                'message'=>'internal server error'
            ],500);
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
        $labtestdelete = LabTest::where('_id',decrypt($id))->update([
            'trash'=>'1'
        ]);
        if($labtestdelete){
            return response()->json([
                'message'=>'data deleted'
            ],200);
        }else{
            return response()->json([
                'message'=>'internal server error'
            ],500);
        }
        // dd($id);
    }
}

