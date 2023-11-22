<?php

namespace App\Http\Controllers;

use App\Models\Client_recharge;
use App\Models\FailedPaymentModel;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    public function end_customer_payment()
    {
        return view('admin.payment.end_customer_payment');
    }

    public function business_clients_payment()
    {
        $data['success_payment'] = Client_recharge::where('vendor_id', 'SSVENDOR1122')->where('txn_response_code','1')->get();
        $data['failed_payment'] = FailedPaymentModel::where('vendor_id', 'SSVENDOR1122')->where('txn_response_code','!=','1')->get();
        return view('admin.payment.business_client_payment',$data);
    }
}
