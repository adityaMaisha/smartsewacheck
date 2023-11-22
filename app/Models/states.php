<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class states extends Model
{
    use HasFactory;
    protected $collection = 'states';

    protected $guarded = [];
}
