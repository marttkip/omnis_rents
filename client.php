<?php
	
if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit(0);
}

class Web_service
{
	public function get_data($service_url, $fields)
	{
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		
		// a. initialize
		try{
			$ch = curl_init();
			
			// b. set the options, including the url
			curl_setopt($ch, CURLOPT_URL, $service_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, count($fields));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			
			// c. execute and fetch the resulting HTML output
			$output = curl_exec($ch);
			
			//in the case of an error save it to the database
			if ($output === FALSE) 
			{
				$response['result'] = 0;
				$response['message'] = curl_error($ch);
				
				$return = json_encode($response);
			}
			
			else
			{
				$return = $output;
			}
		}
		
		//in the case of an exceptions save them to the database
		catch(Exception $e)
		{
			$response['result'] = 0;
			$response['message'] = $e->getMessage();
			
			$return = json_encode($response);
		}
		
		return $return;
	}
}

$new = new Web_service;
// call the controller
$base_url = 'https://www.omnis.co.ke/property/';

////////////////////////////////// Function Step 0: Test ////////////////////////////////////////\\

/*$fields = array
(
	'mpesa_data' => urlencode("KJV64IAUGS Confirmed. on 31/10/16 at 11:58 AM Ksh12,800.00 received from ONGUTI KIREKI 254720712679.  Account Number 13 New Utility balance is Ksh12,800.00")
	//'mpesa_data' => urlencode("KK164WR6EI Confirmed.Your M-PESA balance was  Ksh359.93  on 1/11/16 at 3:40 PM. Buy goods with M-PESA.")
);

$service_url = $base_url.'sync-mpesa-payment';
$response = $new->get_data($service_url, $fields);

echo $response;*/

////////////////////////////////// Function Step 1: Sync Mpesa Payments ////////////////////////////////////////\\
if (isset($_POST["Sync"]))
{
	$fields = array(
		'mpesa_data' => urlencode($_POST['phone_message'])
	);
	
	$service_url = $base_url.'sync-mpesa-payment';
    $response = $new->get_data($service_url, $fields);
    
    echo $response;
}