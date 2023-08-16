<?php 


class Products extends DatabaseConnection{

	

	#####################################################################################################
	#
	#										Products Type
	#
	#####################################################################################################

	
	/**
	*	Add a new Products type in product_type table. 
	*
	*	@param
	*			$id							Products type id
	*			$product_type				Products Type
	*			$description				Products Description
	*			
	*
	*	@return int
	*/
	function addProductsType($product_type, $description, $added_by){

		$product_type					=	addslashes(trim($product_type));

		$description					=	addslashes(trim($description));

		$added_by						=	addslashes(trim($added_by));

		//satement to insert in product type table

		$sql	=   "INSERT INTO product_type

						(product_type,description, added_by, added_on)

						VALUES

						('$product_type','$description', '$added_by', now())

						";

		//execute query

		//execute query

		$query = mysql_query($sql);

		//echo $sql.mysql_error();exit;

		//get the primary key

		$id		= mysql_insert_id();

		

		//return the blog_niche_id

		return $id;

		

	}//eof

	

	

	// Products Type update

	function editProductsType($id,$product_type, $description, $modified_by)

						

	{

		$id								=	addslashes(trim($id));

		$product_type					=	addslashes(trim($product_type));

		$description					=	addslashes(trim($description));

		$modified_by					=	addslashes(trim($modified_by));

		

		//statement

		$sql	= "UPDATE product_type SET

				  product_type						='$product_type',

				  description						='$description',

				  modified_by						='$modified_by',

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



	/**

	*	Get product type information corresponding to a product type and holds information in an array

	*	@return array

	*/

	function getProdTypeDetail($id)

	{



		//declare var

		$data		= array();

		//statement

		$select     = "SELECT * FROM product_type WHERE id='$id'";

		//echo $select;

		//execute query

		$query	= $this->conn->query($select);

		if($query->num_rows > 0)

		{

			//get the result set

			$result 	= $query->fetch_object();

			//hold the data in array

			$data   	= array(

								  $result->product_type,		//0

								  $result->description,			//1

								  $result->added_by,			//2

								  $result->added_on,			//3

								  $result->modified_by,			//4

								  $result->modified_on			//5

							   );

		}

		//return the data

		return $data;

		

	}//eof

	

	//  Display Products Type

	public function ShowProdTypeData(){



		$temp_arr = array();

		$query = "SELECT * FROM product_type order by product_type ASC";

		$res   = $this->conn->query($query);        

		$count = $res->num_rows;

		if ($count > 0) {

			while($row = $res->fetch_array()) {

				$temp_arr[] =$row;

			}

		}

		return $temp_arr;  

     }



	#####################################################################################################

	#

	#										Products Table

	#

	#####################################################################################################

	

	// 			Add New Products

	/**

	*	Add a new products in products table. It also adds data in products catagories details

	*

	*	@param

	*			$id						Products id

	*			$product_type_id		Products type

	*			$product_name			Products Name

	*			$band					Products Band

	*			$platform				Running Platform

	*			$dev_langues			Application Language 

	*			$version				Application Version

	*			$proj_url				Projects Demo Url

	*			$description			Project Description

	*			$client_price			Products seller Price

	*			$sales_price			Selling Price

	*			$offer					Products Offer

	*			$selling_status			Products Selling Status

	*			$service_period			Products service period

	*			$service_unit			Products service unit

	*			$services				Products Services

	*			$sales_status			Products Selling Status

	*

	*	@return int

	*/

	function addProducts($product_type_id,$product_name, $band, $platform, $dev_langues, $version, $proj_url,$description, $client_price, $sales_price,

						 $offer, $service_period,$service_unit, $services, $sales_status, $approved,$page_title, $seo_url, $meta_tags, $meta_description, $added_by)

						

	{

		$product_type_id			=	addslashes(trim($product_type_id));

		$product_name				=	addslashes(trim($product_name));

		$band						=	addslashes(trim($band));

		$platform					=	addslashes(trim($platform));

		$dev_langues				=	addslashes(trim($dev_langues));

		$version					=	addslashes(trim($version));

		$proj_url					=	addslashes(trim($proj_url));

		$description				=	addslashes(trim($description));

		$client_price				=	addslashes(trim($client_price));

		$sales_price				=	addslashes(trim($sales_price));

		$offer						=	addslashes(trim($offer));

		$service_period				=	addslashes(trim($service_period));

		$service_unit				=	addslashes(trim($service_unit));

		$services					=	addslashes(trim($services));

		$sales_status				=	addslashes(trim($sales_status));

		$approved					=	addslashes(trim($approved));

		

		$page_title					=	addslashes(trim($page_title));

		$seo_url					=	addslashes(trim($seo_url));

		$meta_tags					=	addslashes(trim($meta_tags));

		$meta_description			=	addslashes(trim($meta_description));

		$added_by					=	addslashes(trim($added_by));

		//satement to insert in product table

		$sql	=   "INSERT INTO products

						(product_type_id,product_name,band,platform,dev_langues, 

						version, proj_url,description, client_price, sales_price,offer,

						service_period, service_unit, services, sales_status, approved, page_title, seo_url, meta_tags, meta_description, added_by, added_on)

						VALUES

						('$product_type_id','$product_name','$band','$platform','$dev_langues',

						'$version','$proj_url','$description', '$client_price', '$sales_price','$offer'

						,'$service_period', '$service_unit', '$services', '$sales_status', '$approved', '$page_title', '$seo_url', '$meta_tags', '$meta_description', '$added_by', now())

						";

		//execute query

		//execute query

		$query = $this->conn->query($sql);

		//echo $sql.mysql_error();exit;

		//get the primary key

		$id		= $this->conn->insert_id;

		

		//return the blog_id

		return $id;

		

	}//eof

	

	

	/**

	*	Update 	Products Table

	*

	*	@param

	*			$id						Products id

	*			$product_type_id		Products type

	*			$product_name			Products Name

	*			$band					Products Band

	*			$platform				Running Platform

	*			$dev_langues			Application Language 

	*			$version				Application Version

	*			$proj_url				Projects Demo Url

	*			$description			Project Description

	*			$client_price			Products seller Price

	*			$sales_price			Selling Price

	*			$offer					Products Offer

	*			$selling_status			Products Selling Status

	*			$service_period			Products service period

	*			$service_unit			Products service unit

	*			$services				Products Services

	*			$sales_status			Products Selling Status

	*

	*	@return int

	*/

	function editProducts($id, $product_type_id,$product_name, $band, $platform, $dev_langues, $version, $proj_url,$description, $client_price, $sales_price,

						 $offer, $service_period,$service_unit, $services, $sales_status, $approved, $modified_by)

						

	{

		$id							=	addslashes(trim($id));

		$product_type_id			=	addslashes(trim($product_type_id));

		$product_name				=	addslashes(trim($product_name));

		$band						=	addslashes(trim($band));

		$platform					=	addslashes(trim($platform));

		$dev_langues				=	addslashes(trim($dev_langues));

		$version					=	addslashes(trim($version));

		$proj_url					=	addslashes(trim($proj_url));

		$description				=	addslashes(trim($description));

		$client_price				=	addslashes(trim($client_price));

		$sales_price				=	addslashes(trim($sales_price));

		$offer						=	addslashes(trim($offer));

		$service_period				=	addslashes(trim($service_period));

		$service_unit				=	addslashes(trim($service_unit));

		$services					=	addslashes(trim($services));

		$sales_status				=	addslashes(trim($sales_status));

		$approved					=	addslashes(trim($approved));

		

		//statement

		$sql	= "UPDATE products SET

				  product_type_id			='$product_type_id',

				  product_name				='$product_name',

				  band						= '$band',

				  platform 					='$platform',

				  dev_langues				='$dev_langues',

				  version					='$version',

				  proj_url					='$proj_url',

				  description				='$description',

				  client_price				='$client_price',

				  sales_price				='$sales_price',

				  offer						='$offer',

				  service_period			='$service_period',

				  service_unit				='$service_unit',

				  services					='$services',

				  sales_status				='$sales_status',

				  approved					='$approved',

				  modified_on 				= now(),

				  modified_by				='$modified_by'

				  WHERE 

				  id 						= '$id'

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
	*	Get the data associated with a Productss based upon the primary key
	*
	*	@param
	*			$id		Products Id
	*
	*	@return array				
	*/
	function showProduct($id){

		//declare vars
		$data = array();
		$select = "SELECT * FROM products WHERE id	= '$id'";
		$query	= $this->conn->query($select);
		echo $select.$this->conn->error;exit;

		//holds the data
		while($result = $query->fetch_assoc()){

			$data  = array(
					$result->product_type_id,			//0
					$result->product_name,				//1
					$result->band,						//2
					$result->platform,					//3
					$result->dev_langues,				//4
					$result->version,					//5
					$result->proj_url,					//6
					$result->description,				//7
					$result->image,						//8
					$result->client_price,				//9
					$result->sales_price,				//10
					$result->offer,						//11
					$result->service_period,			//12
					$result->service_unit,				//13
					$result->services,					//14
					$result->sales_status,				//15
					$result->approved,					//16
					$result->page_title,				//17
					$result->url,						//18
					$result->seo_url,					//19
					$result->meta_tags,					//20
					$result->meta_description,			//21
					$result->added_by,					//22
					$result->added_on,					//23
					$result->modified_by,				//24
					$result->modified_on,				//25
					$result->id							//26

					);

		}

		//print_r($data);

		//return the data

		return $data;

		

	}//eof

	

	/**

	*	Get the data associated with a Productss based upon the seo_url

	*

	*	@param

	*			$seo_url		seo_url

	*

	*	@return array				

	*/

	function showProductSeoUrlWise($seo_url)

	{

		//declare vars

		$data = array();

		//statement

		$select = "SELECT * 

				   FROM 

				   products 

				   WHERE 

				   seo_url		= '$seo_url'

				   ";

		//execute query

		$query	= mysql_query($select);

		//echo $select.mysql_error();exit;

		//holds the data

		while($result = mysql_fetch_object($query))

		{

			$data  = array(

					$result->product_type_id,			//0

					$result->product_name,				//1

					$result->band,						//2

					$result->platform,					//3

					$result->dev_langues,				//4

					$result->version,					//5

					$result->proj_url,					//6

					$result->description,				//7

					$result->image,						//8

					$result->client_price,				//9

					$result->sales_price,				//10

					$result->offer,						//11

					$result->service_period,			//12

					$result->service_unit,				//13

					$result->services,					//14

					$result->sales_status,				//15

					$result->approved,					//16

					$result->page_title,				//17

					$result->url,						//18

					$result->seo_url,					//19

					$result->meta_tags,					//20

					$result->meta_description,			//21

					$result->added_by,					//22

					$result->added_on,					//23

					$result->modified_by,				//24

					$result->modified_on,				//25

					$result->id							//26

					);

		}

		//print_r($data);

		//return the data

		return $data;

		

	}//eof

	

	//Display Products Details

	public function ShowProdData(){

    //  $temp_arr = array();

    //  $res = mysql_query("SELECT * FROM products order by added_on desc") or die(mysql_error());        

    //  $count=mysql_num_rows($res);

    // while($row = mysql_fetch_array($res)) {

    //      $temp_arr[] =$row;

    //  }

    //  return $temp_arr;  



	$temp_arr = array();

	$res = "SELECT * FROM products order by added_on desc";        

	$query	= $this->conn->query($res);

	$count= $query->num_rows;

   	while($row = $query->fetch_array()) {

		$temp_arr[] =$row;

	}

	return $temp_arr;  







     }

	

	

	#####################################################################################################

	#

	#										Products Featurds

	#

	#####################################################################################################

	

	

	

	/**

	*	Add a new Products featued in Products_featured table. 

	*

	*	@param

	*			$id						Products featued id

	*			$product_id			Products Id

	*			$featured				Products Featured 

	*			

	*

	*	@return int

	*/

	function addProductsFeatured($product_id, $featured)

	{

		$product_id						=	addslashes(trim($product_id));

		$featured						=	addslashes(trim($featured));

		//$added_on						=	addslashes(trim($added_on));

		//satement to insert in product table

		$sql	=   "INSERT INTO product_featured

						(product_id,featured,added_on)

						VALUES

						('$product_id','$featured',now())

						";

		//execute query

		//execute query

		$query = mysql_query($sql);

		//echo $sql.mysql_error();exit;

		//get the primary key

		$id		= mysql_insert_id();

		

		//return the blog_niche_id

		return $id;

		

	}//eof

	

	

	// Products featued update

	function editProductsFeatured($id,$featured, $modified_on)

						

	{

		$id									=	addslashes(trim($id));

		$featured							=	addslashes(trim($featured));

		$modified_on						=	addslashes(trim($modified_on));

		

		//statement

		$sql	= "UPDATE product_featured SET

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



	

	

	//  Display Products Featurds

	public function ShowProdfeaturedData(){

     $temp_arr = array();

     $res = mysql_query("SELECT * FROM product_featured order by added_on desc") or die(mysql_error());        

     $count=mysql_num_rows($res);

    while($row = mysql_fetch_array($res)) {

         $temp_arr[] =$row;

     }

     return $temp_arr;  

     }

	

	public function ShowProdFtrdDtls($product_id){

     $temp_arr = array();

     $res = mysql_query("SELECT * FROM product_featured where product_id = '$product_id'") or die(mysql_error());        

     $count=mysql_num_rows($res);

    while($row = mysql_fetch_array($res)) {

         $temp_arr[] =$row;

     }

     return $temp_arr;  

     }

	 

	 /*

	*	This funcion will return all the product id

	*	

	*	@param

	*			$orderby		Order by clause in runtime

	*			$orderType		Order type, either ascending or descending

	*

	*	@return array

	*/

	function getAllProdIdByCatId($catId){

		$data	= array();

		$select	= "SELECT id FROM products

				   WHERE product_type_id = '$catId'

				   ORDER BY added_on ASC";

				   

		$query	= $this->conn->query($select);



		while($result	= $query->fetch_array())

		{

			$data[]	= $result['id'];

		}

		//return the data

		return $data;

		

	}//eof

	

}



?>	

	