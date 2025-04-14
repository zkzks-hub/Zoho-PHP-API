<?php
//Scope=ZohoCRM.modules.all,ZohoCRM.modules.custom.all

// Initialize cURL session for token request
$curl=curl_init('https://accounts.zoho.com/oauth/v2/token');
// Set cURL options
curl_setopt_array($curl,array(
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_POSTFIELDS => http_build_query(
		array(
		'code' => 'YOUR_CODE',
		'client_id' => 'CLIENT_ID',
		'client_secret' => 'CLIENT_SECRET',
		'grant_type' => 'authorization_code'
		)
	),
	CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded')
)
);

// Execute cURL session and get the response
$response = curl_exec($curl);
// Close cURL session to free up resources
curl_close($curl);

// Output raw response
echo $response;
// Separate raw output and JSON output
echo "<hr>";
// Decode JSON response to associative array
$response = json_decode($response, true);
// Pretty-print JSON response
echo "<pre>".json_encode($response, JSON_PRETTY_PRINT)."</pre>";
?>
