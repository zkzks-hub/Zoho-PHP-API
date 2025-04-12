<?php

class InsertRecords
{
	function __construct($data,$module_name,$access_t){
		$this->data=$data;
		$this->module= $module_name;
		$this->access_token= $access_t;		
		}
	
    public function execute(){
        $curl_pointer = curl_init();        
        $curl_options = array();
        
		$url = "https://www.zohoapis.com/crm/v2.1/".$this->module;        
        
		$curl_options[CURLOPT_URL] =$url;
        $curl_options[CURLOPT_RETURNTRANSFER] = true;
        $curl_options[CURLOPT_HEADER] = 1;
        $curl_options[CURLOPT_CUSTOMREQUEST] = "POST";
        $requestBody = array();
        $recordArray = array();
        
		$recordObject = array();
		$recordObject = $this->data;
        /*$recordObject["Company"]="FieldAPIValue";
        $recordObject["Last_Name"]="3477061000007420006";
        $recordObject["First_Name"]="3477061000007420006";
        $recordObject["State"]="FieldAPIValue";*/

        
        $recordArray[] = $recordObject;
        $requestBody["data"] =$recordArray;
        $curl_options[CURLOPT_POSTFIELDS]= json_encode($requestBody);
        $headersArray = array();
        
        $headersArray[] = "Authorization". ":" . "Zoho-oauthtoken " . $this->access_token;
        
        $curl_options[CURLOPT_HTTPHEADER]=$headersArray;       
        curl_setopt_array($curl_pointer, $curl_options);       
        $result = curl_exec($curl_pointer);
        $responseInfo = curl_getinfo($curl_pointer);
        curl_close($curl_pointer);
        list ($headers, $content) = explode("\r\n\r\n", $result, 2);
        if(strpos($headers," 100 Continue")!==false){
            list( $headers, $content) = explode( "\r\n\r\n", $content , 2);
        }
        $headerArray = (explode("\r\n", $headers, 50));
        $headerMap = array();
        foreach ($headerArray as $key) {
            if (strpos($key, ":") != false) {
                $firstHalf = substr($key, 0, strpos($key, ":"));
                $secondHalf = substr($key, strpos($key, ":") + 1);
                $headerMap[$firstHalf] = trim($secondHalf);
            }
        }
        $jsonResponse = json_decode($content, true);
        if ($jsonResponse == null && $responseInfo['http_code'] != 204) {
            list ($headers, $content) = explode("\r\n\r\n", $content, 2);
            $jsonResponse = json_decode($content, true);
        }
	/*	echo "<pre>";
        var_dump($headerMap);
        var_dump($jsonResponse);
        var_dump($responseInfo['http_code']);
       echo "</pre>";*/
 // Log the response to the error log
    error_log('HTTP Code: ' . $responseInfo['http_code']);
    error_log('Response Headers: ' . print_r($headerMap, true));
    error_log('Response Body: ' . json_encode($jsonResponse, JSON_PRETTY_PRINT));

    // Optionally, log any errors
    if (curl_errno($curl_pointer)) {
        error_log('CURL error: ' . curl_error($curl_pointer));
    }
    }
    
}
//(new InsertRecords())->execute();