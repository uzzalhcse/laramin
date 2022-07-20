<?php

namespace App\Http\Services\Payment\Ekpay;

use App\Http\Controllers\ApiController;
use App\Models\IPCP\PaymentHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends ApiController
{

    public function payNow(Request $request)
    {

        try {
//            $licenseApplication = LicenseApplication::findOrFail($request->appId);

            $fee_amount = 500;
            $vat_amount = 15;
            $total_fee = $fee_amount + $vat_amount;

            $total_product = 1;

            /** @var  $total_fee */
            $total_fee = $total_fee * $total_product;

            /** @var  $company */
//            $company = Company::where('id', $licenseApplication->company_id)->first();

            /** @var  $appId */
            $appId = 1299;
            $userInfo['id'] = 15;
            $userInfo['app_id'] = $appId;
            $userInfo['mobile'] = '+8801764673691';
            $userInfo['email'] = 'uzzalh.me@gmail.com';
            $userInfo['address'] = 'Dhaka';
            $userInfo['name'] = 'Uzzal Hosen';

            $paymentInfo['trID'] = $appId . rand(10000000, 99999999999);
            $paymentInfo['amount'] = $total_fee;
            $paymentInfo['orderID'] = $appId . date('ymdhis');


            //Insert Payment History/
//            PaymentHistory::savePaymentHistory($userInfo, $paymentInfo);

            $activeDebug = true;

            /** @var  $token */
            $token = $this->ekPayPaymentGateway($userInfo, $paymentInfo, $activeDebug);
            if (!empty($token)) {
//                $token = 'https://sandbox.ekpay.gov.bd/ekpaypg/v1?sToken=' . $token . '&trnsID=' . $paymentInfo['trID'];
                $token = config('services.payment_gateway.url.token_url') . '?sToken=' . $token . '&trnsID=' . $paymentInfo['trID'];
            }


            return response()->redirectTo($token);
        } catch (\Exception $exception) {
            return response()->json([
                'msg' => $exception->getMessage()
            ]);
        }
    }

    public function ekPayPaymentGateway($userInfo, $paymentInfo, $activeDebug = false)
    {

        /*$marchantID = 'eporcha_test';
        $marchantKey = 'EprCsa@tST12';*/

        /*$marchantID = 'nise_test';
        $marchantKey = 'NiSe@TsT11';*/

//        $marchantID = 'judiciary_test';
//        $marchantKey = 'juD@test1621';

        $marchantID = config('services.payment_gateway.marchantID');
        $marchantKey = config('services.payment_gateway.marchantKey');


        $mac_addr = config('services.mac_address');
        $applicationURL = url('/');

        $time = Carbon::now()->format('Y-m-d H:i:s');

        $customerCleanName = preg_replace('/[^A-Za-z0-9 \-\.]/', '', $userInfo['name']);

        $appid = $userInfo['app_id'];
        $data = '{
           "mer_info":{
              "mer_reg_id":"' . $marchantID . '",
              "mer_pas_key":"' . $marchantKey . '"
           },
           "req_timestamp":"' . $time . ' GMT+6",
           "feed_uri":{
              "s_uri":"' . 'http://localhost:1010/payment/success/' . $appid . '",
              "f_uri":"' . $applicationURL . '/payment/fail/' . $appid . '",
              "c_uri":"' . $applicationURL . '/payment/cancel/' . $appid . '"
           },
           "cust_info":{
              "cust_id":"' . $userInfo['id'] . '",
              "cust_name":"' . $customerCleanName . '",
              "cust_mobo_no":"' . $userInfo['mobile'] . '",
              "cust_email":"' . $userInfo['email'] . '",
              "cust_mail_addr":"' . $userInfo['address'] . '"
           },
           "trns_info":{
              "trnx_id":"' . $paymentInfo['trID'] . '",
              "trnx_amt":"' . $paymentInfo['amount'] . '",
              "trnx_currency":"BDT",
              "ord_id":"' . $paymentInfo['orderID'] . '",
			  "ord_det":"Pesticide application fee"
           },
           "ipn_info":{
              "ipn_channel":"1",
              "ipn_email":"imiladul@gmail.com",
              "ipn_uri":"' . $applicationURL . '/api/ipn-handler"
           },
           "mac_addr":"' . $mac_addr . '"
        }';


        /*$url = 'https://sandbox.ekpay.gov.bd/ekpaypg/v1/merchant-api';*/
        /** @var  $url */
        $url = config('services.payment_gateway.url.marchant_url');

        if ($activeDebug) {
            Log::debug("Youth Name: " . $userInfo['name'] . ' , Youth Enroll ID: ' . $paymentInfo['orderID']);
            Log::debug($data);
        }
        try {
            // Setup cURL
            $ch = \curl_init($url);
            \curl_setopt_array($ch, array(
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_HTTPHEADER => array(
                    //'Authorization: '.$authToken,
                    'Content-Type: application/json'
                ),
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0
            ));

            // Send the request
            $response = \curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $exception) {
            //ipnLog("Curl request failed." . $exception->getMessage());
        }

        // Decode the response
        $responseData = json_decode($response, TRUE);
        return $responseData['secure_token'];
    }


    public function getChallanToken()
    {
        $url = config('services.challan_geteway.challan_api.authenticate.url');
        $username = config('services.challan_geteway.username');
        $key = config('services.challan_geteway.key');

        $data = [
            "username" => $username,
            "key" => $key,
            "url" => $url
        ];
        $data = json_encode($data, true);

        try {
            // Setup cURL
            $ch = \curl_init($url);
            \curl_setopt_array($ch, array(
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_HTTPHEADER => array(
                    //'Authorization: '.$authToken,
                    'Content-Type: application/json'
                ),
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0
            ));

            // Send the request
            $response = \curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $exception) {
            //ipnLog("Curl request failed." . $exception->getMessage());
        }

        // Decode the response
        $responseData = json_decode($response, TRUE);
        return $responseData;
    }


    public function ipnHandler(Request $request)
    {
        if (!empty($request)) {
            Log::debug("=========================================");

            Log::debug("SandBox Request: ");
            Log::debug($request);

            Log::debug("=========================================");
        }

        Log::debug("=============Debug=============");
        Log::debug($request->msg_code);
        Log::debug($request->cust_info['cust_id']);
        Log::debug("===============================");


//        if ($request->msg_code == 1020) {
//            $youthCourseEnroll = YouthCourseEnroll::findOrFail($request->cust_info['cust_id']);
//
//
//            $newData['payment_status'] = YouthCourseEnroll::PAYMENT_STATUS_PAID;
//
//            if ($youthCourseEnroll->enroll_status == YouthCourseEnroll::ENROLL_STATUS_ACCEPT) {
//                $youthCourseEnroll->update($newData);
//            }
//
//            $mailSubject = "Your payment successfully complete";
//            $youthEmailAddress = $request->cust_info['cust_email'];
//            $mailMsg = "Congratulation! Your payment successfully completed.";
//            $youthName = $youthCourseEnroll->youth->name_en;
//            Mail::to($youthEmailAddress)->send(new \Module\CourseManagement\App\Mail\YouthPaymentSuccessMail($mailSubject, $youthCourseEnroll->youth->access_key, $mailMsg, $youthName));
//
//            return 'Payment successful';
//        }
//
//        $data['application_id'] = $request->cust_info['cust_id'];
//        $data['transaction_id'] = $request->trnx_info['trnx_id'];
//        $data['amount'] = $request->trnx_info['trnx_amt'];
//        $data['log'] = $request;
//        $data['payment_type'] = $request->pi_det_info['pi_type'];
//        $data['payment_date'] = \Illuminate\Support\Carbon::now();
//        $data['payment_status'] = $request->msg_code == 1020 ? '1' : '2';
//
//        $payment = new Payment();
//        $payment->fill($data);
//        $payment->save();
    }


    /**
     * @param $status
     * @param $appId
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function paymentStatus($status, $appId, Request $request)
    {
        try {
            if ($status) {
                // update payment history status

                if ($status == 'success') {
                    $vat = (int)config('application.vat');
                    $x = 500 * $vat;
                    $y = 100 + $vat;

                    $vat_amount = $x / $y;

//                        $vat_amount = ($paymentHistory->amount*$vat)/(100+$vat);

                    $credit_account_fee = config('services.challan_geteway.credit_account_fee');
                    $credit_account_vat = config('services.challan_geteway.credit_account_vat');

                    $url = config('services.challan_geteway.challan_api.create.url');

                    $data = [

                        "REQUEST_ID" => $request->transId,
                        "REF_NO" => $request->transId,
                        "TRAN_DATE" => date('Y-m-d', strtotime('2022-06-23')),
                        "APPLICANT_NAME" => 'Uzzal Hosen',
                        "REFERENCE_NAME" => 'Uzzal Hosen',
                        "MOBILE_NO" => '+8801764673690',
                        "ADDRESS" => '',
                        "PURPOSE" => 'Application fee of pesticide',
                        "TRANAMOUNT" => number_format(400, '2', '.', ''),
                        "PAY_TRXID" => $request->transId,
                        "CREDIT_INFO" => [
                            [
                                "SLNO" => 1,
                                "CREDIT_ACCOUNT" => $credit_account_fee,
                                "AMOUNT" => number_format(500 - $vat_amount, '2', '.', ''),
                            ],
                            [
                                "SLNO" => 2,
                                "CREDIT_ACCOUNT" => $credit_account_vat,
                                "AMOUNT" => number_format($vat_amount, '2', '.', '')
                            ]
                        ]
                    ];


                    $data = json_encode($data, true);
                    $token = $this->getChallanToken();
                    Log::info($token);

                    // Setup cURL
                    $ch = \curl_init($url);

                    \curl_setopt_array($ch, array(
                        CURLOPT_POST => TRUE,
                        CURLOPT_RETURNTRANSFER => TRUE,
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: ' . $token['jwt_token'],
                            'Content-Type: application/json'
                        ),
                        CURLOPT_POSTFIELDS => $data,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0
                    ));

                    // Send the request
                    $response = \curl_exec($ch);
                    $responseData = json_decode($response, TRUE);
                    curl_close($ch);
                    Log::info($responseData);

                    /*if ($responseData['STATUS'] == 200){*/
