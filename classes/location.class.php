<?php 
class Location extends DatabaseConnection{
	
	
	/**
	*	Retrieve all province data
	*	@return array
	*	@param	
	*			$id		id of the province
	*
	*/
	function getStateData($id){

		$data	= array();

		$sql	= "SELECT * FROM states WHERE id='$id'";
		$query	= $this->conn->query($sql);
		
		if($query->num_rows == 1){

			$result = $query->fetch_assoc();
			$data = $result;
						
		} 
		return $data;
	}//eof
	

	function getStateName($id){
		
		$result	= '';
		//create the statement
		$sql	= "SELECT name FROM states WHERE id='$id'";
		
		$query	= $this->conn->query($sql);
		if($query->num_rows == 1){
			$result = $query->fetch_assoc();
			$result = $result['name']; 
		} 
		return $result;
	}//eof

	
	
	/////////////////////////////////////////////////////////////////////////////////////
	//
	//								********** City ***********
	//
	////////////////////////////////////////////////////////////////////////////////////
	

	function getCityName($id){
		
		$result	= '';
		//create the statement
		$sql	= "SELECT name FROM cities WHERE id='$id'";
		
		$query	= $this->conn->query($sql);
		if($query->num_rows == 1){
			$result = $query->fetch_assoc();
			$result = $result['name']; 
		} 
		return $result;
	}//eof


	/**
	*	Retrieve all cities data
	*	@return array
	*	@param
	*/
	function getAllCity(){

		$data	= array();
		$sql	= "SELECT * FROM cities ORDER BY city ASC";
		$query	= $this->conn->query($sql);
		
		if($query->num_rows > 0){
			while($result = $query->fetch_array()){
				$data[] = $result;
			}
		}
		return $data;
	}//eof


	
	/**
	*	Retrieve all town data and city data
	*	@return array
	*	@param	
	*			$id		id of the city
	*
	*/
	function getCityDataById($id){
		
		$data	= array();
		//create the statement
		$sql	= 	"SELECT * FROM cities WHERE  id = '$id'";
		
		$query	= $this->conn->query($sql);
		
		if($query->num_rows == 1)
		{
			$result = $query->fetch_assoc();
			
			$data = $result;
		} 
		return $data;
	}//eof
	
	
	//////////////////////////////////////////////////////////////////////////////////////
	//																					//
	//							  ********** COUNTRY ***********						//
	//																					//
	//////////////////////////////////////////////////////////////////////////////////////
	
