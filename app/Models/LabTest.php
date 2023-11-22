<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class LabTest extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'labTest';
    protected $fillable = [
        'test_idf',
        'providerId',
        'name',
        'category',
        'basePrice',
        'sampleType',
        'method',
        'description',
        'resultTime',
        'gender',
        'organs',
        'tags',
        'attachedVitals',
        'forOraganUnlock',
        'numberofVitalAttached',
        'trash'
    ];
}