//                    DB::table('challan_api_histories')->insert([
//                        'date' => Carbon::now(),
//                        'company_id' => $paymentHistory->company_id,
//                        'application_id' => $paymentHistory->application_id,
//                        'tran_id' => $paymentHistory->trns_id,
//                        'request_data' => $data,
//                        'response' => $response,
//                        'status' => $responseData['STATUS'],
//                        'message' => $responseData['MESSAGE'],
//                    ]);
                }

            }


           return $responseData;
        } catch (\Exception $exception) {
            return response()->json([
                'msg' => $exception->getMessage()
            ]);
        }
    }


    public function regenerateChallanApi(Request $request)
    {
        try {
            $url = config('services.challan_geteway.challan_api.create.url');

            $data = DB::table('challan_api_histories')->where('id', $request->id)->first();
            if ($data) {
                $data = $data->request_data;
                $token = $this->getChallanToken();

                // Setup cURL
                $ch = \curl_init($url);

                \curl_setopt_array($ch, array(
                    CURLOPT_POST => TRUE,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . $token['jwt_token'],
                        'Content-Type: application/json'
                    ),
                    CURLOPT_POSTFIELDS => $data,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0
                ));

                // Send the request
                $response = \curl_exec($ch);
                $responseData = json_decode($response, TRUE);
                curl_close($ch);

                DB::table('challan_api_histories')->insert([
                    'date' => Carbon::now(),
                    'company_id' => 0,
                    'application_id' => 0,
                    'tran_id' => 0,
                    'request_data' => $data,
                    'response' => $response,
                    'status' => isset($responseData['STATUS']) ? $responseData['STATUS'] : '',
                    'message' => isset($responseData['MESSAGE']) ? $responseData['MESSAGE'] : '',
                ]);


                return 'Regenerated challan';
            }

            return 'Challan api history not found!';
        } catch
        (\Exception $exception) {
            return response()->json([
                'msg' => $exception->getMessage()
            ]);
        }
    }
}
