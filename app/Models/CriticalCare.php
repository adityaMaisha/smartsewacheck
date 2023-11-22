<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class CriticalCare extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'criticalCare';
    protected $fillable = [
        "name",
        "image",
        "status",
        "created_at",
        "updated_at",
        'trash',
        "price",
        "discount_price",
        "description",
        "instructions"
    ];
}
