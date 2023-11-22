<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class RadiologyDiagnoseVendor extends Model
{
    use HasFactory;

    protected $connection="mongodb";
    protected $collection="radiology_diagnostics_vendor";
    
}
