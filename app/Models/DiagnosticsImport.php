<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class DiagnosticsImport extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $collection = 'diagnostics_list';

}
