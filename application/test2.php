
<?php

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
    "PartyA": 254718583299,
    "PartyB": 174379,
    "PhoneNumber": "254718668308",
    "CallBackURL": "https://mydomain.com/path",
    "AccountReference": "CompanyXLTD",
    "TransactionDesc": "Payment of X" 
  }',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer Xi385RA3ncqPMzatTYwUGHV7OpZE',
    'Content-Type: application/json',
    'Cookie: incap_ses_1024_2742146=pqXRer2IdGHdQl2fnPs1DsbeG2UAAAAA32+YHy3So9mujiULshoc8w==; visid_incap_2742146=OaNx+hLQSrecC6MpWrdwEybSG2UAAAAAQUIPAAAAAACpEDrQs/y96uQIU8PZ3WjF'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
