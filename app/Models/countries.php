<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class countries extends Model
{
    use HasFactory;

    protected $collection = 'countries';

    protected $guarded = [];
}
