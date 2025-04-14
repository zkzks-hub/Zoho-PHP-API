<?php
function generateAccessToken(){
$post=array(
	'refresh_token' => 'YOUR_REFRESH_TOKEN',
	'client_id' => 'CLIENT_ID',
	'client_secret' => 'CLIENT_SECRET',
	'grant_type' => 'refresh_token',
);
$ch=curl_init();

curl_setopt($ch,CURLOPT_URL,"https://accounts.zoho.com/oauth/v2/token");

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($post));

curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0);

curl_setopt($ch,CURLOPT_HTTPHEADER ,array('Content-Type: application/x-www-form-urlencoded'));

$response = curl_exec($ch);

$response =json_decode($response);

curl_close($ch);

return $response->access_token;

}


//var_dump( generateAccessToken());

echo generateAccessToken();
?>
