<?php
function generateAccessToken(){
$post=array(
	'refresh_token' => '1000.fe7c22d82877997d6d7ca60bfda6e253.5ad7cb35de57743d58bb716374146f75',
	'client_id' => '1000.GJID0QNTYO9JNY8Q318PDVBYNCKMGI',
	'client_secret' => '0f7011664ed2569194f62ec95d838599955faa4dc6',
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
?>