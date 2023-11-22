<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentDoctorModel;
use Illuminate\Validation\ValidationException;

class AppointmentDoctor extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointment = AppointmentDoctorModel::where('trash',"0")->get();
        return view('admin.products.appointmentdoctor.index',compact('appointment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.appointmentdoctor.create');
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
                "dr_name"=>'required',
                "consultation_fee"=>"required",
                "discount_fee"=>"required",
                "availability"=>"required",
                "appointment_time"=>'required',
            ],[
                "dr_name.required"=>"Please fill doctor name field",
                "consultation_fee.required"=>"Please fill consultation fee field",
                "discount_fee.required"=>"Please fill discount fee field",
                "availability.required"=>"Please select doctor availability field",
                "appointment_time.required"=>"Please select appointment time field ",
            ]);
            $input = $request->all();
            unset($input['token']);
            $input['trash']="0";
            $insert = AppointmentDoctorModel::create($input);
            if($insert){
                return response()->json([
                    'message'=>'insert successfull'
                ],200);
            }else{
                return response()->json([
                    'message'=>'Internal server error'
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
        $editData = AppointmentDoctorModel::where('_id',decrypt($id))->first();
        return view('admin.products.appointmentdoctor.edit',compact('editData'));
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
                "dr_name"=>'required',
                "appointment_time"=>'required',
                "consultation_fee"=>"required",
                "discount_fee"=>"required",
                "availability"=>"required",
            ],[
                "dr_name.required"=>"Please fill doctor name field",
                "appointment_time.required"=>"Please select appointment time field ",
                "consultation_fee.required"=>"Please fill consultation fee field",
                "discount_fee.required"=>"Please fill discount fee field",
                "availability.required"=>"Please select doctor availability field",
            ]);
            $input = $request->all();
            unset($input['token']);
            $update = AppointmentDoctorModel::where('_id',decrypt($id))->update($input);
            if($update){
                return response()->json([
                    'message'=>'update successfull'
                ],200);
            }else{
                return response()->json([
                    'message'=>'Internal server error'
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
        AppointmentDoctorModel::where('_id',decrypt($id))->update([
            'trash'=>'1'
        ]);
        return response()->json([
            'message'=>'delete successfull'
        ],200);
    }
}
