<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class SetPermission extends Model
{
    use HasFactory;
    protected $collection = 'set_permission';

}
