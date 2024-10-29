<?php


$titles = $deps[$index]->getTitles();
$dates = $deps[$index]->getDates();
$links = $deps[$index]->getLinks();


// Initialize curl
$ch = curl_init();

// Set curl options
curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . $API_KEY,
    'Content-Type: application/json',
]);

for($i=0; $i<$count; $i++){
	// Notification data to be sent

	$notificationData = [
		'app_id' => $APP_ID,
		'headings' => ['en' => $deps[$index]->getSegment() . ' Ανακοίνωση'],
    		'contents' => ['en' => $titles[$i] ],
    		'included_segments' => [$deps[$index]->getSegment()],  // You can specify target segments here
		'data' => array('Link' => $links[$i], 'Date' => $dates[$i], 'Place' => 'Home'),
		'android_accent_color' => '800080',   // Optional: Set the notification accent color
    		'small_icon' => 'logo_trans'
	];


	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notificationData));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Execute the request and capture the response
	$response = curl_exec($ch);

	// Check if there was a curl error
	if ($response === false) {
    		// Handle curl error
    		//echo 'Curl error: ' . curl_error($ch);
	}else {
   		// Get the HTTP response status code
   		$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    		// Handle the response data based on the status code
    		if ($httpStatusCode === 200) {
        		// Success - Handle the response data here
        		$responseData = json_decode($response, true);
        		//var_dump($responseData);
    		}else {
        		// Error - Handle the error response here
        		//echo 'HTTP Error Code: ' . $httpStatusCode . PHP_EOL;
        		//echo 'Error Response: ' . $response;
    		}
	}
	//sleep(5);
}


// Close the curl session
curl_close($ch);
?>