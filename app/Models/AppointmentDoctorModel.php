<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class AppointmentDoctorModel extends Model
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $collection="appointmentDoctor";
    protected $fillable=[
        "dr_name",
        "appointment_time",
        "created_at",
        "updated_at",
        "trash",
        "consultation_fee",
        "discount_fee",
        "availability"
    ];
}
