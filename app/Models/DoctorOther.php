<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class DoctorOther extends Model
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $collection="doctorandOther";
    protected $fillable=[
        "vendor_type",
        "other_vendor_doctor",
        "salutation",
        "care",
        "vendor_name",
        "date_of_birth",
        "address",
        "email_id",
        "mobile_number",
        "country",
        "state",
        "city",
        "short_brief",
        "office_email",
        "password",
        "contact_person_name",
        "contact_per_mobile",
        "adhaar_card_number",
        "pan_card_number",
        "practice_category",
        "licence_number",
        "registration_state",
        "qualification",
        "specialization",
        "department",
        "available_for_home_visit",
        "if_yes_time_slots",
        "video_call_time_slot",
        "location",
        "visiting_hours",
        "employee_bank_name",
        "bank_account_holder_name",
        "bank_account_type",
        "bank_account_number",
        "bank_ifsc_code",
        "bank_branch",
        "bank_city",
        "reference_name",
        "employee_profile",
        "gst_certificate",
        "upload_pan_card_attachment",
        "registration_docs",
        "upload_other_documents",
        "admin_id",
        "trash"
    ];
}
