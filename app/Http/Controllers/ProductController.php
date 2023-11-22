<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabTest;

class ProductController extends Controller
{
    public function labtest(){
        $labtests = LabTest::where('trash','0')->get();
        return view('admin.products.lab_test.index',compact('labtests'));
    }

}
