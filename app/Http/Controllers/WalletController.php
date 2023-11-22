<?php

namespace App\Http\Controllers;

use App\Models\Client_recharge;
use App\Models\Client_Wallet;
use App\Models\FailedPaymentModel;
use App\Models\Wallet_history;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function wallet_details(Request $request, $vendor_id)
    {
        $currentDate = Carbon::now();
        $data['vendor_id'] = $vendor_id;
        $data['wallet_sum'] = Client_Wallet::where('vendor_id', 'SSVENDOR1122')->sum('wallet_amt');
        // $data['curr_month_wallet_sum'] = Client_Wallet::where('vendor_id', 'SSVENDOR1122')->where('created_at', $currentDate->format('Y-m-d'))->sum('wallet_amt');
        $data['wallet_data'] = Client_Wallet::where('vendor_id', 'SSVENDOR1122')->get();
        $data['transaction_data'] = Wallet_history::where('vendor_id', 'SSVENDOR1122')->get();
        return view('admin.wallet.wallet_details', $data);
    }

    public function add_money_in_wallet(Request $request)
    {

        $amt = $request->amount;

        $final_amt = $amt * 100;
        $uniqueId = (uniqid(mt_rand(), true));
        $ord = 'SMART' . substr($uniqueId, 0, 5);
        //$url = 'https://stage-webapp.paytm.in/peon.php';
        $url = 'http://127.0.0.1:8000/return_payment';
        $jsonData = '{
        "merchant_data": {
            "merchant_id": 107249,
            "merchant_access_code": "8212304e-59b4-446c-97ba-17b30d8afb18",
            "merchant_return_url": "' . $url . '",
            "unique_merchant_txn_id": "' . $ord . '"
        },
        "customer_data": {},
        "payment_data": {
            "amount_in_paisa": "' . $final_amt . '"
        },
        "txn_data": {
            "navigation_mode": 2,
            "payment_mode": "1,3,4,10,11",      
            "transaction_type": 1
        }
        }';

        $data = json_decode($jsonData, true);
        $base64Encoded = base64_encode($jsonData);

        $secret_key = "691B610A72B844C98FD40D487073E17F";

        function Hex2String($hex)
        {
            $string = '';
            for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
                $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
            }

            return $string;
        }

        $secret_key = Hex2String($secret_key);
        $strFormdata = $base64Encoded;
        $hash = strtoupper(hash_hmac('sha256', $strFormdata, $secret_key));

        $apiUrl = 'https://uat.pinepg.in/api/v2/accept/payment';

        $data = array(
            'request' => $base64Encoded, // Use the base64 encoded data
        );

        $headers = array(
            'Content-Type: application/json',
            'X-VERIFY: ' . $hash, // Use the hash you generated
        );

        $ch = curl_init($apiUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        // Handle the response as needed
        $res_decode =  json_decode($response);
        $url = $res_decode->redirect_url;
        return redirect()->to($url);
        //header("location:" . $url);

    }

    public function return_payment()
    {
        
        // $data = new Client_Wallet([
        // 'vendor_id' => 'SV1122',
        // 'merchant_id' => $_REQUEST['merchant_id'],
        // 'merchant_access_code' => $_REQUEST['merchant_access_code'],
        // 'unique_merchant_txn_id' => $_REQUEST['unique_merchant_txn_id'],
        // 'pine_pg_txn_status' => $_REQUEST['pine_pg_txn_status'],

        // 'txn_completion_date_time' => $_REQUEST['txn_completion_date_time'],

        // 'amount_in_paisa' => $_REQUEST['amount_in_paisa'],

        // 'txn_response_code' => $_REQUEST['txn_response_code'],

        // 'txn_response_msg' => $_REQUEST['txn_response_msg'],

        // 'acquirer_name' => $_REQUEST['acquirer_name'],

        // 'pine_pg_transaction_id' => $_REQUEST['pine_pg_transaction_id'],
        // 'captured_amount_in_paisa' => $_REQUEST['captured_amount_in_paisa'],
        // 'refund_amount_in_paisa' => $_REQUEST['refund_amount_in_paisa'],
        // 'payment_mode' => $_REQUEST['payment_mode'],
        // 'masked_card_number' => $_REQUEST['masked_card_number'],
        // 'udf_field_1' => $_REQUEST['udf_field_1'],
        // 'udf_field_2' => $_REQUEST['udf_field_2'],
        // 'udf_field_3' => $_REQUEST['udf_field_3'],
        // 'udf_field_4' => $_REQUEST['udf_field_4'],
        // 'card_holder_name' => $_REQUEST['card_holder_name'],
        // 'salted_card_hash' => $_REQUEST['salted_card_hash'],
        // 'rrn' => $_REQUEST['rrn'],
        // 'auth_code' => $_REQUEST['auth_code'],
        // 'parent_txn_status' => $_REQUEST['parent_txn_status'],
        // 'parent_txn_response_code' => $_REQUEST['parent_txn_response_code'],
        // 'parent_txn_response_message' => $_REQUEST['parent_txn_response_message'],
        // 'dia_secret' => $_REQUEST['dia_secret'],
        // 'dia_secret_type' => $_REQUEST['dia_secret_type'],
        // ]);

        $data = new Client_recharge();
        $data->vendor_id = 'SSVENDOR1122';
        $data->merchant_id = $_REQUEST['merchant_id'] ?? NULL;
        $data->service_id = 'SSER1122';
        $data->merchant_access_code = $_REQUEST['merchant_access_code'] ?? NULL;
        $data->unique_merchant_txn_id = $_REQUEST['unique_merchant_txn_id'] ?? NULL;
        $data->pine_pg_txn_status = $_REQUEST['pine_pg_txn_status'] ?? NULL;
        $data->txn_completion_date_time = $_REQUEST['txn_completion_date_time'] ?? NULL;
        $data->amount_in_paisa = $_REQUEST['amount_in_paisa'] ?? NULL;
        $data->txn_response_code = $_REQUEST['txn_response_code'] ?? NULL;
        $data->txn_response_msg = $_REQUEST['txn_response_msg'] ?? NULL;
        $data->acquirer_name = $_REQUEST['acquirer_name'] ?? NULL;
        $data->pine_pg_transaction_id = $_REQUEST['pine_pg_transaction_id'] ?? NULL;
        $data->captured_amount_in_paisa = $_REQUEST['captured_amount_in_paisa'] ?? NULL;

        $data->refund_amount_in_paisa = $_REQUEST['refund_amount_in_paisa'] ?? NULL;
        $data->payment_mode = $_REQUEST['payment_mode'] ?? NULL;
        $data->masked_card_number = $_REQUEST['masked_card_number'] ?? NULL;
        $data->udf_field_1 = $_REQUEST['udf_field_1'] ?? NULL;
        $data->udf_field_2 = $_REQUEST['udf_field_2'] ?? NULL;
        $data->udf_field_3 = $_REQUEST['udf_field_3'] ?? NULL;
        $data->udf_field_4 = $_REQUEST['udf_field_4'] ?? NULL;

        $data->card_holder_name = $_REQUEST['card_holder_name'] ?? NULL;
        $data->salted_card_hash = $_REQUEST['salted_card_hash'] ?? NULL;
        $data->rrn = $_REQUEST['rrn'] ?? NULL;

        $data->auth_code = $_REQUEST['auth_code'] ?? NULL;
        $data->parent_txn_status = $_REQUEST['parent_txn_status'] ?? NULL;
        $data->parent_txn_response_code = $_REQUEST['parent_txn_response_code'] ?? NULL;
        $data->parent_txn_response_message = $_REQUEST['parent_txn_response_message'] ?? NULL;
        $data->dia_secret = $_REQUEST['dia_secret'] ?? NULL;

        $data->dia_secret_type = $_REQUEST['dia_secret_type'] ?? NULL;
        $data->final_amt = $_REQUEST['amount_in_paisa'] / 100 ?? NULL;


        if ($_REQUEST['txn_response_code'] == 1 && $_REQUEST['txn_response_msg'] == 'SUCCESS') {
            if ($data->save()) {
                $sum_pre_amt = Client_Wallet::where('vendor_id', 'SSVENDOR1122')->sum('wallet_amt');
                $client_wallet = new Client_Wallet();
                $client_wallet->vendor_id = 'SSVENDOR1122';
                $client_wallet->wallet_id = 'SSWALLET1122';
                $client_wallet->wallet_mode = 'Recharge';
                $client_wallet->service_id = 'SSER1122';
                $client_wallet->unique_merchant_txn_id = $_REQUEST['unique_merchant_txn_id'];
                $client_wallet->wallet_amt = $total_amt =  $_REQUEST['amount_in_paisa'] / 100;
                $client_wallet->added_date = date('Y-m-d : H:i');

                if ($client_wallet->save()) {
                    $client_wallet_history = new Wallet_history();
                    $client_wallet_history->vendor_id = 'SSVENDOR1122';
                    $client_wallet_history->wallet_id = 'SSWALLET1122';
                    $client_wallet_history->wallet_mode = 'Recharge';
                    $client_wallet_history->service_id = 'SSER1122';
                    $client_wallet_history->pre_wallet_amt = $sum_pre_amt;
                    $client_wallet_history->current_wallet_amt = $sum_pre_amt + $total_amt;
                    $client_wallet_history->added_wallet_amt = $total_amt;
                    $client_wallet_history->added_date = date('Y-m-d : H:i');
                    $client_wallet_history->save();
                }
            }
            return redirect()->to('dashboard-page');
        } else {
            $failed_pay = new FailedPaymentModel();
            $failed_pay->vendor_id = 'SSVENDOR1122';
            $failed_pay->merchant_id = $_REQUEST['merchant_id'] ?? NULL;
            $failed_pay->service_id = 'SSER1122';
            $failed_pay->merchant_access_code = $_REQUEST['merchant_access_code'] ?? NULL;
            $failed_pay->unique_merchant_txn_id = $_REQUEST['unique_merchant_txn_id'] ?? NULL;
            $failed_pay->pine_pg_txn_status = $_REQUEST['pine_pg_txn_status'] ?? NULL;
            $failed_pay->txn_completion_date_time = $_REQUEST['txn_completion_date_time'] ?? NULL;
            $failed_pay->amount_in_paisa = $_REQUEST['amount_in_paisa'] ?? NULL;
            $failed_pay->txn_response_code = $_REQUEST['txn_response_code'] ?? NULL;
            $failed_pay->txn_response_msg = $_REQUEST['txn_response_msg'] ?? NULL;
            $failed_pay->acquirer_name = $_REQUEST['acquirer_name'] ?? NULL;
            $failed_pay->pine_pg_transaction_id = $_REQUEST['pine_pg_transaction_id'] ?? NULL;
            $failed_pay->captured_amount_in_paisa = $_REQUEST['captured_amount_in_paisa'] ?? NULL;

            $failed_pay->refund_amount_in_paisa = $_REQUEST['refund_amount_in_paisa'] ?? NULL;
            $failed_pay->payment_mode = $_REQUEST['payment_mode'] ?? NULL;
            $failed_pay->masked_card_number = $_REQUEST['masked_card_number'] ?? NULL;
            $failed_pay->udf_field_1 = $_REQUEST['udf_field_1'] ?? NULL;
            $failed_pay->udf_field_2 = $_REQUEST['udf_field_2'] ?? NULL;
            $failed_pay->udf_field_3 = $_REQUEST['udf_field_3'] ?? NULL;
            $failed_pay->udf_field_4 = $_REQUEST['udf_field_4'] ?? NULL;

            $failed_pay->card_holder_name = $_REQUEST['card_holder_name'] ?? NULL;
            $failed_pay->salted_card_hash = $_REQUEST['salted_card_hash'] ?? NULL;
            $failed_pay->rrn = $_REQUEST['rrn'] ?? NULL;

            $failed_pay->auth_code = $_REQUEST['auth_code'] ?? NULL;
            $failed_pay->parent_txn_status = $_REQUEST['parent_txn_status'] ?? NULL;
            $failed_pay->parent_txn_response_code = $_REQUEST['parent_txn_response_code'] ?? NULL;
            $failed_pay->parent_txn_response_message = $_REQUEST['parent_txn_response_message'] ?? NULL;
            $failed_pay->dia_secret = $_REQUEST['dia_secret'] ?? NULL;

            $failed_pay->dia_secret_type = $_REQUEST['dia_secret_type'] ?? NULL;
            $failed_pay->final_amt = $_REQUEST['amount_in_paisa'] / 100 ?? NULL;
            
            if($failed_pay->save())
            {
                return redirect()->to('dashboard-page');
            }

            return view('admin.wallet.wallet_details', $data);
        }
    }
}
