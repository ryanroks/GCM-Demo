<?php

/*
	Simplest implementation of
	Google Cloud Messaging System.
*/

class GCM {
	
	private $google_api_key = "";//Your Google API Key
	
	function __contructor() {
		//Your code here if needed
		}
	
	public function sendPushNotification($regIds, $message) {
	
		$postfields = json_encode(array(
            'registration_ids' => $regIds,
            'data' => array("price" => $message),
			));
 
        $headers = array(
            'Authorization: key=' . $this->google_api_key,
            'Content-Type: application/json'
			);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
		
		}

	function __destructor() {
		//Your code here if needed
		}
		
	}
	
$gcm = new GCM();

//Populate with as many Device Registration IDs as needed
$regIds = array();
	
$message = "Message text";
	
$data = $gcm->sendPushNotification($regIds, $message);

print_r($data);

?>