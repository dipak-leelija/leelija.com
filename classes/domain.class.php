<?php 
// require_once "_config/dbconnect.php";
/**
*	This class is going to work with all Domain associated with a Domain category. 
*
*	UPDATE Oct 17, 2018:
*	New function has been added to display product price in different format in runtime. The 
*	coder or implementor would be able to change the rendering style in runtime.
*
* 
*/


class Domain extends DatabaseConnection{

	#####################################################################################################
	#
	#										Domain Table
	#
	#####################################################################################################
	
	// 			Add New Domain
	/**
	*	Add a new domain in domain table. It also adds data in blog niche details
	*
	*	@param
	*			$id						Domain id
	*			$domain					Domain Name
	*			$niche					domain Niche
	*			$da						domain authority 
	*			$pa						Page Authority
	*			$cf						Citation Flow 
	*			$tf						Trust Flow
	*			$alexa_traffic			Alexa Traffic
	*			$organic_traffic		Organic Traffic
	*			$price					Domain Price
	*			$durl					Domain Url
	*			$dimage					Domain Screen Shot
	*			$selling_status			Domain Selling Status
	*			$approved				Domain Approved
	*
	*	@return int
	*/
	function addDomain($domain, $niche, $da, $dr,$pa, $cf, $tf, $alexa_traffic, $organic_traffic, $price, $sprice, $durl,
						 $selling_status, $seo_url, $approved, $added_by)
						
	{
		$domain				=	addslashes(trim($domain));
		$niche				=	addslashes(trim($niche)); 
		$da					=	addslashes(trim($da));
		$dr					=	addslashes(trim($dr));
		$pa					=	addslashes(trim($pa));
		$cf					=	addslashes(trim($cf));
		$tf					=	addslashes(trim($tf));
		$alexa_traffic		=	addslashes(trim($alexa_traffic));
		$organic_traffic	=	addslashes(trim($organic_traffic));
		$price				=	addslashes(trim($price));
		$sprice				=	addslashes(trim($sprice));
		$durl				=	addslashes(trim($durl));
		$selling_status		=	addslashes(trim($selling_status));
		$seo_url			=	addslashes(trim($seo_url));
		$approved			=	addslashes(trim($approved));
		$added_by			=	addslashes(trim($added_by));
		//satement to insert in product table
		$sql	=   "INSERT INTO domains
						(domain,niche,da,pa,cf, 
						tf, alexa_traffic,organic_traffic, price, sprice, durl,selling_status, seo_url,
						approved, added_by, added_on)
						VALUES
						('$domain','$niche','$da','$pa','$cf',
						'$tf','$alexa_traffic','$organic_traffic', '$price', '$sprice', '$durl','$selling_status', '$seo_url'
						,'$approved', '$added_by', now())
						";
		
		//execute query
		//execute query
		$query = $this->conn->query($sql);
		//echo $sql.$this->conn->error;exit;
		// echo $query;exit;
		//get the primary key
		$id		= $this->conn->insert_id;
		
		//return the blog_id
		return $id;
		
	}//eof
	
	
	/**
	*	Update 	blog_mst
	*
	*	@update	feb 23 2016
	*
	*	
	*
	*	@param
	*			$id						Domain Id
	*			$id						Domain id
	*			$domain					Domain Name
	*			$niche					domain Niche
	*			$da						domain authority 
	*			$pa						Page Authority
	*			$cf						Citation Flow 
	*			$tf						Trust Flow
	*			$alexa_traffic			Alexa Traffic
	*			$organic_traffic		Organic Traffic
	*			$price					Domain Price
	*			$durl					Domain Url
	*			$dimage					Domain Screen Shot
	*	@return int
	*/
	function updateDomain($id, $domain, $niche, $da, $dr, $pa, $cf, $tf, $alexa_traffic, $organic_traffic, $price, $durl,
						  $modified_by){
		$id					=	addslashes(trim($id));
		$domain				=	addslashes(trim($domain));
		$niche				=	addslashes(trim($niche));
		$da					=	addslashes(trim($da));
		$dr					=	addslashes(trim($dr));
		$pa					=	addslashes(trim($pa));
		$cf					=	addslashes(trim($cf));
		$tf					=	addslashes(trim($tf));
		$alexa_traffic		=	addslashes(trim($alexa_traffic));
		$organic_traffic	=	addslashes(trim($organic_traffic));
		$price				=	addslashes(trim($price));
		$durl				=	addslashes(trim($durl));
		$modified_by		=	addslashes(trim($modified_by));
		
		//statement
		$sql	= "UPDATE domains SET
				  domain			='$domain',
				  niche				='$niche',
				  da				='$da',
				  dr				='$dr',
				  pa 				='$pa',
				  cf				='$cf',
				  tf				='$tf',
				  alexa_traffic		='$alexa_traffic',
				  organic_traffic	='$organic_traffic',
				  price				='$price',
				  durl				='$durl',
				  modified_on 		= now(),
				  modified_by		='$modified_by'
				  WHERE 
				  id 				= '$id'
				  ";
				  
		//execute query
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;
		//echo $sql;exit;
		$result = '';
		if(!$query){
			$result = "ER001";
		}else{
			$result = "SU001";
		}
		
		//return the result
		return $result;
	}//eof

	
	/**
	*	Get the data associated with a domains based upon the primary key
	*
	*	@param
	*			$id		Domain Id
	*
	*	@return array				
	*/
	function showDomainsById($id){
		//declare vars
		$data = array();
		$query	= $this->conn->query("SELECT * FROM domains WHERE id = '$id'");
		//echo $select.mysql_error();exit;
		while($result = $query->fetch_assoc()){
			// $data  = array(
			// 		$result->domain,			//0
			// 		$result->niche,				//1
			// 		$result->da,				//2
			// 		$result->pa,				//3
			// 		$result->cf,				//4
			// 		$result->tf,				//5
			// 		$result->alexa_traffic,		//6
			// 		$result->organic_traffic,	//7
			// 		$result->price,				//8
			// 		$result->durl,				//9
			// 		$result->dimage,			//10
			// 		$result->selling_status,	//11
			// 		$result->approved,			//12
			// 		$result->added_by,			//13
			// 		$result->added_on,			//14
			// 		$result->modified_by,		//15
			// 		$result->modified_on,		//16
			// 		$result->sprice,			//17
			// 		$result->seo_url,			//18
			// 		$result->id     			//19
			// 		);
			$data = $result;
		}
		return $data;
		
	}//eof
	
