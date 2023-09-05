<?php 


class Services extends DatabaseConnection{

	

	#####################################################################################################
	#
	#										Services Type
	#
	#####################################################################################################
	/**

	*	Add a new services type in service_cat table. 
	*
	*	@param
	*			$id							Services category id
	*			$cat_name					Services catagories name
	*			$desc						service desc
	*			
	*
	*	@return int
	*/

	function addServicesCat($cat_name, $desc, $added_by){

		$cat_name					=	addslashes(trim($cat_name));
		$desc						=	addslashes(trim($desc));
		$added_by					=	addslashes(trim($added_by));
		//satement to insert in service type table
		$sql	=   "INSERT INTO service_cat
						(cat_name,desc, added_by, added_on)
						VALUES
						('$cat_name','$desc', '$added_by', now())
						";
		//execute query
		//execute query
		$query = mysql_query($sql);
		//echo $sql.mysql_error();exit;
		//get the primary key
		$id		= mysql_insert_id();
		//return the service id
		return $id;
		
	}//eof

	

	

	// Services Type update
	function editServicesCat($id, $cat_name, $desc, $status, $modified_by){

		$id								=	addslashes(trim($id));
		$cat_name						=	addslashes(trim($cat_name));
		$desc							=	addslashes(trim($desc));
		$status							=	addslashes(trim($status));
		$modified_by					=	addslashes(trim($modified_by));
		
		//statement
		$sql	= "UPDATE service_cat SET
				  `cat_name`					='$cat_name',
				  `desc`						='$desc',
				  `status`						='$status',
				  `modified_by`					='$modified_by',
				  `modified_on` 				= now()
				  WHERE 
				  `id` 							= '$id'";

				  
		// echo $sql.$this->conn->error;exit;

		//execute query
		$query	= $this->conn->query($sql);
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
	*	Get service type information corresponding to a Services type and holds information in an array
	*	@return array
	*/
	function getServiceType($id){

		//declare var
		$data		= array();

		//statement
		$select     = "SELECT * FROM service_cat WHERE id='$id'";
		//echo $select;exit;

		//execute query
		$query      = $this->conn->query($select);

		if($query->num_rows > 0){

			//get the result set
			$result 	= $query->fetch_assoc();
			$data = $result;

		}

		//return the data
		return json_encode($data);

	}//eof

	

	//  Display Services Type
	public function ShowServicesCatData(){

		$res = "SELECT * FROM `service_cat` order by id ASC";

		$resQuery = $this->conn->query($res);

			while ($row  = $resQuery->fetch_assoc()){

				$temp_arr[] = $row;

			}

			return json_encode($temp_arr);

     }



	#####################################################################################################
	#
	#										Services Table
	#
	#####################################################################################################

	

	// 			Add New Services
	/**
	*	Add a new services in services table. It also adds data in services catagories details
	*
	*	@param
	*			$id						service id
	*			$service_cat_id			services type
	*			$service_name			service Name
	*			$service_desc			service desc
	*
	*	@return int
	*/

	function addServices($service_cat_id,$service_name, $service_desc,$page_title, $seo_url, $meta_title, $meta_tags, $meta_desc, $canonical, $sort_order, $added_by){

		$service_cat_id				=	addslashes(trim($service_cat_id));
		$service_name				=	addslashes(trim($service_name));
		$service_desc				=	addslashes(trim($service_desc));


		$page_title					=	addslashes(trim($page_title));
		$seo_url					=	addslashes(trim($seo_url));
		$meta_title					=	addslashes(trim($meta_title));
		$meta_tags					=	addslashes(trim($meta_tags));
		$meta_desc					=	addslashes(trim($meta_desc));
		$canonical					=	addslashes(trim($canonical));
		$sort_order					=	addslashes(trim($sort_order));
		$added_by					=	addslashes(trim($added_by));

		//satement to insert in services table
		$sql	=   "INSERT INTO services

						(service_cat_id,service_name,service_desc, page_title, seo_url, meta_title, meta_tags, meta_desc, canonical, sort_order, added_by, added_on)

						VALUES

						('$service_cat_id','$service_name','$service_desc', '$page_title', '$seo_url', '$meta_title', '$meta_tags', '$meta_desc', 

						'$canonical', '$sort_order', '$added_by', now())

						";

		//execute query

		//execute query

		$query = mysql_query($sql);

		//echo $sql.mysql_error();exit;
		//get the primary key
		$id		= mysql_insert_id();

		//return the service id
		return $id;

	}//eof

	

	

	/**
	*	Update 	Services Table
	*
	*	@param
	*			$id						service id
	*			$service_cat_id			service catagories id
	*			$service_name			Services Name
	*			$service_desc			Services Describtion 
	*
	*	@return int
	*/

	function editServices($id, $service_cat_id,$service_name, $service_desc, $page_title, $seo_url, $meta_tags, $meta_desc, $img, $modified_by){

		if (empty($img)) {
			$img = 'services.image';
		}else {
			$img = "'".$img."'";
		}

		$id							=	addslashes(trim($id));
		$service_cat_id				=	addslashes(trim($service_cat_id));
		$service_name				=	addslashes(trim($service_name));
		$service_desc				=	addslashes(trim($service_desc));

		$page_title					=	addslashes(trim($page_title));
		$seo_url					=	addslashes(trim($seo_url));
		$meta_tags					=	addslashes(trim($meta_tags));
		$meta_desc					=	addslashes(trim($meta_desc));
		$modified_by				=	addslashes(trim($modified_by));

		//statement
		$sql	= "UPDATE services SET
				  service_cat_id			='$service_cat_id',
				  service_name				='$service_name',
				  service_desc				= '$service_desc',
				  page_title 				='$page_title',
				  seo_url					='$seo_url',
				  meta_tags					='$meta_tags',
				  meta_desc					='$meta_desc',
				  image						= $img,
				  modified_on 				= now(),
				  modified_by				='$modified_by'
				  WHERE 
				  id 						= '$id'";

		//execute query
		// echo $sql.$this->conn->error;exit;
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



	

	/**
	*	Get the data associated with a service based upon the primary key
	*
	*	@param
	*			$id		Services Id
	*
	*	@return array				
	*/
	function showServices($id){

		//declare vars
		$data = array();

		//statement
		$select = "SELECT * FROM services WHERE id = '$id'";

		//execute query
		$query	= $this->conn->query($select);
		//echo $select.mysql_error();exit;

		//holds the data
		while($result = $query->fetch_object()){

			$data  = array(
					$result->id,						//0
					$result->service_cat_id,			//1
					$result->service_name,				//2
					$result->service_desc,				//3
					$result->page_title,				//4
					$result->seo_url,					//5
					$result->meta_tags,					//6
					$result->meta_desc,					//7
					$result->added_by,					//8
					$result->added_on,					//9
					$result->modified_by,				//10
					$result->modified_on,				//11
					$result->image						//12
					);

		}
		//print_r($data);

		//return the data
		return $data;

	}//eof

	

	/**
	*	Retrieve all service id depending on conditions
	*
	*	@param
	*			$id		Value of the type to search for
	*			$type	Type of result set id
	* 
	*
	*	@return array
	*/
	function getServiceId($id, $type){

		//declare variables
		$sql	= '';
		$data	= array();

		//conditions
		if($type == ''){

			$sql	= "SELECT id FROM services ORDER BY added_on DESC ";

		}else{

			$sql	= "SELECT id FROM services WHERE ".$type." = '$id' ORDER BY added_on";

		}

		//execute the query
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;

		if($query->num_rows > 0){
			while($result = $query->fetch_object()){
				$data[] = $result->id;
			}
		}

		return $data;

	}//eof

	

	 

	

	/**

	*	Get the data associated with a Services based upon the seo_url
	*
	*	@param
	*			$seo_url		seo_url
	*
	*	@return array				
	*/
	function showServicesSeoUrlWise($seo_url){

		$select = "SELECT * From services WHERE seo_url LIKE '%$seo_url%'";

		//execute query
		$query	= $this->conn->query($select);
		// echo $query.$this->conn->error;exit;

		//holds the data
		while($result = $query->fetch_object()){

			$data[]  = array(

					$result->id,						//0
					$result->service_cat_id,			//1
					$result->service_name,				//2
					$result->service_desc,				//3
					$result->page_title,				//4
					$result->image,						//5
					$result->seo_url,					//6
					$result->meta_tags,					//7
					$result->meta_desc,					//8
					$result->added_by,					//9
					$result->added_on,					//10
					$result->modified_by,				//11
					$result->modified_on				//12

					);

		}
		//print_r($data);

		//return the data
		return $data;


	}//eof

	

	//Display Services Details
	public function ShowAllServices(){

		$temp_arr = array();
     	$res = $this->conn->query("SELECT * FROM services order by service_cat_id ASC") or die($this->conn->error);        
		if ($res->num_rows) {
			while($row = $res->fetch_assoc()) {
				$temp_arr[] = $row;
			}
		}

     return json_encode($temp_arr);

    }



	//Display Services Details

	public function ShowSercsCatWise($service_cat_id){

		//  $temp_arr = array();

		$res = "SELECT * FROM services where service_cat_id = '$service_cat_id' order by id asc";        

		$resQuery = $this->conn->query($res);

		while($row = $resQuery->fetch_array()) {

			 $temp_arr[] =$row;

		}

		 return $temp_arr;  

		}

	

	

	#####################################################################################################

	#

	#										Services Featurds

	#

	#####################################################################################################

	

	

	

	/**

	*	Add a new Services featued in service_featured table. 

	*

	*	@param

	*			$id						Services featued id

	*			$services_id			ServicesId

	*			$featued_name			Services featued 

	*			$desc					Services featued details

	*			

	*

	*	@return int

	*/

	function addServicesfeatued($services_id, $featued_name, $desc, $added_by)

	{

		$services_id						=	addslashes(trim($services_id));

		$featued_name						=	addslashes(trim($featued_name));

		$desc								=	addslashes(trim($desc));

		$added_by							=	addslashes(trim($added_by));

		//satement to insert in service table

		$sql	=   "INSERT INTO service_featured

						(`services_id`, `featued_name`, `desc`, `added_by`, `added_on`)

						VALUES

						('$services_id', '$featued_name', '$desc', '$added_by', now())

						";

		//execute query

		//execute query

		$query = mysql_query($sql);

		//echo $sql.mysql_error();exit;

		//get the primary key

		$id		= mysql_insert_id();

		

		//return the service featued Id

		return $id;

		

	}//eof

	

	

	// Services featued update

	function editServicesFeatued($id,$services_id, $featued_name, $desc, $images, $modified_on)

						

	{

		$id									=	addslashes(trim($id));

		$services_id						=	addslashes(trim($services_id));

		$featued_name						=	addslashes(trim($featued_name));

		$desc								=	addslashes(trim($desc));

		$images								=	addslashes(trim($images));

		$modified_on						=	addslashes(trim($modified_on));

		

		//statement

		$sql	= "UPDATE service_featured SET

				  services_id						='$services_id',

				  featued_name						='$featued_name',

				  desc								='$desc',

				  images							='$images',

				  modified_on 						= now()

				  WHERE 

				  id 								= '$id'

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



	

	

	//  Display service Featurds

	public function ShowServcFeardData(){

     $temp_arr = array();

     $res = mysql_query("SELECT * FROM service_featured order by added_on desc") or die(mysql_error());        

     $count=mysql_num_rows($res);

    while($row = mysql_fetch_array($res)) {

         $temp_arr[] =$row;

     }

     return $temp_arr;  

     }

	

	 public function ShowServcFrdDtls($services_id){

		$res = "SELECT * FROM service_featured where services_id = '$services_id'";        

		$resQuery = $this->conn->query($res);

		while($row = $resQuery->fetch_array()) {

			  $temp_arr[] =$row;

		}

		return $temp_arr;  

		}

	

	

}



?>	

	