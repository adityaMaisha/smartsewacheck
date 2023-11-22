<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection="banner";
    protected $fillable=[
        "banner_name",
        "category",
        "offer_on",
        "discountper",
        "banner_image",
        "created_at",
        "updated_at",
        "trash",
        "status",
        "banner_position",
        "banner_validity"
    ];
}
