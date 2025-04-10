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
		'code' => '1000.508b4a0beb47a6c7e31f9a45ce392695.0af7b539c509d3d940ba1b29c04d2952',
		'client_id' => '1000.GJID0QNTYO9JNY8Q318PDVBYNCKMGI',
		'client_secret' => '0f7011664ed2569194f62ec95d838599955faa4dc6',
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