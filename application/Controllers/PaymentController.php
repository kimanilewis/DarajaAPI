<?php

Namespace Argila\ArgilaCoreAPI\Controllers;

use Argila\ArgilaCoreAPI\Config\StatusCodes;
use Argila\ArgilaCoreAPI\Models\Mpesa as Request;
use Argila\ArgilaCoreAPI\Models\customerProfiles as customerProfile;
use Argila\ArgilaCoreAPI\Models\customerAccounts as customerAccounts;
use Argila\ArgilaCoreAPI\Models\paymentRequests as payment;
use Argila\ArgilaCoreAPI\Models\sms_requests as sms;
use Argila\ArgilaCoreAPI\Utilities\SyncLogger as logger;
use Argila\ArgilaCoreAPI\Config\Config;
use Argila\ArgilaCoreAPI\Config\Validation;
use Argila\ArgilaCoreAPI\Utilities\Helpers as helpers;
use Argila\ArgilaCoreAPI\Utilities\CoreUtils as CoreUtils;
use Ubench as benchmark;
use Exception;

/**
 * This is the main services controller. Performs all CRUD funtionalitites
 * @author Lewis Kimani <kimanilewi@gmail.com>
 */
class PaymentController
{

    /**
     * * log class
     * */
    private $log;

    /**
     * benchmark class.
     */
    private $benchmark;
    private $coreUtils;
    private $helpers;
    private $balance = 0.0;
    private $newBCF = 0.0;

    function __construct() {
        $this->log = new logger();
        $this->benchmark = new benchmark();
        $this->coreUtils = new CoreUtils();
        $this->helpers = new helpers();
    }

    function processPaymentRequest($request) {
        $this->benchmark->start();
        $this->log->info(Config::info, -1,
            "Received processPaymentRequest request "
            . $this->log->printArray($request));
        $results = array();
        $response['accept'] = -1;
        $this->log->info(Config::info, -1,
            "Proceeding to validate  "
            . " processPaymentRequest request ");
        $validator = new Validation();
        /**
         * *********************************************************************
         * validate incoming datatypes, and verify required params are available
         */
        $rules = $validator->rules['mpesa_request'];
        $requestData = $request;
        $this->log->info(Config::info, -1,
            "Received processPaymentRequest data...."
            . $this->log->printArray($request));
        $statusDescription = "invalid parameters: ";
        $cardDetails = array();
        $sms_template = "";
//         $accountProfileDetails = 
       

        /*
         * *********************************************************************
         *  POST VALIDATION PROCESS
         * *********************************************************************
         * If there exist validation errors log the request and return else
         * log request and forward the same request to queue
         */
            return $response;
      
    }

    function initiateCheckoutSTK() {
        $this->benchmark->start();
        $results = array();
        $this->log->info(Config::info, -1,
            "Proceeding to initiate  "
            . "mpesa checkout request ");

        $transaction_id = rand(10000, 99999)
            . date(Config::DATE_TIME_FORMAT);
       // $reference_id = $params['customerProfileAccountID'];
        $amount = Config::COST_PER_UNIT;
        $phone = "254718668308";
        $callback = Config::MPESA_CALLBACK;

        $packet = array(
            "transaction_desc" => $transaction_id,
            "account_reference" => $transaction_id,
            "amount" => $amount,
            "msisdn" => $phone,
            "callback" => $callback
        );
        $this->log->info(Config::info, -1,
            "Request sent to initiate  "
            . "mpesa checkout request " . $this->log->printArray($packet));
        $response = $this->coreUtils->post(Config::CHECKOUT_STK_, $packet);
        $this->log->info(Config::info, -1,
            "Response from  "
            . "mpesa checkout request " . json_encode($response));
        $mpesaResponse = json_decode($response, TRUE);
        $this->log->info(Config::info, -1,
            "Response from  "
            . "mpesa checkout request array " . $this->log->printArray($mpesaResponse));
    }

}
