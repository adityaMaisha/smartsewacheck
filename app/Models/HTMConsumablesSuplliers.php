<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class HTMConsumablesSuplliers extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'HTMConsumablesSuplliers';
    protected $fillable = [
        "vendor_type",
        "vendor_name",
        "head_name",
        "services",
        "care",
        "address",
        "email_id",
        "mobile_number",
        "country",
        "state",
        "city",
        "office_email",
        "password",
        "contact_person_name",
        "contact_per_mobile",
        "adhaar_card_number",
        "pan_card_number",
        "employee_bank_name",
        "bank_account_holder_name",
        "bank_account_type",
        "bank_account_number",
        "confirm_account_number",
        "bank_ifsc_code",
        "bank_branch",
        "bank_city",
        "reference_name",
        "employee_profile",
        "gst_certificate",
        "upload_pan_card_attachment",
        "registration_docs",
        "upload_other_documents",
        'admin_id',
        'trash'
    ];
}
