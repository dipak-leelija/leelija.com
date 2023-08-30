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
*
*
*	@author		Safikul Islam
*	@date		Oct 17, 2018
*	@update		
*	@version	3.0
*	@copyright	WebTechHelp
*	@url		https://webtechhelp.org
*	@email		safikulislamwb@gmail.com
* 
*/


class Domain extends DatabaseConnection
{

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
	function addDomain($domain, $niche, $da, $pa, $cf, $tf, $alexa_traffic, $organic_traffic, $price, $sprice, $durl,
						 $selling_status, $seo_url, $approved, $added_by)
						
	{
		$domain				=	addslashes(trim($domain));
		$niche				=	addslashes(trim($niche)); 
		$da					=	addslashes(trim($da));
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
	*			$selling_status			Domain Selling Status
	*			$approved				Domain Approved
	*	@return int
	*/
	function editDomain($id, $domain,$niche, $da, $pa, $cf, $tf, $alexa_traffic,$organic_traffic, $price, $durl,
						 $selling_status, $approved, $modified_by){
		$id					=	addslashes(trim($id));
		$domain				=	addslashes(trim($domain));
		$niche				=	addslashes(trim($niche));
		$da					=	addslashes(trim($da));
		$pa					=	addslashes(trim($pa));
		$cf					=	addslashes(trim($cf));
		$tf					=	addslashes(trim($tf));
		$alexa_traffic		=	addslashes(trim($alexa_traffic));
		$organic_traffic	=	addslashes(trim($organic_traffic));
		$price				=	addslashes(trim($price));
		$durl				=	addslashes(trim($durl));
		$selling_status		=	addslashes(trim($selling_status));
		$approved			=	addslashes(trim($approved));
		$modified_by		=	addslashes(trim($modified_by));
		
		//statement
		$sql	= "UPDATE domains SET
				  domain			='$domain',
				  niche				='$niche',
				  da				= '$da',
				  pa 				='$pa',
				  cf				='$cf',
				  tf				='$tf',
				  alexa_traffic		='$alexa_traffic',
				  organic_traffic	='$organic_traffic',
				  price				='$price',
				  durl				='$durl',
				  selling_status	='$selling_status',
				  approved			='$approved',
				  updated_on 		= now(),
				  modified_by		='$modified_by'
				  WHERE 
				  id 				= '$id'
				  ";
				  
		//execute query
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		//echo $sql;exit;
		$result = '';
		if(!$query)
		{
			$result = "ER102";
		}
		else
		{
			$result = "SU102";
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
	function ShowDomainData(){

		$res = "SELECT * FROM domains order by id desc ";
		$query = $this->conn->query($res);
		while($row = $query->fetch_array()) {
			 $temp_arr[] =$row;
	
		 }
		 return $temp_arr;
	
		 }
	
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
	function addDomainFeatured($domain_id, $featured)
	{
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
		//echo $sql.$this->conn->error;exit;
		//get the primary key
		$id		= $this->conn->insert_id;
		
		//return the blog_niche_id
		return $id;
		
	}//eof
	
	
	// blog Niche details update
	function editDomainFeatured($id,$featured, $modified_on){

		$id									=	addslashes(trim($id));
		$featured							=	addslashes(trim($featured));
		$modified_on						=	addslashes(trim($modified_on));
		
		//statement
		$sql	= "UPDATE domain_featured SET
				  featured						='$featured',
				  modified_on 					= now()
				  WHERE 
				  id 							= '$id'
				  ";
				  
		//execute query
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		//echo $sql;exit;
		$result = '';
		if(!$query)
		{
			$result = "ER102";
		}
		else
		{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof

	
	
	//  Display Blog Niches
	public function ShowDfeaturedData(){
     $temp_arr = array();
     $res = mysql_query("SELECT * FROM domain_featured order by added_on desc") or die(mysql_error());        
     $count=mysql_num_rows($res);
    while($row = mysql_fetch_array($res)) {
         $temp_arr[] =$row;
     }
     return $temp_arr;  
     }
	
	/*// 
		* Display domain featured
	*///
	public function ShowDfeattwo($domain_id	){
    //  $temp_arr = array();
     $res = "SELECT * FROM domain_featured where domain_id	 = '$domain_id'";
	 $query = $this->conn->query($res);
	$rows = $query->num_rows;
    //  $count=mysql_num_rows($res);
	if ($rows > 0) {
		while($row = $query->fetch_array()) {
			$temp_arr[] =$row;
		}
		return $temp_arr;  
		}
	}
}

?>	
	