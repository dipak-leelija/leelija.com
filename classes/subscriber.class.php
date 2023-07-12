<?php 
	////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	*	Managing Initiativeletter subscriber 
	*	
	*	@author		Himadri Shekhar Roy
	*	@date   	September 29, 2006
	*	@update		February 15, 2008
	*	@version	2.0
	*	@copyright	Analyze System Software Pvt. Ltd.
	*	@email		himadri.s.roy@ansysoft.com
	*/
	////////////////////////////////////////////////////////////////////////////////////////////////////
	
	include_once('utility.class.php');
	class EmailSubscriber extends Utility
	{
		//////////////////////////////////////////////////////////////////////////////////////////
		//
		//								Subscriber Category
		//
		//////////////////////////////////////////////////////////////////////////////////////////
		
		/**
		* 	Add a new Category
		*	
		*	@param
		*			$title		Title/heading of the category
		*			$desc		description of the category
		*			
		*	@return	int
		*/
		function addCategory($title, $desc)
		{
			$title 		= trim(addslashes($title));
			$desc 		= trim(addslashes($desc));
			
			$sql 	= "INSERT INTO email_categories
					  (title, description, added_on)
					  VALUES
					  ('$title', '$desc', now())";
			$query	= mysql_query($sql);
			
			$result = mysql_insert_id();
			
			return $result;
		}//eof
		
		/**
		*	Delete a category from the database
		*
		*	@param 
		*			$id	category id
		*
		*	@return string
		*/
		function deleteCategory($id)
		{
			//delete from category
			$sql	= "DELETE FROM email_categories WHERE cat_id='$id'";
			$query	= mysql_query($sql);
			
			$result = '';
			if(!$query)
			{
				$result = "ER103";
			}
			else
			{
				$result = "SU103";
			}
			
			//return the result
			return $result;
		}//eof
		
		/**
		*	Update 	Category
		*	
		*	@param
		*			$id			Category content identity
		*			$title		Title/heading of the category
		*			$desc		Description of the place
		*			
		*
		*	@return string
		*/
		function updateCategory($id, $title, $desc)
		{
			
			$title 	= trim(addslashes($title));
			$desc 	= trim(addslashes($desc));
			
			$sql	= "UPDATE email_categories SET
					  title			= '$title',
					  description	= '$desc',
					  modified_on 	=  now()
					  WHERE 
					  cat_id 	= '$id'
					  ";
			$query	= mysql_query($sql);
			
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
		*	Retrieve all category id 
		*
		*	@return array
		*/
		function getCategoryId()
		{
			
			$sql	= "SELECT cat_id FROM email_categories ORDER BY title";
					
			$query	= mysql_query($sql);
			$data	= array();
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
					$data[] = $result['cat_id'];
				}
			}
			return $data;
		}//eof
		
		/**
		*	Retrieve all category data
		*	@return array
		*	@param	$id		id of the category
		*/
		function getCategoryData($id)
		{
			//create the statement
			$sql	= "SELECT * FROM email_categories WHERE cat_id= '$id'";
			$query	= mysql_query($sql);
			$data	= array();
			//echo $query;
			if(mysql_num_rows($query) == 1)
			{
				$result = mysql_fetch_array($query);
				$data = array(
							 $result['title'],			//0
							 $result['description'],	//1
							 $result['added_on'],		//2
							 $result['modified_on'],	//3
							 );
			}
			return $data;
		}//eof
		
		
		//////////////////////////////////////////////////////////////////////////////////////////
		//
		//									Subscriber
		//
		//////////////////////////////////////////////////////////////////////////////////////////
		/**
		*	Add a new subscriber
		*	@return int
		*/
		function addSubscriber($cusid, $email, $fname, $lname, $category, $company, $phone)
		{
			
			$cusid		=	$cusid;
			$email		= trim($email);
			$fname		= trim(addslashes($fname));
			$lname		= trim(addslashes($lname));
			$category	= (int) $category;
			$company	= trim(addslashes($company));
			$phone		= trim(addslashes($phone));
			
			$id = 0;
			
			//validate whether subscriber is already added
			$sql 	= "SELECT * FROM email_subscriber WHERE email = '$email'";
			$query 	= $this->conn->query($sql);
			
			//echo $sql.mysql_error();  exit;
			if($query->num_rows > 0)
			{
				$id = 0;
			}
			else
			{
				//inserting the email
				$insert = "INSERT INTO email_subscriber 
						   (customer_id, email, fname, lname, added_on, status, 
						   cat_id, company, phone)
						   VALUES
						   ('$cusid', '$email', '$fname', '$lname', now(), 'a', 
						   '$category','$company','$phone')
						   ";
				$query  = $this->conn->query($insert);
				
				//echo $insert.mysql_error(); exit;
				$id		= $this->conn->insert_id;
			}
			
			//return the value
			return $id;
			
		}//eof
		
		/**
		*	Edit a subscriber
		*
		*	@return int
		*/
		function editSubscriber($id, $email,$fname,$lname, $category, $company, $phone)
		{
			$email		= trim($email);
			$fname		= trim(addslashes($fname));
			$lname		= trim(addslashes($lname));
			$category	= (int) $category;
			$company	= trim(addslashes($company));
			$phone		= trim(addslashes($phone));
			
			
			$insert = "UPDATE email_subscriber SET 
					   email 		= '$email', 
					   fname		= '$fname', 
					   lname		= '$lname',  
					   cat_id		= '$category',  
					   company		= '$company',  
					   phone		= '$phone',
					   modified_on  = now()
					   WHERE 
					   subscriber_id = '$id'
					   ";
			$query  = mysql_query($insert);
			
		}//end of add subscriber
		
		/**
		*	Get email in alphabetical order
		*
		*	@param
		*			$letter		Starting Letter	
		*
		*	@return array
		*/
		function getSubsByAlpha($letter)
		{
			//security
			$letter = mysql_escape_string($letter);
			
			if($letter != '')
			{
				$sql = "SELECT * FROM email_subscriber WHERE email like '$letter%' ORDER BY email";
			}
			else
			{
				$sql = "SELECT * FROM email_subscriber ORDER BY email";
			}
			$query	= mysql_query($sql);
			$id		= array();
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_object($query))
				{
					$id[] = $result->subscriber_id;
				}
			}
			return $id;
		}//eof
		
		/**
		*	Get email by status
		*
		*	@param
		*			$status		Status of the subscriber
		*
		*	@return array
		*/
		function getSubsByStatus($status)
		{
			//security
			$status = mysql_escape_string($status);
			
			if($status != '')
			{
				$sql = "SELECT * FROM email_subscriber WHERE status = '$status' ORDER BY email";
			}
			else
			{
				$sql = "SELECT * FROM email_subscriber ORDER BY email";	
			}
			
			
			$query	= mysql_query($sql);
			$id		= array();
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_object($query))
				{
					$id[] = $result->subscriber_id;
				}
			}
			return $id;
		}//eof
		
		/**
		*	Get email by category
		*
		*	@param
		*			$cat		Category of the subscriber
		*
		*	@return array
		*/
		function getSubsByCat($cat)
		{
			$cat	= (int)$cat;
			if($cat > 0)
			{
				$sql = "SELECT * FROM email_subscriber WHERE cat_id = '$cat' ORDER BY email";
			}
			else
			{
				$sql = "SELECT * FROM email_subscriber ORDER BY email";
			}
			
			$query	= mysql_query($sql);
			$id		= array();
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
					$id[] = $result['subscriber_id'];
				}
			}
			return $id;
		}//eof
		
		/**
		*	Search subscriber by key word only
		*
		*	@param
		*			$keyword	Keyword to search
		*
		*	@return array
		*/
		function getSubsKeyword($keyword)
		{
			$keyword = mysql_escape_string($keyword);
			
			if($keyword == '')
			{
				$sql =  "SELECT subscriber_id FROM email_subscriber";
			}
			else
			{
				$sql =  "SELECT subscriber_id,
						MATCH(email, fname, lname, company, phone)
						AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  email_subscriber
						WHERE 
						MATCH(email, fname, lname, company, phone)
						AGAINST ('$keyword' IN BOOLEAN MODE) 
						ORDER BY score DESC"; 
			}
			 $query = mysql_query($sql);
			 $data = array();
			 //echo "<p>".$sql."</p>";echo "data";
			 while($result = mysql_fetch_object($query))
			 {
				$data[] = $result->subscriber_id;
			 } 
			 if(!$query)
			 {
				return mysql_error();
			 }
			 else
			 {
				return $data;
			 }
		}//eof
		
		
		/**
		*	Get the subscriber
		*/
		function getAllSubId($letter, $status, $cat, $keyword)
		{
			$allIds	= array();
			
			$letIds	= $this->getSubsByAlpha($letter);
			$staIds	= $this->getSubsByStatus($status);
			$catIds	= $this->getSubsByCat($cat);
			$keyIds	= $this->getSubsKeyword($keyword);
			
			$allIds	= array_intersect($letIds, $staIds, $catIds, $keyIds);
			
			//return
			return $allIds;
		}//eof
		
		/**
		*	Get the subscriber
		*/
		function getIdByCatStatus($status, $cat)
		{
			$allIds	= array();
			
			$staIds	= $this->getSubsByStatus($status);
			$catIds	= $this->getSubsByCat($cat);
			
			$allIds	= array_intersect($staIds, $catIds);
			
			//return
			return $allIds;
		}//eof
		
		/////////////////////////////////////////////////////////////////////////////////
		
		/**
		*	Returns subscriber detail corresponding to subscriber id
		*	@return array
		*/
		function getSubsDtl($id)
		{
			$sql 	= "SELECT * FROM email_subscriber WHERE subscriber_id='$id'";
			$query 	= mysql_query($sql);
			$data	= array();
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
					$data = array(
							$result['customer_id'],		//0
							$result['cat_id'],			//1
							$result['email'],			//2
							$result['fname'],			//3
							$result['lname'],			//4
							$result['company'],			//5
							$result['phone'],			//6
							$result['added_on'],		//7
							$result['modified_on'],		//8
							$result['status']			//9				
							);
				}
			}
			return $data;
		}//eof
		
		
		/**
		*	Check  subscriber id
		*	@author		Ranjan Kuamr Basak
		*	@date   	October 02, 2013
		*	@return name
		*/
		
		function checkName($id)
		{
			$sql 	= "SELECT * FROM email_subscriber WHERE subscriber_id='$id'";
			$query 	= mysql_query($sql);
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
					if($result['customer_id']==0)
					{
						$name	='Guest';
					}
					else
					{
						$name	=$result['fname'];
					}
				}
			}
			return $name;
		}
		
		
		/**
		*	Generate a dropdown list of Initiative letter subscriber
		*	@return NULL
		*/
		function emailList()
		{
			$sql = "SELECT * FROM email_subscriber WHERE status='a'";
			$qry = mysql_query($sql);
			$num = mysql_num_rows($qry);
			//slicing the results in number of 100, so that email will be send to 100 person at once
			$numChunks = ceil($num/100);
			
			//populationg the dropdown list
			echo "<SELECT name='email_list'>";
			for($i = 0; $i<$numChunks; $i++)
			{
				//To generate the range we are deciding the max value of the range.
				//e.g. in the range 100-200 max. value is 200
				if(($i == $numChunks) || ($num < 100) )
				{
					$maxVal = $num;
				}
				elseif($numChunks == 1)
				{
					$maxVal = 100;
				}
				else
				{
					$j = $j + 1;
					$maxVal = $j."00";
				}
				//The minimum value of the range, i.e. in the range of 100-200 100 is the min value
				if($numChunks == 1)
				{
					$minVal = 1;
				}
				else
				{
					$minVal = $i."00";
				}
				
				
				echo "<OPTION value='".$minVal."-".$maxVal."'>".
				$minVal."-".$maxVal." Persons</OPTION>";
				//echo $numChunks."<br>";
			}
			echo "<SELECT>";
		}//eof email list
		
		
	}//end of class
?>