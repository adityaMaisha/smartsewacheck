<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Client_Wallet extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'client_wallet'; 
    protected $fillable = [
        'vendor_id',
        'merchant_id',
        'merchant_access_code',
        'unique_merchant_txn_id',
        'pine_pg_txn_status',
        'txn_completion_date_time',
        'amount_in_paisa',
        'txn_response_code',
        'txn_response_msg',
        'acquirer_name',
        'pine_pg_transaction_id',
        'captured_amount_in_paisa',
        'refund_amount_in_paisa',
        'payment_mode',
        'masked_card_number',
        'udf_field_1',
        'udf_field_2',
        'udf_field_3',
        'udf_field_4',
        'card_holder_name',
        'salted_card_hash',
        'rrn',  
        'auth_code',        
        'parent_txn_status',
        'parent_txn_response_code',
        'parent_txn_response_message',
        'dia_secret',
        'dia_secret_type',
        'final_amt'
    ];
}