		/**
	*	Retrieve all town data and county data
	*	@return array
	*	@param	
	*			$id		id of the county
	*
	*/
	function getCountryById($id)
	{
		$data	= array();
		$sql	= 	"SELECT * 
					 FROM countries
					 WHERE id = '$id'";
		$query	= $this->conn->query($sql);
		
		if($query->num_rows == 1)
		{
			$result = $query->fetch_assoc();
			
			$data = $result;
						
		} 
		return $data;
	}//eof
	
	
	function getCountryName($id){

		$sql	= 	"SELECT name 
					 FROM countries
					 WHERE id = '$id'";
		$query	= $this->conn->query($sql);
		
		if($query->num_rows == 1){
			$result = $query->fetch_assoc();
			$result = $result['name']; 						
			return $result;
		}
		return;
	}//eof

	
	////////////////////////////////////////////////////////////////////////////////////////////
	//
	//				***************		Populating Dropdowns   *******************
	//
	////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	*	Generating county dropdowns
	*
	*	@date 	November 22, 2006
	*
	*	@param
	*			$cid	Country id
	*
	*	@return null
	*/
	function genProvinceList($cid)
	{
		//statement
		$select		= "SELECT 		* 
					   FROM 		province 
					   WHERE 		countries_id='$cid' 
					   ORDER BY 	province_name";
		
		//execute query
		$query		= mysql_query($select);
		//echo $select.mysql_error();exit;
		
				
		if(mysql_num_rows($query) > 0)
		{
			
			echo "
				  <label>State</label>
				  <select name='txtProvinceId' id='txtProvinceId' class='text-field' onChange='getCountyList()'>
					<option value='0'>-- Select One --</option>";
			while($result	= 	mysql_fetch_array($query))
			{
				$province_id		= $result['province_id'];
				$province_name		= $result['province_name'];
				
				echo "<option value='".$result['province_id']."'>".
						$result['province_name'].
					 "</option>";
					 
				
			}
			echo "</select>
			<div class='cl'></div>";

		}
		else
		{
			//statement
			$select		= "SELECT 		* 
						   FROM 		county 
						   WHERE 		countries_id='$cid' 
						   ORDER BY 	county_name";
			
			//execute query
			$query		= mysql_query($select);
			if(mysql_num_rows($query) > 0)
			{
				
				echo "
					  <label>District</label>
					  <select name='txtCountyId' id='txtCountyId' class='text-field' onChange='getTownList()'>
						<option value='0'>-- Select One --</option>";
				while($result	= 	mysql_fetch_array($query))
				{
					$province_id		= $result['county_id'];
					$province_name		= $result['county_name'];
					
					echo "<option value='".$result['county_id']."'>".
							$result['county_name'].
						 "</option>";
						 
					
				}
				echo "</select>
				<div class='cl'></div>";
			}
			
			else
			{
				//statement
				$select		= "SELECT 		* 
							   FROM 		town 
							   WHERE 		countries_id='$cid' 
							   ORDER BY 	town_name";
				
				//execute query
				$query		= mysql_query($select);
				if(mysql_num_rows($query) > 0)
				{
					
					echo "
						  <label>Town/Village</label>
						  <select name='txtTownId' id='txtTownId' class='text-field' onChange='getAltTown()'>
							<option value='0'>-- Select One --</option>";
					while($result	= 	mysql_fetch_array($query))
					{
						$province_id		= $result['town_id'];
						$province_name		= $result['town_name'];
						
						echo "<option value='".$result['town_id']."'>".
								$result['town_name'].
							 "</option>";
							 
						
					}
					echo "	<option value='0'>-- Add Town --</option>";
					echo "</select>
					<div class='cl'></div>";
				}
				else
				{
					echo "
						  <label>Town/Village</label>
						  <select name='txtTownId' id='txtTownId' class='text-field' onChange='getAltTown()'>
							<option value='0'>-- Select One --</option>";

					echo "	<option value='0'>-- Add Town --</option>";
					echo "</select>
					<div class='cl'></div>";
				}
			}
		}
		
	}//eof
	
	
	/**
	*	Generating county dropdowns
	*
	*	@date 	November 22, 2006
	*
	*	@param
	*			$cid	Country id
	*
	*	@return null
	*/
	function genProvinceList2($cid)
	{
		//statement
		$select		= "SELECT 		* 
					   FROM 		province 
					   WHERE 		countries_id='$cid' 
					   ORDER BY 	province_name";
		
		//execute query
		$query		= mysql_query($select);
		//echo $select.mysql_error();exit;
		
				
		if(mysql_num_rows($query) > 0)
		{
			
			echo "<label>State</label>
				  <div class='label-cl'></div>
				  <div class='select-container'>
				  <select name='txtProvinceId' id='txtProvinceId' class='text-field fancy' onChange='getCountyListByProvince()'>
					<option value='0'>-- Select One --</option>";
			while($result	= 	mysql_fetch_array($query))
			{
				$province_id		= $result['province_id'];
				$province_name		= $result['province_name'];
				
				echo "<option value='".$result['province_id']."'>".
						$result['province_name'].
					 "</option>";
					 
				
			}
			echo "</select>
			</div>";
				echo "<div class='cl'></div>";
		}
		else
		{
			//statement
			$select		= "SELECT 		* 
						   FROM 		county 
						   WHERE 		countries_id='$cid' 
						   ORDER BY 	county_name";
			
			//execute query
			$query		= mysql_query($select);
			if(mysql_num_rows($query) > 0)
			{
				
				echo "<label>District</label>
					  <div class='label-cl'></div>
				  	  <div class='select-container'>
					  <select name='txtCountyId' id='txtCountyId' class='text-field fancy' onChange='getTownList()'>
						<option value='0'>-- Select One --</option>";
				while($result	= 	mysql_fetch_array($query))
				{
					$province_id		= $result['county_id'];
					$province_name		= $result['county_name'];
					
					echo "<option value='".$result['county_id']."'>".
							$result['county_name'].
						 "</option>";
						 
					
				}
				echo "</select>
				</div>";
					echo "<div class='cl'></div>";
			}
			
			else
			{
				//statement
				$select		= "SELECT 		* 
							   FROM 		town 
							   WHERE 		countries_id='$cid' 
							   ORDER BY 	town_name";
				
				//execute query
				$query		= mysql_query($select);
				if(mysql_num_rows($query) > 0)
				{
					
					echo "<label>Town/Village</label>
						  <div class='label-cl'></div>
				  			<div class='select-container'>
						  <select name='txtTownId' id='txtTownId' class='text-field fancy' onChange='getAltTown()'>
							<option value='0'>-- Select One --</option>";
					while($result	= 	mysql_fetch_array($query))
					{
						$province_id		= $result['town_id'];
						$province_name		= $result['town_name'];
						
						echo "<option value='".$result['town_id']."'>".
								$result['town_name'].
							 "</option>";
							 
						
					}
					echo "	<option value='0'>-- Add Town --</option>";
					echo "</select>
					</div>";
				}
				else
				{
					echo "<label>Town/Village</label>
						  <div class='label-cl'></div>
				  			<div class='select-container'>
						  <select name='txtTownId' id='txtTownId' class='text-field fancy' onChange='getAltTown()'>
							<option value='0'>-- Select One --</option>";

					echo "	<option value='0'>-- Add Town --</option>";
					echo "</select>
					</div>";
						echo "<div class='cl'></div>";
				}
			}
		}
			
		
		
	}//eof
	
	
	
