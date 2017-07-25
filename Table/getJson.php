<?php

session_start();



if($_SESSION["name_login"]!=null){

	$Json="";  
	$cid="";
	$cid=$_POST["search"];
	$response_Token=""; 
	
	Get_token();
	
}


	

	function Get_token(){
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_PORT => "5000",
			CURLOPT_URL => "http://localhost:5000/connect/token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "grant_type=password&username=alice&password=alice",
			CURLOPT_HTTPHEADER => array(
				"authorization: Basic cm9jbGllbnQ6c2VjcmV0",
				"cache-control: no-cache",
				"content-type: application/x-www-form-urlencoded"
			),
		));

		$response_Token = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$json_a = json_decode($response_Token, true);
			//echo $json_a['access_token'];
			$access_tokenval = $json_a['access_token'];
			Get_PHR($access_tokenval);
		}  
	}       


	//**************************************************************    
	function Get_PHR($token){
		$curl = curl_init();
		global $cid;
		global $Json; 
		curl_setopt_array($curl, array(
			CURLOPT_PORT => "5001",
			CURLOPT_URL => "http://localhost:5001/identity/".$cid,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"authorization: Bearer ".$token,
				"cache-control: no-cache",
				"content-type: application/x-www-form-urlencoded",
				"postman-token: b775b168-3150-23ae-b78d-317c2592b1c1"
			),
		));

		$val_return="";    
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$Json=$response;
			//		echo $Json;
		}
	}

	$return_Json=$Json;
	print_r($return_Json);






?> 