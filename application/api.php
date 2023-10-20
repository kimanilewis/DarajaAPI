<?php

// Function to process payment using another API
function processPayment($mobileNumber, $amount) {
    // URL of the external API endpoint
    $apiEndpoint = "https://example.com/payment"; // Replace with the actual API endpoint URL

    // Data to be sent in the request
    $postData = array(
        'mobileNumber' => $mobileNumber,
        'amount' => $amount
    );

    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "BusinessShortCode": 174379,
    "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMxMDAzMTI0NzU1",
    "Timestamp": "20231003124755",
    "TransactionType": "CustomerPayBillOnline",
    "Amount": 5,
    "PartyA": 254718668308,
    "PartyB": 174379,
    "PhoneNumber": "254718668308",
    "CallBackURL": "https://mydomain.com/path",
    "AccountReference": "Safari Power",
    "TransactionDesc": "Payment of X" 
  }',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer AEScvqupzMH7XG76VRh3AqAD4xkl',
    'Content-Type: application/json',
    'Cookie: incap_ses_1024_2742146=pqXRer2IdGHdQl2fnPs1DsbeG2UAAAAA32+YHy3So9mujiULshoc8w==; visid_incap_2742146=OaNx+hLQSrecC6MpWrdwEybSG2UAAAAAQUIPAAAAAACpEDrQs/y96uQIU8PZ3WjF'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

    // Return the response from the external API
    return $response;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $_SERVER;
    // Get mobile number and amount from the request
    $mobileNumber = $_POST['mobileNumber'];
    $amount = $_POST['amount'];

    // Validate mobile number and amount (add your validation logic here)

    // Process payment using the external API
    $paymentResponse = processPayment($mobileNumber, $amount);

    // Return the response from the external API as JSON
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'success', 'message' => 'Payment processed successfully', 'response' => $paymentResponse));
} else {
    // If the request method is not POST, return an error response
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}

?>
