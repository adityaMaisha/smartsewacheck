<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class SmartHealthCheckupModel extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'smartHealthCheckup';
    protected $fillable = [
        "name",
        "checkup_price",
        "discount_price",
        "description",
        "instructions",
        "checkup_image",
        "created_at",
        "updated_at",
        'trash'
    ];
}