	/**
	*	Get the data associated with a domains based upon the primary key
	*
	*	@param
	*			$seo_url		SEO Url
	*
	*	@return array				
	*/
	function getDomainBySEOURL($seo_url){
		//declare vars
		$data = array();
		
		//statement
		$select = "SELECT * 
				   FROM 
				   domains 
				   WHERE 
				   seo_url		= '$seo_url'
				   ";
				   
		//execute query
		$query = $this->conn->query($select);
		//holds the data
		while($result = $query->fetch_object())
		{
			$data  = array(
					$result->domain,			//0
					$result->niche,				//1
					$result->da,				//2
					$result->pa,				//3
					$result->cf,				//4
					$result->tf,				//5
					$result->alexa_traffic,		//6
					$result->organic_traffic,	//7
					$result->price,				//8
					$result->durl,				//9
					$result->dimage,			//10
					$result->selling_status,	//11
					$result->approved,			//12
					$result->added_by,			//13
					$result->added_on,			//14
					$result->modified_by,		//15
					$result->modified_on,		//16
					$result->sprice,			//17
					$result->seo_url,			//18
					$result->id     			//19
					);
		}
		//print_r($data);
		//return the data
		return $data;
		
	}//eof
	
	//seller wise Domain display
	function productSoldBySeller($productId, $added_by){

     	$res = "SELECT * FROM domains 
						WHERE 
						id = '$productId'
						AND
						added_by = '$added_by' 
						order by id desc "
						or die($res.$this->conn->error);

		// echo $res.$this->conn->error;exit;
		$query	= $this->conn->query($res);
     	$rows = $query->num_rows;
		 if ($rows > 0) {
			 while($result = $query->fetch_array()) {
				 $temp_arr[] =$result;
				}
				return $temp_arr;  
			}
     }
	 


	 //User wise Domain display
	function ShowUserDomainData($added_by){

		$res = "SELECT * FROM domains where added_by ='$added_by' order by id desc " or die($res.$this->conn->error);
	   // echo $res.$this->conn->error;exit;
	   $query	= $this->conn->query($res);
		$rows = $query->num_rows;
		if ($rows > 0) {
			while($result = $query->fetch_array()) {
				$temp_arr[] =$result;
			   }
			   return $temp_arr;  
		   }
	}


