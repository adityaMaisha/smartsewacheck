<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class HospitalOther extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'hospitalandOther';
    protected $fillable = [
        "hospitalType",
        "hospitalFullName",
        "hospitalDisplayName",
        "establisementDate",
        "login_email",
        "shortBrief",
        "speciality",
        'roleType',
        "care",
        "contact_details_designation1",
        "shortBrief1",
        "department1",
        "contact_details_name1",
        "contact_details_email1",
        "contact_details_contact1",
        "helplineNumber",
        "emergencyContact",
       "AddressCountry",
       "AddressState",
       "AddressCity",
       "addressPinCode",
       "AddressLandmark",
       "AddressLatitude",
       "AddressLongitude",
       "full_address","pan_card_no",
       "address_proof",
       "upload_pan",
       "upload_id",
       "upload_other",
        "numberOfAmbulance",
       "pickupDropFaclity",
       "inHousePathLab",
       "radiolgyDiagnostics",
       "remoteCare",
       "numberPatientDayInOpd",
       "numberOfBedsInTotal",
       "numberOfGeneralWards",
       "numberOfIcu",
       "numberOfPrivateRooms",
       "numberOfSemiPriavateRooms",
       "numberOfBedsINEmergencyNumberOfDepartments",
       "numberOfClinics",
       "bloodBankAvailableOrNot",
       "numberOfDoctorsOnRoll",
       "categoryOfFacility",
       "contact_details_name",
       "contact_details_email",
       "contact_details_contact",
       "bank_name",
       "holder_name",
       "account_type",
       "acount_number",
       "acount_number_confirmation",
       "bacnk_ifsc_code",
       "bank_branch",
       "bank_city",
       "brand_color_primary",
       "brand_color_secondary",
       "hospital_logo",
       "banner_picture",
       "shortBrief",
       "logo",
       "bannerImage",
        "status",
        'trash'
    ];
}
