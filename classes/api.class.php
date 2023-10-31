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
    
}

?>