	 //Domain display
	function ShowBlogItems(){

		$res = "SELECT * FROM domains order by id desc ";
		$query = $this->conn->query($res);
		while($row = $query->fetch_object()) {
			 $temp_arr[] =$row;
		}
		return json_encode($temp_arr);

	}//eof
	
	 //Display Domain as as Limited
	 public function ShowlimitedData($limit){
	
		$res = "SELECT * FROM `domains` WHERE `selling_status` = '1' order by `da`  DESC LIMIT $limit";
		$resQuery    = $this->conn->query($res);
		$rows = $resQuery->num_rows;
			if ($rows !=0) {
				while ($row  = $resQuery->fetch_array() ) {
					$temp_arr[] = $row;
				}
				return $temp_arr;
			}else {
				return 0;
			}
		}

	/**
	*	This function will check whether the username is already in use or not
	*
	*	@param
	*			$id 			User name or id
	*			$fieldName		Column Name
	*			$tableName 		Table to make query
	*
	*	@return string
	*/
	function duplicateDomain($url, $id=''){
		if (!empty($id)) {
			$select = "SELECT * FROM domains WHERE  durl = '$url' AND id <> $id";
		}else {	
			$select = "SELECT * FROM domains WHERE  durl = '$url'";
		}
		
		$query  = $this->conn->query($select);
		$rows   =  $query->num_rows;
		
		$msg = '';

		if($rows > 0 ){
			$msg = 'ER001';
		}
	
		return $msg;

	}//eof

