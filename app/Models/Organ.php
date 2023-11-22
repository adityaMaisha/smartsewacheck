<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Organ extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'organ';
    protected $fillable = [
        "name",
        "d3_image",
        "icon",
        "created_at",
        "updated_at",
        'trash'
    ];
}
