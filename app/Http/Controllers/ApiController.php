<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
class ApiController extends Controller
{
    public function getbanners(){
        // $banner = Banner::where('_id',$id)->first();
        $banners = Banner::where('status',"1")->where("trash","0")->get();
        $finalData = $banners;
        $includedproducts=[];
        // dd($banners);
        foreach($banners as $key=>$banner){
            $modelName = app('App\\Models\\'.$banner->category);
            foreach($banner->offer_on as $productid){
                // dd($productid);
                $productData = $modelName::where('_id', $productid)->first();
                // $includedproducts[] = $productData;
                $finalData[$key][str_replace(' ','_',$productData->name)] = $productData;
            }
        }
        // $finalData['offer_on']=$includedproducts;
        // dd($finalData);
        return response()->json([
            'message'=>'data retrieved',
            'data'=>$finalData
        ],200);
    }
}
