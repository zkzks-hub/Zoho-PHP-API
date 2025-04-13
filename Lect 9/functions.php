////////////////////////////////////////////////////////////////////////////////////////////////////
function run_on_thank_you_redirect(){
	
	if(is_page('thank-you-redirect')){
		/*echo "Hello World";
		echo $_GET['Last_Name'];
		echo $_GET['Email'];*/
		$access_token=generateAccessToken();
		$create_new_record = new InsertRecords($_GET,"Leads",$access_token);
		$create_new_record->execute();
	}//else{
		//echo "Goodbye";
	//}

}//end function

add_action('wp_head', 'run_on_thank_you_redirect');