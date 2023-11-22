<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class VendorPathLab extends Model
{
    use HasFactory;
    protected $collection = 'vendor_path_lab';
    protected $guarded = [];

    public function getState()
    {
        return $this->belongsTo(states::class, 'state', 'id');
    }

    public function getCity()
    {
        return $this->belongsTo(cities::class, 'city', 'id');
    }

}
