<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class HomeCare extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'homeCare';
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