	/**
	*	Generating county dropdowns
	*
	*	@date 	November 22, 2006
	*
	*	@param
	*			$pid	Province id
	*			$cid	Countries id
	*
	*	@return null
	*/
	function genCountyListByProvince($pid)
	{

		$select		= "SELECT 		* 
					   FROM 		county 
					   WHERE 		province_id='$pid' 
					   ORDER BY 	county_name";


		
		//execute query
		$query		= mysql_query($select);
		//echo $select.mysql_error();exit;
		
				
		if(mysql_num_rows($query) > 0)
		{
			
			echo "<label>District</label>
			  	<div class='label-cl'></div>
				<div class='select-container'>
			  <select name='txtCountyId' id='txtCountyId' class='text-field fancy' onChange='getTownList()'>
				<option value='0'>-- Select One --</option>";
				
			while($result	= 	mysql_fetch_array($query))
			{
				$county_id		= $result['county_id'];
				$county_name	= $result['county_name'];
				
				echo "<option value='".$result['county_id']."'>".
						$result['county_name'].
					 "</option>";
			}
			echo "</select>
			</div>";
			echo "<div class='cl'></div>";
		}
		else
		{
			$select		= "SELECT 		* 
						   FROM 		town 
						   WHERE 		province_id='$pid' 
						   ORDER BY 	town_name";
	
	
			
			//execute query
			$query		= mysql_query($select);
			if(mysql_num_rows($query) > 0)
			{
				
				echo "<label>Town/Village</label>
					  <div class='label-cl'></div>
					  <div class='select-container'>
					  <select name='txtTownId' id='txtTownId' class='text-field fancy' onChange='getAltTown()'>
						<option value='0'>-- Select One --</option>";
				while($result	= 	mysql_fetch_array($query))
				{
					$province_id		= $result['town_id'];
					$province_name		= $result['town_name'];
					
					echo "<option value='".$result['town_id']."'>".
							$result['town_name'].
						 "</option>";
						 
					
				}
				echo "	<option value='0'>-- Add Town --</option>";
				echo "</select>
				</div>";
					echo "<div class='cl'></div>";
			}
			else
			{
				echo "<label>Town/Village</label>
					  <div class='label-cl'></div>
					  <div class='select-container'>
					  <select name='txtTownId' id='txtTownId' class='text-field fancy' onChange='getAltTown()'>
						<option value='0'>-- Select One --</option>";

				echo "	<option value='0'>-- Add Town --</option>";
				echo "</select>
				</div>";
					echo "<div class='cl'></div>";
			}
		}
			
		
		
	}//eof
	
	
	
	
	/**
	*	Generating county dropdowns
	*
	*	@date 	November 22, 2006
	*
	*	@param
	*			$pid	Province id
	*
	*	@return null
	*/
	function genCountyList3($pid)
	{
		//statement
		$select		= "SELECT 		* 
					   FROM 		county 
					   WHERE 		province_id='$pid' 
					   ORDER BY 	county_name";
		
		//execute query
		$query		= mysql_query($select);
		//echo $select.mysql_error();exit;
		if(mysql_num_rows($query) > 0)
		{
			while($result	= 	mysql_fetch_array($query))
			{
				$county_id		= $result['county_id'];
				$county_name	= $result['county_name'];
				
				echo "<li value='".$county_id."' class='menuText' id='menuText".$county_id."'>".
				$county_name."</li>";
				
				/*echo "<option value='".$result['county_id']."'>".
						$result['county_name'].
					 "</option>";*/
			}
		}
			
		echo "</select>";
		
	}//eof
	
	
	
