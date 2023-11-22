<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $collection = 'roles_type';

}
