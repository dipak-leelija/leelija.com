<?php 
/**
*	This class is going to work with all Domain associated with a Domain category. 
*
*	UPDATE oct 17, 2018:
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


class BlogMst extends DatabaseConnection
{

	#####################################################################################################
	#
	#										BLOG Master
	#
	#####################################################################################################
	
	// 			Blog Add
	/**
	*	Add a new domain in blog_mst table. It also adds data in blog niche details, and 
	*	blog_accounts table
	*
	*	@param
	*			$blog_id				Blog id
	*			$domain					Domain Name
	*			$da						domain authority 
	*			$pa						Page Authority
	*			$cf						Citation Flow 
	*			$tf						Trust Flow
	*			$gip					Google index page
	*			$mozr					Moz rank
	*			$follow					link type
	*			$internal				Source
	*			$cost					cost price
	*			$review_type			Review type
	*			$issue					Domain issue
	*			$issue_comment			domain issue comments
	*			$int_email				internal email
	*			$ext_email				external email
	*			$ext_contact_name		External contact number
	*			$ext_cost				External cost
	*			$ex_url					Example url
	*			$domain_comments		Domain Comments
	*
	*	@return int
	*/
	function addBlog($domain,$niche, $da, $pa, $cf, $tf, $gip, $mozr,$alexa_traffic,$organic_trafic, $follow, $internal,
						$cost, $review_type, $issue, $issue_comment, $int_email, $ext_email, $ext_contact_name,$ext_cost, 
						$ex_url, $domain_comments,$deliver_time,$created_by,$approved)
						
	{
		$domain				=	addslashes(trim($domain));
		$niche				=	addslashes(trim($niche));
		$da					=	addslashes(trim($da));
		$pa					=	addslashes(trim($pa));
		$cf					=	addslashes(trim($cf));
		$tf					=	addslashes(trim($tf));
		$gip				=	addslashes(trim($gip));
		$mozr				=	addslashes(trim($mozr));
		$alexa_traffic		=	addslashes(trim($alexa_traffic));
		$organic_trafic		=	addslashes(trim($organic_trafic));
		$follow				=	addslashes(trim($follow));
		$internal			=	addslashes(trim($internal));
		$cost				=	addslashes(trim($cost));
		$review_type		=	addslashes(trim($review_type));
		$issue				=	addslashes(trim($issue));
		$issue_comment		=	addslashes(trim($issue_comment));
		$int_email			=	addslashes(trim($int_email));
		$ext_email			=	addslashes(trim($ext_email));
		$ext_contact_name	=	addslashes(trim($ext_contact_name));
		$ext_cost			=	addslashes(trim($ext_cost));
		$ex_url				=	addslashes(trim($ex_url));
		$domain_comments	=	addslashes(trim($domain_comments));
		$deliver_time		=	addslashes(trim($deliver_time));
		$created_by			=	addslashes(trim($created_by));
		$updated_by			=	addslashes(trim($created_by));
		$approved			=	addslashes(trim($approved));
		//satement to insert in product table
		$sql	=   "INSERT INTO blog_mst
						(domain,niche,da,pa,cf, 
						tf, gip, mozr,alexa_traffic,organic_trafic, follow, internal,cost,
						review_type, issue, issue_comment, int_email, ext_email,ext_contact_name,
						ext_cost, ex_url,domain_comments,deliver_time,created_by,created_on,updated_by,updated_on,approved)
						VALUES
						('$domain','$niche','$da','$pa','$cf',
						'$tf', '$gip', '$mozr','$alexa_traffic','$organic_trafic', '$follow', '$internal','$cost'
						,'$review_type', '$issue', '$issue_comment', '$int_email', '$ext_email','$ext_contact_name',
						'$ext_cost', '$ex_url','$domain_comments','$deliver_time','$created_by',now(),'$updated_by',now(),'$approved')
						";
		
	
		// echo $sql.$this->conn->error;exit;
		$query = $this->conn->query($sql);
		//get the primary key
		$blog_id		= $this->conn->insert_id;
		
		//return the blog_id
		return $blog_id;
		
	}//eof
	
	
	/**
	*	Update 	blog_mst
	*
	*	@update	feb 23 2016
	*
	*	
	*
	*	@param
	*			$blog_id				Blog id
	*			$domain					Domain Name
	*			$da						domain authority 
	*			$pa						Page rank
	*			$cf						Citation Flow 
	*			$tf						Trust Flow
	*			$gip					Google index page
	*			$mozr					Moz rank
	*			$follow					link type
	*			$internal				Source
	*			$cost					cost price
	*			$review_type			Review type
	*			$issue					Domain issue
	*			$issue_comment			domain issue comments
	*			$int_email				internal email
	*			$ext_email				external email
	*			$ext_contact_name		External contact number
	*			$ext_cost				External cost
	*			$ex_url					Example url
	*			$domain_comments		Domain Comments
	*
	*	@return int
	*/
	function editBlog($blog_id,$domain,$niche, $da, $pa, $cf, $tf, $gip, $mozr,$alexa_traffic,$organic_trafic, $follow, $internal,
						$cost, $review_type, $issue, $issue_comment, $int_email, $ext_email, $ext_contact_name,$ext_cost, 
						$ex_url, $domain_comments,$deliver_time,$updated_by)
						
	{
		$domain				=	addslashes(trim($domain));
		$niche				=	addslashes(trim($niche));
		$da					=	addslashes(trim($da));
		$pa					=	addslashes(trim($pa));
		$cf					=	addslashes(trim($cf));
		$tf					=	addslashes(trim($tf));
		$gip				=	addslashes(trim($gip));
		$mozr				=	addslashes(trim($mozr));
		$alexa_traffic		=	addslashes(trim($alexa_traffic));
		$organic_trafic		=	addslashes(trim($organic_trafic));
		$follow				=	addslashes(trim($follow));
		$internal			=	addslashes(trim($internal));
		$cost				=	addslashes(trim($cost));
		$review_type		=	addslashes(trim($review_type));
		$issue				=	addslashes(trim($issue));
		$issue_comment		=	addslashes(trim($issue_comment));
		$int_email			=	addslashes(trim($int_email));
		$ext_email			=	addslashes(trim($ext_email));
		$ext_contact_name	=	addslashes(trim($ext_contact_name));
		$ext_cost			=	addslashes(trim($ext_cost));
		$ex_url				=	addslashes(trim($ex_url));
		$domain_comments	=	addslashes(trim($domain_comments));
		$deliver_time		=	addslashes(trim($deliver_time));
		$updated_by			=	addslashes(trim($updated_by));
		
		//statement
		$sql	= "UPDATE blog_mst SET
				  domain			='$domain',
				  niche				='$niche',
				  da				= '$da',
				  pa 				='$pa',
				  cf				='$cf',
				  tf				='$tf',
				  gip				='$gip',
				  mozr				='$mozr',
				  alexa_traffic		='$alexa_traffic',
				  organic_trafic	='$organic_trafic',
				  follow			='$follow',
				  internal			='$internal',
				  cost				='$cost',
				  review_type		='$review_type',
				  issue				='$issue',
				  issue_comment		='$issue_comment',
				  int_email			='$int_email',
				  ext_email			='$ext_email',
				  ext_contact_name	='$ext_contact_name',
				  ext_cost			='$ext_cost',
				  ex_url			='$ex_url',
				  domain_comments	='$domain_comments',
				  deliver_time		='$deliver_time',
				  updated_on 		= now(),
				  updated_by		='$updated_by'
				  WHERE 
				  blog_id 			= '$blog_id'
				  ";
				  
		//execute query
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;
		//echo $sql;exit;
		$result = '';
		if(!$query){
			$result = "ER102";
		}else{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof

	
	
	//Blog Niche edit
	function editBlogMstNiche($blog_id, $niche, $updated_by)
						
	{
		$blog_id							=	addslashes(trim($blog_id));
		$niche								=	addslashes(trim($niche));
		$updated_by							=	addslashes(trim($updated_by));
		
		//statement
		$sql	= "UPDATE blog_mst SET
				  niche							= '$niche',
				  updated_on 					= now(),
				  updated_by					='$updated_by'
				  WHERE 
				  blog_id 						= '$blog_id'
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
	
	//Status updated
	function updateStatus($blog_id, $approved, $updated_by){

		$blog_id							=	addslashes(trim($blog_id));
		$approved							=	addslashes(trim($approved));
		$updated_by							=	addslashes(trim($updated_by));
		
		//statement
		$sql	= "UPDATE blog_mst 
					SET 
					approved   = '$approved',
					updated_on = now(),
					updated_by = '$updated_by' 
					WHERE 
					blog_id = '$blog_id'";
				  
		//execute query
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;
		//echo $sql;exit;
		$result = '';

		if(!$query){
			$result = "ER102";
		}else{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof
	/**
	*	Get the data associated with a product based upon the primary key
	*
	*	@param
	*			$bid		blog id
	*
	*	@return array				
	*/
	function showBlog($bid){
		
		$data = array();
		$select = "SELECT * FROM blog_mst WHERE blog_id = '$bid'";
		$query	= $this->conn->query($select);
		//echo $select.mysql_error();exit;
		while($result = $query->fetch_object()){

			$data  = array(
					$result->domain,			//0
					$result->da,				//1
					$result->pa,				//2
					$result->cf,				//3
					$result->tf,				//4
					$result->gip,				//5
					$result->mozr,				//6
					$result->follow,			//7
					$result->internal,			//8
					$result->cost,				//9
					$result->review_type,		//10
					$result->issue,				//11
					$result->issue_comment,		//12
					$result->int_email,			//13
					$result->ext_email,			//14
					$result->ext_contact_name,	//15
					$result->ext_cost,			//16
					$result->ex_url,			//17
					$result->domain_comments,	//18
					$result->created_by,		//19
					$result->created_on,		//20
					$result->updated_by,		//21
					$result->updated_on,		//22
					$result->niche,				//23
					$result->approved,			//24
					$result->alexa_traffic,		//25
					$result->organic_trafic,	//26
					$result->deliver_time		//27
					);
		}
		// print_r($data);exit;
		//return the data
		return $data;
		
	}//eof
	
	
	/**
	*	Get the data associated with a product based upon Domain name
	*
	*	@param
	*			$domain		Domain name
	*
	*	@return array				
	*/
	function showBlogbyDomain($domain){

		$data = array();
		$select = "SELECT * FROM blog_mst WHERE domain = '$domain'";
		$query	= $this->conn->query($select);
		//echo $select.mysql_error();exit;
		//holds the data
		while($result = $query->fetch_object()){
			$data  = array(
					$result->domain,			//0
					$result->da,				//1
					$result->pa,				//2
					$result->cf,				//3
					$result->tf,				//4
					$result->gip,				//5
					$result->mozr,				//6
					$result->follow,			//7
					$result->internal,			//8
					$result->cost,				//9
					$result->review_type,		//10
					$result->issue,				//11
					$result->issue_comment,		//12
					$result->int_email,			//13
					$result->ext_email,			//14
					$result->ext_contact_name,	//15
					$result->ext_cost,			//16
					$result->ex_url,			//17
					$result->domain_comments,	//18
					$result->created_by,		//19
					$result->created_on,		//20
					$result->updated_by,		//21
					$result->updated_on,		//22
					$result->niche,				//23
					$result->approved			//24
					);
		}
		//print_r($data);
		//return the data
		return $data;
		
	}//eof
	
	
	
	public function ShowBlogData(){

     	$temp_arr = array();
	 	$sql 	  = "SELECT * FROM blog_mst order by blog_id desc";
     	$query 	  = $this->conn->query($sql);        
     	$count	  = $query->num_rows;

		if ($count > 0) {
			while($row = $query->fetch_array()) {
				$temp_arr[] = $row;
			}
		}
     	return $temp_arr;  
     }


	 //show approved blogs details
	public function ShowBlogApprData(){
     $res 	= "SELECT * FROM blog_mst where approved != 'no' order by blog_id desc " or die( $res->$this->conn->error );
	 $query	= $this->conn->query($res);
     $rows= $query->num_rows;
	 if ($rows > 0 ) {
		 while($result = $query->fetch_array()) {
			 $temp_arr[] =$result;
			}
			return $temp_arr;  
		}
	}



	//User wise blogs display
	public function ShowUserBlogData($created_by){
		$temp_arr = array();
		$res = "SELECT * FROM blog_mst where created_by ='$created_by' order by blog_id desc";
		$query = $this->conn->query($res);
   
		$rows= $query->num_rows;
   
	   while($result = $query->fetch_array()) {
			$temp_arr[] =$result;
			
		}
		return $temp_arr; 
     }
	 
	
	//  Display 
	public function ShowBlogUserWiseData($added_by){
	//echo $added_by;exit;
     $temp_arr = array();
     $res = mysql_query("SELECT * FROM blog_mst WHERE  created_by = '$added_by' ORDER BY updated_on ASC ") or die(mysql_error());        
     $count=mysql_num_rows($res);
    while($row = mysql_fetch_array($res)) {
         $temp_arr[] =$row;
		 
     }
     return $temp_arr;  
     }
	
	#####################################################################################################
	#
	#										BLOG Niches Details
	#
	#####################################################################################################
	
	
	
	
	// 			Blog Niche Details add
	/**
	*	Add a new Blog niche details table. 
	*
	*	@param
	*			$blog_id				blog_id
	*			$niche_id				niche_id
	*			$domain_niche_comments	domain_niche_comments 
	*			
	*
	*	@return int
	*/
	function addBlogNicheDetails($blog_id, $niche_id, $domain_niche_comments, $added_by){

		$blog_id						=	addslashes(trim($blog_id));
		$niche_id						=	addslashes(trim($niche_id));
		$domain_niche_comments			=	addslashes(trim($domain_niche_comments));
		$added_by						=	addslashes(trim($added_by));
		$modified_by					=	addslashes(trim($added_by));
		//satement to insert in product table
		$sql	=   "INSERT INTO blog_niche_detail
						(blog_id,niche_id,domain_niche_comments,added_on,added_by,modified_on,modified_by)
						VALUES
						('$blog_id','$niche_id','$domain_niche_comments',now(),'$added_by',now(),'$modified_by')
						";
		
		//execute query
		$query = $this->conn->query($sql);
		//echo $sql.$this->conn->error;exit;
		//get the primary key
		$blog_niche_id		= $this->conn->insert_id;
		
		//return the blog_niche_id
		return $blog_niche_id;
		
	}//eof
	
	
	// blog Niche details update
	function editBlogNicheDtl($blog_niche_id, $niche_id, $domain_niche_comments, $modified_by){

		$niche_id							=	addslashes(trim($niche_id));
		$domain_niche_comments				=	addslashes(trim($domain_niche_comments));
		$modified_by						=	addslashes(trim($modified_by));
		
		//statement
		$sql	= "UPDATE blog_niche_detail SET
				  niche_id						='$niche_id',
				  domain_niche_comments			= '$domain_niche_comments',
				  modified_on 					= now(),
				  modified_by					='$modified_by'
				  WHERE 
				  blog_niche_id 			= '$blog_niche_id'
				  ";
				  
		//execute query
		$query	= $this->conn->query($sql);
		//echo $sql.$this->conn->error;exit;
		//echo $sql;exit;
		$result = '';
		if(!$query){
			$result = "ER102";
		}else{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof

	
	
	//  Display Blog Niches
	public function ShowBlogNicheData(){
     $temp_arr = array();
     $res = mysql_query("SELECT * FROM blog_niche_detail order by added_on desc") or die(mysql_error());        
     $count=mysql_num_rows($res);
    while($row = mysql_fetch_array($res)) {
         $temp_arr[] =$row;
		 
     }
     return $temp_arr;  
     }
	
	
	
	//  Display Blog Niches
	public function ShowBlogNicheDataDtls($blog_id){
     $temp_arr = array();
     $res = mysql_query("SELECT * FROM blog_niche_detail WHERE  blog_id	= '$blog_id' ") or die(mysql_error());        
     $count=mysql_num_rows($res);
    while($row = mysql_fetch_array($res)) {
         $temp_arr[] =$row;
		 
     }
     return $temp_arr;  
     }
	
	
	/**
	*	Get the data associated with a Blog Niche Details based upon the blog_id key
	*
	*	@param
	*			$blog_id		Blog id
	*
	*	@return array				
	*/
	function getBlogNicheDtls($blog_id)
	{
		//declare vars
		$data = array();
		
		//statement
		$select = "SELECT * 
				   FROM 
				   blog_niche_detail 
				   WHERE 
				   blog_id		= '$blog_id'
				   ";
				   
		//execute query
		$query	= mysql_query($select);
		//echo $select.mysql_error();exit;
		//holds the data
		while($result = mysql_fetch_object($query))
		{
			$data  = array(
					$result->blog_niche_id,			//0
					$result->blog_id,		//1
					$result->niche_id,		//2
					$result->domain_niche_comments,		//3
					$result->added_on,		//4
					$result->added_by,		//5
					$result->modified_on,		//6
					$result->modified_by			//7
					);
		}
		//print_r($data);
		//return the data
		return $data;
		
	}//eof
	
	
	/**
	*	Get the data associated with a Blog Niche Details based upon the blog_niche_id key
	*
	*	@param
	*			$blog_niche_id		Blog niche id
	*
	*	@return array				
	*/
	function showBlogNiche($blog_niche_id)
	{
		//declare vars
		$data = array();
		
		//statement
		$select = "SELECT * 
				   FROM 
				   blog_niche_detail 
				   WHERE 
				   blog_niche_id		= '$blog_niche_id'
				   ";
				   
		//execute query
		$query	= mysql_query($select);
		//echo $select.mysql_error();exit;
		//holds the data
		while($result = mysql_fetch_object($query))
		{
			$data  = array(
					$result->blog_niche_id,			//0
					$result->blog_id,		//1
					$result->niche_id,		//2
					$result->domain_niche_comments,		//3
					$result->added_on,		//4
					$result->added_by,		//5
					$result->modified_on,		//6
					$result->modified_by			//7
					);
		}
		//print_r($data);
		//return the data
		return $data;
		
	}//eof
	
	
	
	//  Display blog_id group by niche_id 
	public function getBlogNicheData($blog_id){
     $temp_arr = array();
     $res = mysql_query("SELECT * FROM blog_niche_detail WHERE blog_id	= '$blog_id' group by niche_id ") or die(mysql_error());        
     $count=mysql_num_rows($res);
    while($row = mysql_fetch_array($res)) {
         $temp_arr[] =$row;
		 
     }
     return $temp_arr;  
     }
	 
	 /**
	*	This function will delete a Blog Niche details permanently
	*
	*	@param
	*			$blog_niche_id			blog_niche_id 
	*
	*	@return null
	*/
	function delBlogDomDtls($blog_niche_id)
	{
		
		//delete from product
		$delete1 = "DELETE FROM blog_niche_detail WHERE blog_niche_id='$blog_niche_id'";
		
		//execute quary
		$query1	= mysql_query($delete1);
		
	}//eof
	
	
	#####################################################################################################
	#
	#										Blog Account Details
	#
	#####################################################################################################
	
	
	
	
	// 			domain account Details add
	/**
	*	Add a new blog_accounts table. 
	*
	*	@param
	*			$blog_id				blog_id
	*			$user_account_type		User account type
	*			$user_account_id		User accont id
	*			
	*
	*	@return int
	*/
	function addBlogAcDetails($blog_id, $user_account_type, $user_account_id,$user_account_pass,$user_account_email
	,$user_account_status,$user_account_comments,$added_by)
	{
		$blog_id							=	addslashes(trim($blog_id));
		$user_account_type					=	addslashes(trim($user_account_type));
		$user_account_id					=	addslashes(trim($user_account_id));
		$user_account_pass					=	addslashes(trim($user_account_pass));
		$user_account_email					=	addslashes(trim($user_account_email));
		$user_account_status				=	addslashes(trim($user_account_status));
		$user_account_comments				=	addslashes(trim($user_account_comments));
		$added_by							=	addslashes(trim($added_by));
		$modified_by							=	addslashes(trim($added_by));
		
		//encrypt password
		$x_password = md5_encrypt($user_account_pass,ADMIN_PASS);
		
		//satement to insert in blog_acounts table
		$sql	=   "INSERT INTO blog_acounts
						(blog_id,user_account_type,user_account_id,user_account_pass,user_account_email,user_account_status,
						user_account_comments,added_on,added_by,modified_on,modified_by)
						VALUES
						('$blog_id','$user_account_type','$user_account_id','$x_password',
						'$user_account_email','$user_account_status','$user_account_comments',now(),'$added_by',now(),'$modified_by')
						";
		
		//execute query
		//execute query
		$query = $this->conn->query($sql);
		//echo $sql.$this->conn->error;exit;
		//get the primary key
		$blog_accounts_id		= $this->conn->insert_id;
		
		//return the blog_niche_id
		return $blog_accounts_id;
		
	}//eof
	
	
	
	//  Display Blog Accounts
	public function ShowBlogAcDtls(){
     $temp_arr = array();
     $res = mysql_query("SELECT * FROM blog_acounts order by added_on desc") or die(mysql_error());        
     $count=mysql_num_rows($res);
    while($row = mysql_fetch_array($res)) {
         $temp_arr[] =$row;
		 
     }
     return $temp_arr;  
     }
	
	//  Display Blog Accounts
	public function ShowBlogAccountDataDtls($blog_id){
     $temp_arr = array();
     $res = mysql_query("SELECT * FROM blog_acounts WHERE  blog_id	= '$blog_id' ") or die(mysql_error());        
     $count=mysql_num_rows($res);
    while($row = mysql_fetch_array($res)) {
         $temp_arr[] =$row;
		 
     }
     return $temp_arr;  
     }
	
	/**
	*	Get the data associated with a Blog Account Details based upon the primary key
	*
	*	@param
	*			$blog_accounts_id		blog account details
	*
	*	@return array				
	*/
	function getBlogAcDetails($blog_accounts_id)
	{
		//declare vars
		$data = array();
		
		//statement
		$select = "SELECT * 
				   FROM 
				   blog_acounts 
				   WHERE 
				   blog_accounts_id		= '$blog_accounts_id'
				   ";
				   
		//execute query
		$query	= mysql_query($select);
		//echo $select.mysql_error();exit;
		//holds the data
		while($result = mysql_fetch_object($query))
		{
			$data  = array(
					$result->blog_accounts_id,			//0
					$result->blog_id,				//1
					$result->user_account_type,		//2
					$result->user_account_id,			//3
					$result->user_account_pass,			//4
					$result->user_account_email,		//5
					$result->user_account_status,			//6
					$result->user_account_comments,			//7
					$result->added_on,		//8
					$result->added_by,		//9
					$result->modified_on,		//10
					$result->modified_by			//11
					);
		}
		//print_r($data);
		//return the data
		return $data;
		
	}//eof
	
	// blog account details update
	function editBlogAcDetails($blog_accounts_id, $user_account_type, $user_account_id,$user_account_email
	,$user_account_status,$user_account_comments,$modified_by)
						
	{
		$user_account_type					=	addslashes(trim($user_account_type));
		$user_account_id					=	addslashes(trim($user_account_id));
	//	$user_account_pass					=	addslashes(trim($user_account_pass));
		$user_account_email					=	addslashes(trim($user_account_email));
		$user_account_status				=	addslashes(trim($user_account_status));
		$user_account_comments				=	addslashes(trim($user_account_comments));
		$modified_by							=	addslashes(trim($modified_by));
		
		//statement
		$sql	= "UPDATE blog_acounts SET
				  user_account_type				='$user_account_type',
				  user_account_id				= '$user_account_id',
				  user_account_email 			='$user_account_email',
				  user_account_status			='$user_account_status',
				  user_account_comments			='$user_account_comments',
				  modified_on 					= now(),
				  modified_by					='$modified_by'
				  WHERE 
				  blog_accounts_id 			= '$blog_accounts_id'
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
	*	This function will delete a Blog Account details permanently
	*
	*	@param
	*			$blog_accounts_id			blog_accounts_id 
	*
	*	@return null
	*/
	function delBlogDomAcDtls($blog_accounts_id)
	{
		
		//delete from blog_accounts
		$delete1 = "DELETE FROM blog_acounts WHERE blog_accounts_id='$blog_accounts_id'";
		
		//execute quary
		$query1	= mysql_query($delete1);
		
	}//eof
	
	
	#####################################################################################################
	#
	#								 Niches Master
	#
	#####################################################################################################
	
	/**
	*	Get the data associated with a Blog Niche master based upon the primary key
	*
	*	@param
	*			$niche_id		Niche id
	*
	*	@return array				
	*/
	function showBlogNichMst($niche_id){

		$data = array();
		$select = "SELECT * FROM niche_master WHERE niche_id = '$niche_id'";

		//execute query
		$query	= $this->conn->query($select);
		// echo $select.$this->conn->error;exit;
		$rows = $query->num_rows;
		// echo $rows.'<br>';
		//holds the data
		if ($rows>0) {
			while($result = $query->fetch_object()){
				$data[]  = array(
						$result->niche_id,			//0
						$result->niche_name,		//1
						$result->added_on,			//2
						$result->added_by,			//3
						$result->modified_on,		//4
						$result->modified_by		//5
						);
			}//while
		return $data;
		}//if
		

	}//eof



	function showBlogNichMstByName($niche_name){

		$data = array();
		$select = "SELECT * FROM niche_master WHERE niche_name = '$niche_name'";

		//execute query
		$query	= $this->conn->query($select);
		// echo $select.$this->conn->error;exit;
		$rows = $query->num_rows;
		// echo $rows.'<br>';
		//holds the data
		if ($rows>0) {
			while($result = $query->fetch_object()){
				$data[]  = array(
						$result->niche_id,			//0
						$result->niche_name,		//1
						$result->added_on,			//2
						$result->added_by,			//3
						$result->modified_on,		//4
						$result->modified_by		//5
						);
			}//while
		return $data;
		}//if
		

	}//eof


	
	
	//  Display Blog Niches Master
	public function ShowBlogNichMast(){
		//  $temp_arr = array();
		$res = "SELECT * FROM niche_master order by niche_name asc";
		//  $count=mysql_num_rows($res);
		$resQuery = $this->conn->query($res);
	
		// $rows = $res->num_rows;
		while($row = $resQuery->fetch_array()) {
			 $temp_arr[] =$row;
	
		 }
		 return $temp_arr;
		 }


	//  Display Blog Niches Master
	public function getBlogNichMast($niche_id){
     $temp_arr = array();
     $res = mysql_query("SELECT * FROM niche_master where niche_id = '$niche_id' ") or die(mysql_error());        
     $count=mysql_num_rows($res);
    while($row = mysql_fetch_array($res)) {
         $temp_arr[] =$row;
		 
     }
     return $temp_arr;  
     }

	 	 //  Display Blog Niches Master limited
		  public function ShowLimitedBlog($limit){
			$temp_arr = array();
			$res = mysql_query("SELECT * FROM niche_master order by niche_name DESC LIMIT $limit") or die(mysql_error());
			$count=mysql_num_rows($res);
		   while($row = mysql_fetch_array($res)) {
				$temp_arr[] =$row;
  
			}
			return $temp_arr;
			}
  
  
	
		#####################################################################################################
	#
	#										BLOG Favarite List Client wise
	#
	#####################################################################################################
	
	
	
	
	// Blog Fav add
	/**
	*	Add a new Blog to blog fav table. 
	*
	*	@param
	*			$customer_id				Customer Id
	*			$blog_id				 	Blog Id
	*			
	*
	*	@return int
	*/
	function addBlogFavList($customer_id, $blog_id)
	{
		$customer_id					=	addslashes(trim($customer_id));
		$blog_id						=	addslashes(trim($blog_id));
		// echo $customer_id.'-'.$blog_id; 
		//satement to insert in product table
		$sql	=   "INSERT INTO blog_fav_list (customer_id,blog_id,added_on) VALUES ('$customer_id','$blog_id', now())";

		//execute query
		$query = $this->conn->query($sql);
		//echo $sql.mysql_error();exit;

		//get the primary key
		// $id		= $this->conn->insert_id;
		//return the blog_niche_id
		// return $id;

		// get the bool value 
		return $query;
		
	}//eof
	
	/**
	*	Get the data associated with a Blog fav list based upon the Blog Id and Customer it
	*
	*	@param
	*			$customer_id		customer id
	*
	*	@return array				
	*/
	// function showBlogFavList($customer_id, $blog_id){
	// 	$select = "SELECT * FROM blog_fav_list WHERE customer_id = '$customer_id' AND blog_id = '$blog_id'";
	// 	$query	= $this->conn->query($select);
	// 	// echo $this->conn->error;exit;
	// 	$rows   = $query->num_rows;
	// 	if ($rows > 0 ) {
	// 		while($result = $query->fetch_object())
	// 		{
	// 			$data  = array(
	// 				$result->id,				//0
	// 				$result->customer_id,		//1
	// 				$result->blog_id,			//2
	// 				$result->added_on			//3
	// 			);
	// 		}
	// 		return $data;
	// 	}
		
	// }//eof
	
	 /**
	*	This function will delete a Blog from blog fav list details permanently
	*
	*	@param
	*			$customer_id			Customer Id
	*
	*	@return null
	*/
	function delBlogFavList($customer_id, $blog_id){
		
		$delete1 = "DELETE FROM blog_fav_list WHERE customer_id='$customer_id' AND blog_id = '$blog_id'";
		$query1	= $this->conn->query($delete1);
		//echo $delete1.mysql_error();exit;
		return $query1;
		
	}//eof
	
	//User wise blogs on fav list display
	public function ShowCFavBlogData($customer_id){
     $res 	= "SELECT * FROM blog_fav_list where customer_id='$customer_id' " or die($res->$this->conn->error);
	 $query = $this->conn->query($res);        
     $rows 	= $query->num_rows;
	 if ($rows > 0) {
		 while($row = $res->fetch_array()) {
			 $temp_arr[] =$row;		 
			}
			return $temp_arr;  
		}
	}
	
	
}

?>	
	