	/**
	*	Generating town dropdowns
	*
	*	@date 	December 4, 2006
	*
	*	@param
	*			$cid	County id
	*			$pid	Province id
	*
	*	@return null
	*/
	function genTownList($cid)
	{
		//statement
		$select		= "SELECT 		* 
					   FROM 		town 
					   WHERE 		county_id='$cid' 
					   ORDER BY 	town_name";

					   
		//execute query
		$query		= mysql_query($select);
		//echo $select.mysql_error();exit;
		
		
				
		if(mysql_num_rows($query) > 0)
		{
			echo "<label>Town / Village</label>
			<div class='label-cl'></div>";
			echo "<select name='txtTownId' id='txtTownId' onChange='getAltTown()' class='text-field'>
				<option value='0'>-- Select One --</option>";//
			while($result	= 	mysql_fetch_array($query))
			{
				$town_id		= $result['town_id'];
				$town_name	= $result['town_name'];
				
				echo "<option value='".$result['town_id']."' class='menuText'>".
						$result['town_name'].
					 "</option>";
				
			}
			echo "	<option value='0'>-- Add Town --</option>";
			echo "</select>";
			echo "<div class='cl'></div>";
		}
		else
		{
			echo "<label>Town / Village</label>
			<div class='label-cl'></div>";
			
			echo "<select name='txtTownId' id='txtTownId' onChange='getAltTown()' class='text-field'>
				<option value='0'>-- Select One --</option>";//

			echo "	<option value='0'>-- Add Town --</option>";
			echo "</select>";
			echo "<div class='cl'></div>";
		}
			
		
	}//eof
	
	
	/**
	*	Generating town dropdowns
	*
	*	@date 	December 4, 2006
	*
	*	@param
	*			$cid	County id
	*			$pid	Province id
	*
	*	@return null
	*/
	function genTownListByCounty($cid)
	{
		//statement
		$select		= "SELECT 		* 
					   FROM 		town 
					   WHERE 		county_id='$cid' 
					   ORDER BY 	town_name";

					   
		//execute query
		$query		= mysql_query($select);
		//echo $select.mysql_error();exit;
		
		
				
		if(mysql_num_rows($query) > 0)
		{
			echo "<label>Town / Village</label>
			<div class='label-cl'></div>
			<div class='select-container'>";
			echo "<select name='txtTownId' id='txtTownId' onChange='getAltTown()' class='text-field fancy'>
				<option value='0'>-- Select One --</option>";//
			while($result	= 	mysql_fetch_array($query))
			{
				$town_id		= $result['town_id'];
				$town_name	= $result['town_name'];
				
				echo "<option value='".$result['town_id']."' class='menuText'>".
						$result['town_name'].
					 "</option>";
				
			}
			echo "	<option value='0'>-- Add Town --</option>";
			echo "</select>
			</div>";
			echo "<div class='cl'></div>";
		}
		else
		{
			echo "<label>Town / Village</label>
			<div class='label-cl'></div>
			<div class='select-container'>";
			echo "<select name='txtTownId' id='txtTownId' onChange='getAltTown()' class='text-field fancy'>
				<option value='0'>-- Select One --</option>";//

			echo "	<option value='0'>-- Add Town --</option>";
			echo "</select>
			</div>";
			echo "<div class='cl'></div>";
		}
		
			
		
	}//eof
	
	/*------------------------------------------------------------------------------------------------------
	|																										|
	|												Address Printing 										|
	|																										|
	|-------------------------------------------------------------------------------------------------------*/



	/**
	 * Use this array as input of this function to print the full address
	 * 	$addressArr = array(
	 * 			'address1' => '',
	 * 			'address2' => '',	
	 * 			'address3' => '',
	 *			'city' => '',
	 *			'state' => '',
	 *			'country' => '',
	 *			'zipcode' => ''
	 *	);
	 */
	function printAddress($addrArr) {
		$parts = array(
			'address1' => isset($addrArr['address1']) ? $addrArr['address1'] : '',
			'address2' => isset($addrArr['address2']) ? $addrArr['address2'] : '',
			'address3' => isset($addrArr['address3']) ? $addrArr['address3'] : '',
			'city' 	   => isset($addrArr['city']) ? $addrArr['city'] : '',
			'state'    => isset($addrArr['state']) ? $addrArr['state'] : '',
			'country'  => isset($addrArr['country']) ? $addrArr['country'] : '',
			'zipcode'  => isset($addrArr['zipcode']) ? $addrArr['zipcode'] : '',
		);

		$addressString = '';

		if (!empty($parts['address1'])) {
		$addressString .= $parts['address1'];
		}

		if (!empty($parts['address2'])) {
		if (!empty($addressString)) {
		$addressString .= ', ';
		}
		$addressString .= $parts['address2'];
		}

		if (!empty($parts['address3'])) {
		$addressString .= $parts['address3'];
		if (!empty($addressString)) {
		$addressString .= ', ';
		}
		}

		if (!empty($parts['city'])) {
		if (!empty($addressString)) {
		$addressString .= ', ';
		}
		$addressString .= $parts['city'];
		}

		if (!empty($parts['state'])) {
		if (!empty($addressString)) {
		$addressString .= ', ';
		}
		$addressString .= $parts['state'];
		}

		if (!empty($parts['country'])) {
		if (!empty($addressString)) {
		$addressString .= ', ';
		}
		$addressString .= $parts['country'];
		}

		if (!empty($parts['zipcode'])) {
		if (!empty($addressString)) {
		$addressString .= ', ';
		}
		$addressString .= $parts['zipcode'];
		}

		echo $addressString;

	}
	
	// printAddress($address);
	
	
	
	
}
?>