	function changeStatus($domainId, $newStatus) {
		try {
			// Update the status
			$updateQuery = "UPDATE domains SET selling_status = ? WHERE id = ?";
			$updateStmt = $this->conn->prepare($updateQuery);
			if (!$updateStmt) {
				throw new Exception("Error preparing UPDATE statement: " . $this->conn->error);
			}
	
			$updateStmt->bind_param("si", $newStatus, $domainId);
			$result = $updateStmt->execute();
	
			if (!$result) {
				throw new Exception("Error updating status: " . $updateStmt->error);
			}
	
			$updateStmt->close();
	
			return true;
		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}
	

	// Function to toggle the status of a row
	function toggleSellingStatus($domainId) {
		$currentStatus = '-1';
		try {
			// Check the current status
			$query = "SELECT selling_status FROM domains WHERE id = ?";
			$stmt = $this->conn->prepare($query);
			if (!$stmt) {
				throw new Exception("Error preparing statement: " . $this->conn->error);
			}

			$stmt->bind_param("i", $domainId);
			$stmt->execute();
			$stmt->bind_result($currentStatus);
			$stmt->fetch();
			$stmt->close();

			// Toggle the status
			$newStatus = $currentStatus == 1 ? 0 : 1;

			// Update the status
			$updated = $this->changeStatus($domainId, $newStatus);
			if ($updated) {
				return 'SU001';
			}else {
				return 'ER001';
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}



	function changeApproval($domainId, $approval) {
		try {
			// Update the status
			$updateQuery = "UPDATE domains SET approved = ? WHERE id = ?";
			$updateStmt = $this->conn->prepare($updateQuery);
			if (!$updateStmt) {
				throw new Exception("Error preparing UPDATE statement: " . $this->conn->error);
			}
	
			$updateStmt->bind_param("si", $approval, $domainId);
			$result = $updateStmt->execute();
	
			if (!$result) {
				throw new Exception("Error updating status: " . $updateStmt->error);
			}
	
			$updateStmt->close();
	
			return true;
		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}


	// Function to toggle the status of a row
	function toggleApproval($domainId) {
		$currentStatus = '-1';
		try {
			// Check the current status
			$query = "SELECT approved FROM domains WHERE id = ?";
			$stmt = $this->conn->prepare($query);
			if (!$stmt) {
				throw new Exception("Error preparing statement: " . $this->conn->error);
			}

			$stmt->bind_param("i", $domainId);
			$stmt->execute();
			$stmt->bind_result($currentStatus);
			$stmt->fetch();
			$stmt->close();

			// Toggle the status
			$approval = $currentStatus == 1 ? 0 : 1;

			// Update the status
			$updated = $this->changeApproval($domainId, $approval);
			if ($updated) {
				return 'SU001';
			}else {
				return 'ER001';
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	#####################################################################################################
	#
	#										Domain Featurds
	#
	#####################################################################################################
	
	
	
	/**
	*	Add a new domain featued in domain_featured table. 
	*
	*	@param
	*			$id						Domain featued id
	*			$domain_id				Domain Id
	*			$featured				Domain Featured 
	*			
	*
	*	@return int
	*/
	function addDomainFeatured($domain_id, $featured){
		
		$domain_id						=	addslashes(trim($domain_id));
		$featured						=	addslashes(trim($featured));
		//$added_on						=	addslashes(trim($added_on));
		//satement to insert in product table
		$sql	=   "INSERT INTO domain_featured
						(domain_id,featured,added_on)
						VALUES
						('$domain_id','$featured',now())
						";
		//execute query
		$query = $this->conn->query($sql);
		if ($query) {
			return 'SU001';
		}else {
			return 'ER001';
		}
		
	}//eof
	
	
	// blog Niche details update
	function editDomainFeatured($id, $feature, $modified_on){

		$id									=	addslashes(trim($id));
		$featured							=	addslashes(trim($feature));
		$modified_on						=	addslashes(trim($modified_on));
		
		//statement
		$sql	= "UPDATE domain_featured SET
				  featured						='$featured',
				  modified_on 					= now()
				  WHERE 
				  id 							= '$id'
				  ";
				  
		//execute query
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;
		//echo $sql;exit;
		$result = '';
		if(!$query){
			$result = "ER001";
		}else{
			$result = "SU001";
		}
		
		//return the result
		return $result;
	}//eof


	/**
	 * This Funtions pass 4 parameters where 2 parameters are array
	 * These array parameters contains domain feature's id and the feature
	 *  # Each feature will be update which is contain in the ids array 
	 *  # If there is more existing features in the database excluding the existing ids of array
	 *  # Then the features will be deleted
	 *  # If there is more features value avilable in the array then Ids
	 *  # Then the features will be added to database as new feature/data
	 * 
	 *  $itemId 	= itemID Means Domain id, which feature is updating
	 *  $ids    	= Feature primary key as ARRAY
	 * 	$features 	= Feature of the domain as ARRAY
	 */

	// blog Niche details update
	function updateDomainFeatured($itemId, array $ids, array $features, $modified_on=""){

		$feaureIdNos = count($ids);
		$feaureNos   = count($features);

		$idString = '';
		// Delete the features which are not required
		for ($i=0; $i <= $feaureIdNos-1 ; $i++) {
			$idString .= ' id <> '.$ids[$i];
			if ($i < $feaureIdNos-1) {
				$idString .= ' AND';
			}
		}
		
		$deleteSql = "DELETE FROM domain_featured WHERE domain_id = '$itemId' AND $idString";
		$delRes    = $this->conn->query($deleteSql);
		if (!$delRes) {
			return "Feature Updating Failed!";
		}


		// Domain Features Add
		for ($i = 0; $i < max($feaureNos, $feaureIdNos); $i++) {

			// Check if the current index is within the bounds of both arrays
			if ($i < $feaureIdNos && $i < $feaureNos) {
				// echo "Update Data: Both arrays have data at this index";
				$this->editDomainFeatured($ids[$i], $features[$i], $modified_on);

			}else {
				// echo "New Data: Only Feature has data at this index";
				$this->addDomainFeatured($itemId, $features[$i]);

			}
		}


	}//eof

	

	/**
	 * 
	 * Display domain features
	 * 
	 */
	function ShowDomainfeatures($domain_id){

		$sql = "SELECT * FROM domain_featured where domain_id	 = '$domain_id'";
	 	$query = $this->conn->query($sql);
		$rows = $query->num_rows;
		
		if ($rows > 0) {
			while($row = $query->fetch_object()) {
				$temp_arr[] =$row;
			}
			return json_encode($temp_arr);  
		}
		return json_encode(array());

	}//eof



	// blog Niche details update
	function domainSingleValueUpdate($id, $column, $value){

		$sql	= "UPDATE domains SET $column = '$value', modified_on = now() WHERE id = '$id' ";
		$query	= $this->conn->query($sql);
		$result = '';
		if(!$query){
			$result = "ER001";
		}else{
			$result = "SU001";
		}
		
		//return the result
		return $result;
	}//eof


}

?>