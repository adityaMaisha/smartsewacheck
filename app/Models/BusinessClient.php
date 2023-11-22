<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class BusinessClient extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'businessClient';
    protected $fillable = [
            "service_name",
            "bus_client_state",
            "bus_client_city",
            "service_category",
            "del_mode",
            "ser_pin_code",
            "time_consume_customer",
            "cust_eng_day",
            "per_cust_cost",
            "description",
            "bus_client_customer_vendor",
            "bus_client_customer_vendorname",
            "is_end_cust",
            "startDateTime",
            "endDateTime",
            "created_at",
            "updated_at",
            "trash"
    ];
}
