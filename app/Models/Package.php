<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'package';
    protected $fillable = [
        'lab_package',
        'providerid',
        'package_name',
        'category',
        'labtestid',
        'basePrice',
        'discount',
        'sample_type',
        'method',
        'result_time',
        'age_group',
        'gender',
        'organs',
        'tags',
        'attached_vitals',
        'forOrgeanUnlock',
        'numberOfAttachedVitals',
        'description',
        'trash'
    ];
}
