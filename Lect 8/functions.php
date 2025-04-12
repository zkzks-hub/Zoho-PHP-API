<?php

///////////////////////////////////////////////////////////////////////////////////////////////

include get_template_directory() . '/zoho-api/create-record.php';
include get_template_directory() . '/zoho-api/access-token.php';

add_action("wpcf7_before_send_mail",function($contact_form, &$abort, $submission){
$name=$submission->get_posted_data('yname');
$email=$submission->get_posted_data('yemail');
$subhect=$submission->get_posted_data('ysubject');
$message=$submission->get_posted_data('ymessage');

$access_token=generateAccessToken();
$data=array(
"Last_Name"=>$name,
"Company"=>"test",
"Email"=>$email
);
$create_new_record = new InsertRecords($data,"Leads",$access_token);
$create_new_record->execute();
},10,3);