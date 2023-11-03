<?php
class API{

    /*****************************************************************************
	*																			 *
	*									API REQUESTS							 *
	*																			 *
	*****************************************************************************/

	function callApi($reqURL){

		// $url = "http://localhost/api/customer.php/customerId/".$cusId;
		
		// Fetch the API response
		$response = file_get_contents($reqURL);
		
		// Process the API response (e.g., decode JSON)
		return json_decode($response);
	}
    
	function addCustomer($firstName, $lastName, $email, $password, $password_cnf, $country, $profession, $addedOn){

		$apiUrl = 'https://api.leelija.com/api/customer.php';

		// Data to be sent in the POST request as JSON
		$postData = array(
			'firstName'     => $firstName,
			'lastName'      => $lastName,
			'email'         => $email,
			'password'      => $password,
			'password_cnf'  => $password_cnf,
			'country'       => $country,
			'profession'    => $profession,
			'added_on'      => $addedOn
		);
	
		// Convert the data array to JSON
		$jsonData = json_encode($postData);
	
		// Initialize cURL session
		$ch = curl_init($apiUrl);
	
		// Set cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
	
		// Set the Content-Type header to indicate JSON data
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	
		// Execute the cURL request
		$response = curl_exec($ch);
	
		// Check for cURL errors
		if (curl_errno($ch)) {
			echo json_encode(['error' => 'cURL error: ' . curl_error($ch)]);
		}
		// else {
		// 	// Check HTTP status code
		// 	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// 	if ($httpCode !== 200) {
		// 		echo  json_encode(['error' => 'HTTP error: ' . $httpCode]);
		// 	}
		// }
	
		// Close cURL session
		curl_close($ch);
	
		// Output the response from the API
		return $response;
	
	}
}

?>